<?php
class MainController extends AppController {

	var $name = 'Main';
	var $uses = array();

	function tree() {
		$this->autoRender = false;
		$trees = array(
			'root'=>array(
				array('id'=>'100000','text'=>__('Inventory', true),'leaf'=>false, 'cls'=>'folder'),
				array('id'=>'200000','text'=>__('Purchases', true),'leaf'=>false, 'cls'=>'folder'),
				array('id'=>'300000','text'=>__('Sales', true),'leaf'=>false, 'cls'=>'folder'),
				array('id'=>'400000','text'=>__('Report', true),'leaf'=>false, 'cls'=>'folder'),
				array('id'=>'500000','text'=>__('Accounts', true),'leaf'=>false, 'cls'=>'folder'),
				array('id'=>'700000','text'=>__('Tools', true),'leaf'=>false, 'cls'=>'folder'),
				array('id'=>'600000','text'=>__('Setting', true),'leaf'=>false, 'cls'=>'folder'),

			),

			'100000'=>array(
				array('id'=>'100001','text'=>__('Stock check sheets', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),
				array('id'=>'100002','text'=>__('Item Movements', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),

			),

			'200000'=>array(
				array('id'=>'200001','text'=>__('Purchases Orders', true),'leaf'=>true, 'cls'=>'file','url'=>'/purchase/purch_orders/'),
				array('id'=>'200002','text'=>__('Receive Purchases Orders', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.baidu.com'),
				array('id'=>'200003','text'=>__('Suppliers', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.baidu.com'),

			),

			'300000'=>array(
				array('id'=>'300001','text'=>__('Order or Quotation', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.baidu.com'),
				array('id'=>'300002','text'=>__('Customers', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.baidu.com'),

			),

			'500000'=>array(
				array('id'=>'500001','text'=>__('Departments', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),
				array('id'=>'500002','text'=>__('Employee', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),
				array('id'=>'500003','text'=>__('Rights', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),

			),

			'600000'=>array(
				array('id'=>'600001','text'=>__('General', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),
				array('id'=>'600002','text'=>__('Inventory', true),'leaf'=>true, 'cls'=>'file','url'=>'/inventory/inventories'),
				array('id'=>'600003','text'=>__('Rights', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),

			),

			'700000'=>array(
				array('id'=>'700001','text'=>__('Backup/Restroe', true),'leaf'=>true, 'cls'=>'file','url'=>'http://www.google.com'),

			),


		);
		$result = $trees[$_REQUEST['node']];
		echo json_encode($result);
	}



}
?>