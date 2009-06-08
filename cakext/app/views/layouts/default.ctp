<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('WebOA'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->css( array("style", 'debug') );
		echo $scripts_for_layout;
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $html->url('/extjs/resources/css/ext-all.css'); ?>" />

    <!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="<?php echo $html->url('/extjs/adapter/ext/ext-base.js'); ?>"></script>
 	<!-- ENDLIBS -->

    <script type="text/javascript" src="<?php echo $html->url('/extjs/ext-all.js'); ?>"></script>

</head>
<body>
	<?php $session->flash(); ?>

	<?php echo $content_for_layout; ?>
	<?php echo $cakeDebug; ?>
</body>
</html>