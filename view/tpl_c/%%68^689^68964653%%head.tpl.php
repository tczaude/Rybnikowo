<?php /* Smarty version 2.6.9, created on 2013-04-26 14:17:28
         compiled from head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'head.tpl', 3, false),)), $this); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php if ($this->_tpl_vars['tags']['title']):  echo ((is_array($_tmp=$this->_tpl_vars['tags']['title'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp));  if ($this->_tpl_vars['head']['title']): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['head']['title'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp));  endif; ?> - www.rybnikowo.pl<?php else:  if ($this->_tpl_vars['head']['title']):  echo ((is_array($_tmp=$this->_tpl_vars['head']['title'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
 - <?php endif; ?>www.rybnikowo.pl<?php endif; ?></title>
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['DP']; ?>
images/html/favicon.ico" type="image/x-icon">
<meta name="keywords" content="<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
 echo $this->_tpl_vars['category']['name']; ?>
, <?php endforeach; endif; unset($_from); ?>" />
<meta name="description" content="<?php if ($this->_tpl_vars['head']['description']):  echo ((is_array($_tmp=$this->_tpl_vars['head']['description'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp));  else: ?>www.rybnikowo.pl - Katalog firm<?php endif; ?>" />
<?php if ($this->_tpl_vars['url_config']['0'] == blog && $this->_tpl_vars['url_config']['1'] == zobacz): ?>
<link rel="image_src" href="<?php echo $this->_tpl_vars['DP']; ?>
images/blog/<?php echo $this->_tpl_vars['blog_details']['blog_id']; ?>
_03_01.jpg" alt="<?php echo $this->_tpl_vars['blog_details']['product_id']; ?>
"/>
<?php elseif ($this->_tpl_vars['url_config']['0'] == firma): ?>
<link rel="image_src" href="<?php echo $this->_tpl_vars['DP']; ?>
images/product/<?php echo $this->_tpl_vars['product_details']['product_id']; ?>
_03_01.jpg" alt="<?php echo $this->_tpl_vars['product_details']['title']; ?>
" />
<?php else: ?>
<link rel="image_src" href="<?php echo $this->_tpl_vars['DP']; ?>
images/html/rybnikowo.png" alt="rybnikowo.pl" />
<?php endif; ?>
<meta name="author" content="Code13 - www.code13.pl" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['DP']; ?>
styles/style.css">

<link href="<?php echo $this->_tpl_vars['DP']; ?>
styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['DP']; ?>
styles/paginator.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DP']; ?>
js/ddaccordion.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DP']; ?>
js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DP']; ?>
js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DP']; ?>
js/cookie.policy.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['DP']; ?>
js/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<?php echo '
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-12454671-48\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
'; ?>



</head>