<?php 
echo $modal->modalForm('ex4', "AddForm");
?>

<div class="mailServers form">
<?php echo $form->create('MailServer', array('id'=>'AddForm' ) );?>
	<fieldset>
 		<legend><?php __('Edit MailServer');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('host');
		echo $form->input('ssl');
		echo $form->input('port');
		echo $form->input('account');
		echo $form->input('passwd');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
