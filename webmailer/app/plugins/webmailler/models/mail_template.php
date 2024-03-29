<?php
class MailTemplate extends WebmaillerAppModel {

	var $name = 'MailTemplate';
	var $validate = array(
		'to' => array('notempty'),
		'from' => array('notempty'),
		'from_name' => array('notempty'),
		'title' => array('notempty'),
		'subject' => array('notempty'),
		'content' => array('notempty')
	);
	var $attachments_splitor = '\001';
	var $group_splitor = ',';
	var $mail_msg;
	
	/**
	 * Send email to all customers according provided template id
	 *
	 * @access	public
	 * @author	John.Meng(孟远螓) arzen1013@gmail.com 2009-4-4
	 * @param	int	$id 	template id
	 * @return	void
	 */
	function sendMail($id) {
		$this->mail_msg = array();
		$mail_template = $this->read(null, $id);
		$mail_data = $mail_template['MailTemplate'];
		
		//-- import phpmailer
		App::import("Vendor", "PHPMailer", array('file' => 'PHPMailer'.DS.'class.phpmailer.php') );
		
		//-- get all mail servers 
		App::import('Model', 'Webmailler.MailServer');
		$mail_server_obj = new MailServer();
		$servers_list = $mail_server_obj->find('all');
		$servers = Set::extract($servers_list, '{n}.MailServer');
		
		//--- get all customers by page
		App::import('Model', 'Webmailler.MailCustomer');
		$mail_customer_obj = new MailCustomer();
		
		//--- log
		App::import('Model', 'Webmailler.MailLog');
		$mail_log_obj = new MailLog();
		
		$limit = count($servers);
		$total = $mail_customer_obj->find('count', array('conditions' => array('MailCustomer.mail_customer_category_id'=> explode($this->group_splitor, $mail_data['to']) ) ) );
		$pages = ceil($total/$limit);
		$total = $success = $fail =0;
		$charset= "UTF-8";
		if (Configure::read('Config.language') == "zh-CN") {
			$charset = "GBK";
		}
		
		for ($page=1; $page<=$pages; $page++) {
			$conditions = array(
				'fields' => array('MailCustomer.nickname', 'MailCustomer.gender', 'MailCustomer.email'),
				'limit' => $limit,
				'page' => $page, 
				'conditions' => array('MailCustomer.mail_customer_category_id'=> explode($this->group_splitor, $mail_data['to']) ),
			);
			$customers_list = $mail_customer_obj->find('all', $conditions);
			$customers = Set::extract($customers_list, '{n}.MailCustomer');
			if (is_array($customers)) {
				foreach ($customers as $key=>$customer) {
					$server = $servers[$key];
					$mail = new PHPMailer();
					$mail->CharSet = $charset;
					if ($server['ssl']) {
						$mail->SMTPSecure = "ssl";
					}
					$mail->IsSMTP();
					$mail->SMTPAuth   = true;
					$mail->Host       = $server['host'];
					if ($server['port']>0) {
						$mail->Port   = $server['port'];
					}
					
					$mail->Username   = $server['account'];
					$mail->Password   = $server['passwd'];
					
//					$mail->AddReplyTo($server['account'],"JohnMeng");
					
					$mail->From       = $server['account'];
					$mail->FromName   = $mail_data["from"];

					$mail->AddReplyTo($mail_data["from_name"],$mail_data["from"]);
					
					$mail->Subject    = $mail_data['subject'];
					$contents = $this->_parseMailContent( $mail_data['content'], $customer );
					if ($charset != "UTF-8") {
						$mail->Subject    = $this->_utf8ToGBK($mail->Subject);
						$contents = $this->_utf8ToGBK($contents);
					}
					
					
					if ($mail_data['plain_text']) {
						$mail->Body = strip_tags($contents);
					} else{
						$contents = $this->_parseEmbedMedia($contents, $mail);
						$mail->MsgHTML($contents);
						$mail->AltBody    = strip_tags($contents);
					}
					
					$mail->AddAddress($customer['email'], $customer['nickname']);
					
					//-- add attachments
					if ($mail_data['attachments']) {
						$attachmens = explode($this->attachments_splitor, $mail_data['attachments']);
						foreach ($attachmens as $attach) {
							$mail->AddAttachment($attach);
						}
						
					}
					
					$result = $mail->Send();
					
					if(!$result) {
					  printf(__("Send to %s error: %s ", true). "<br/>", $customer['email'], $mail->ErrorInfo);
					  $fail++;
					} else {
					  printf(__("Send to %s done ", true). "<br/>", $customer['email']);
					  $success++;	
					}
				}
								
			}
			$total ++;
			
		}
		
		$log = sprintf(__("Sent Total:%s Success:%s Fail:%s ", true). "\n", $total, $success, $fail);
		$mail_log_obj->log( $mail_data['subject'] . "[{$log}]");
		echo nl2br($log);
		return $this->mail_msg;
	}
	
	/**
	 * Parse mail content's placeholder
	 *
	 * @access	private
	 * @author	John.Meng(孟远螓) arzen1013@gmail.com 2009-4-4
	 * @param	string	$content	mail content
	 * @param 	array	$user_info	user profile infomation
	 * @return	string
	 */
	function _parseMailContent($content, $user_info) {
		$pattern = array(
			"#name", 
			"#gender", 
			"#date"
		);
		$replace = array(
			$user_info['nickname'], 
			$user_info['gender'] == 'M' ? __("Mr.", true) : __("Ms.", true), 
			date("Y/m/d H:i:s") 
		);
		return str_replace($pattern, $replace, $content);
	}
	
	/**
	 * Parse mail content emebed media
	 *
	 * @access	private
	 * @author	John.Meng(孟远螓) arzen1013@gmail.com 2009-4-4
	 * @param	string	$content
	 * @param 	object	$email_obj
	 * @return	string
	 */
	function _parseEmbedMedia($content, $email_obj) {
		$pattern = "/(src|background)=\"(.*)\"/Ui";
		$embed_pattern = array();
		$embed_replace = array();
		preg_match_all($pattern, $content, $matches);
		if (is_array($matches[2]) && (count($matches[2])>0) ) {
			$i = 1;
			foreach ($matches[2] as $key=>$org_img) {
				$embed_pattern[] = $org_img;
				$cid = "img_{$i}";
				$embed_replace[] = "cid:{$cid}";
				$f_pattern = array("../../../../app/webroot/", "/");
				$f_replace = array(WWW_ROOT, DIRECTORY_SEPARATOR);
				$dest_file = str_replace($f_pattern, $f_replace, $org_img);
				//-- embed image
				$email_obj->AddEmbeddedImage($dest_file, $cid, $cid);
				$i++;
			}
			//--- replace image to cid:image_X
			$content = str_replace($embed_pattern, $embed_replace, $content);
			
		}
		return $content;
	}
	
	function _utf8ToGBK($content) {
		return mb_convert_encoding($content, "GBK", "UTF-8");
	}
	
}
?>