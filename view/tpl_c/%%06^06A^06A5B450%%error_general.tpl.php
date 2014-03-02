<?php /* Smarty version 2.6.9, created on 2014-03-01 11:00:39
         compiled from errors/error_general.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Error</title>
<link href="/styles/error.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="content">
		<div style="background-image: url(' <?php echo $this->_tpl_vars['DP']; ?>
images/html/error.png'); background-repeat: no-repeat;">
		<div style="padding-left: 220px; height: 200px;">
		<h1><?php echo $this->_tpl_vars['error_heading']; ?>
</h1>
		<?php echo $this->_tpl_vars['error_message']; ?>

		<?php if ($this->_tpl_vars['back']): ?>
		<br><br>
		<a href="<?php echo $this->_tpl_vars['back']; ?>
">wróć</a>
		<?php endif; ?>
		</div>
		</div>
	</div>
</body>
</html>