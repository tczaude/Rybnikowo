<?php /* Smarty version 2.6.9, created on 2014-03-01 22:09:19
         compiled from /var/customers/webs/wmuras/rybnikowo.pl/_panel/view/tpl/errors/error_general.tpl */ ?>
<html>
<head>
<title>Error</title>
<link href="/styles/error.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="content">
		<h1><?php echo $this->_tpl_vars['error_heading']; ?>
</h1>
		<?php echo $this->_tpl_vars['error_message']; ?>

		<?php if ($this->_tpl_vars['back']): ?>
		<br><br>
		<a href="<?php echo $this->_tpl_vars['back']; ?>
">wróć</a>
		<?php endif; ?>
	</div>
</body>
</html>