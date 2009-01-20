<?php echo $html->doctype('xhtml-strict') ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php echo $html->charset(); ?>
	
	<title><?php echo $title_for_layout; ?></title>
	<meta name="description" content="" />
    <?php 
	    echo $html->css( array("admin_style", 'debug') ); 
	    echo $scripts_for_layout;
	    echo $javascript->link( array('jquery', 'jquery.form') );
    ?>
</head>
<body>

<?php echo $content_for_layout ?>

</body>
</html>
