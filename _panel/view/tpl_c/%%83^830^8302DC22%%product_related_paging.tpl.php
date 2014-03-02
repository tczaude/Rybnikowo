<?php /* Smarty version 2.6.9, created on 2013-02-18 16:38:51
         compiled from product_related_paging.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'product_related_paging.tpl', 5, false),)), $this); ?>
	<div class="clearboth"></div>
				<div id="pagging">
					<?php if ($this->_tpl_vars['paging']['first']): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/related/GetRelatedProducts/<?php echo $this->_tpl_vars['ProductId']; ?>
/<?php echo $this->_tpl_vars['paging']['first']; ?>
"><?php endif; ?><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/start<?php if (! $this->_tpl_vars['paging']['first']): ?>_off<?php endif; ?>.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"><?php if ($this->_tpl_vars['paging']['first']): ?></a><?php endif; ?>&nbsp;
					<?php if ($this->_tpl_vars['paging']['previous']): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/related/GetRelatedProducts/<?php echo $this->_tpl_vars['ProductId']; ?>
/<?php echo $this->_tpl_vars['paging']['previous']; ?>
"><?php endif; ?><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/previous<?php if (! $this->_tpl_vars['paging']['previous']): ?>_off<?php endif; ?>.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"><?php if ($this->_tpl_vars['paging']['previous']): ?></a><?php endif; ?>
					&nbsp;&nbsp;<?php echo $this->_tpl_vars['dict_templates']['NavPage']; ?>
 <?php echo $this->_tpl_vars['paging']['current']; ?>
 <?php echo $this->_tpl_vars['dict_templates']['NavFrom']; ?>
 <?php echo ((is_array($_tmp=@$this->_tpl_vars['paging']['last'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['paging']['current']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['paging']['current'])); ?>
&nbsp;&nbsp;
					<?php if ($this->_tpl_vars['paging']['next']): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/related/GetRelatedProducts/<?php echo $this->_tpl_vars['ProductId']; ?>
/<?php echo $this->_tpl_vars['paging']['next']; ?>
"><?php endif; ?><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/next<?php if (! $this->_tpl_vars['paging']['next']): ?>_off<?php endif; ?>.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"><?php if ($this->_tpl_vars['paging']['next']): ?></a><?php endif; ?>&nbsp;
					<?php if ($this->_tpl_vars['paging']['last']): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/related/GetRelatedProducts/<?php echo $this->_tpl_vars['ProductId']; ?>
/<?php echo $this->_tpl_vars['paging']['last']; ?>
"><?php endif; ?><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/end<?php if (! $this->_tpl_vars['paging']['last']): ?>_off<?php endif; ?>.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"><?php if ($this->_tpl_vars['paging']['last']): ?></a><?php endif; ?>
				</div>
	<div class="clearboth"></div><br>	