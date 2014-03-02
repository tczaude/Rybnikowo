<?php /* Smarty version 2.6.9, created on 2013-04-04 16:10:42
         compiled from paging_partner.tpl */ ?>
<?php if ($this->_tpl_vars['paging']['page_to'] && $this->_tpl_vars['paging']['page_from'] != $this->_tpl_vars['paging']['page_to']): ?>
<div style="width: 100%; border-top: 2px solid #CDCDCD;">


<div class="paginator graphic_paginator">

	<?php if ($this->_tpl_vars['paging']['previous']): ?><a href="<?php echo $this->_tpl_vars['DP']; ?>
partner/lista/<?php echo $this->_tpl_vars['paging']['previous']; ?>
" accesskey="1"  title="Poprzednia strona [Alt-1]"><?php endif;  if ($this->_tpl_vars['paging']['previous']): ?><img src="<?php echo $this->_tpl_vars['DP']; ?>
images/html/prev.gif" alt="poprzednie"></a><?php endif; ?>

	<?php if ($this->_tpl_vars['paging']['first'] && $this->_tpl_vars['paging']['first'] != $this->_tpl_vars['paging']['page_from']): ?>
	<?php if ($this->_tpl_vars['paging']['first']): ?><a href="<?php echo $this->_tpl_vars['DP']; ?>
partner/lista/<?php echo $this->_tpl_vars['paging']['first']; ?>
" class="page_nr"><?php endif; ?><span><?php echo $this->_tpl_vars['paging']['first']; ?>
</span><?php if ($this->_tpl_vars['paging']['first']): ?></a><?php endif; ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['paging']['first'] && $this->_tpl_vars['paging']['first'] != $this->_tpl_vars['paging']['page_from']): ?>
	<span class="hellip">…</span>
	<?php endif; ?>

	<?php unset($this->_sections['page']);
$this->_sections['page']['name'] = 'page';
$this->_sections['page']['start'] = (int)$this->_tpl_vars['paging']['page_from'];
$this->_sections['page']['loop'] = is_array($_loop=$this->_tpl_vars['paging']['page_to']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page']['show'] = true;
$this->_sections['page']['max'] = $this->_sections['page']['loop'];
$this->_sections['page']['step'] = 1;
if ($this->_sections['page']['start'] < 0)
    $this->_sections['page']['start'] = max($this->_sections['page']['step'] > 0 ? 0 : -1, $this->_sections['page']['loop'] + $this->_sections['page']['start']);
else
    $this->_sections['page']['start'] = min($this->_sections['page']['start'], $this->_sections['page']['step'] > 0 ? $this->_sections['page']['loop'] : $this->_sections['page']['loop']-1);
if ($this->_sections['page']['show']) {
    $this->_sections['page']['total'] = min(ceil(($this->_sections['page']['step'] > 0 ? $this->_sections['page']['loop'] - $this->_sections['page']['start'] : $this->_sections['page']['start']+1)/abs($this->_sections['page']['step'])), $this->_sections['page']['max']);
    if ($this->_sections['page']['total'] == 0)
        $this->_sections['page']['show'] = false;
} else
    $this->_sections['page']['total'] = 0;
if ($this->_sections['page']['show']):

            for ($this->_sections['page']['index'] = $this->_sections['page']['start'], $this->_sections['page']['iteration'] = 1;
                 $this->_sections['page']['iteration'] <= $this->_sections['page']['total'];
                 $this->_sections['page']['index'] += $this->_sections['page']['step'], $this->_sections['page']['iteration']++):
$this->_sections['page']['rownum'] = $this->_sections['page']['iteration'];
$this->_sections['page']['index_prev'] = $this->_sections['page']['index'] - $this->_sections['page']['step'];
$this->_sections['page']['index_next'] = $this->_sections['page']['index'] + $this->_sections['page']['step'];
$this->_sections['page']['first']      = ($this->_sections['page']['iteration'] == 1);
$this->_sections['page']['last']       = ($this->_sections['page']['iteration'] == $this->_sections['page']['total']);
?>
	
		<?php if ($this->_sections['page']['index'] != $this->_tpl_vars['paging']['current']): ?>
		
		<a href="<?php echo $this->_tpl_vars['DP']; ?>
partner/lista/<?php echo $this->_sections['page']['index']; ?>
" class="page_nr"><span><?php echo $this->_sections['page']['index']; ?>
</span></a>
		<?php else: ?>
		<strong><?php echo $this->_sections['page']['index']; ?>
</strong>
		<?php endif; ?>

	<?php endfor; endif; ?>
	
	<?php if ($this->_tpl_vars['paging']['last'] && $this->_tpl_vars['paging']['last'] != $this->_tpl_vars['paging']['page_to']): ?>
	<span class="hellip">…</span>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['paging']['last'] && $this->_tpl_vars['paging']['last'] != $this->_tpl_vars['paging']['page_to']): ?>
	<?php if ($this->_tpl_vars['paging']['last']): ?><a href="<?php echo $this->_tpl_vars['DP']; ?>
partner/lista/<?php echo $this->_tpl_vars['paging']['last']; ?>
" class="page_nr"><?php endif; ?><span><?php echo $this->_tpl_vars['paging']['last']; ?>
</span><?php if ($this->_tpl_vars['paging']['last']): ?></a><?php endif; ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['paging']['last']): ?><a href="<?php echo $this->_tpl_vars['DP']; ?>
partner/lista/<?php echo $this->_tpl_vars['paging']['next']; ?>
" accesskey="2" title="Następna strona"><?php endif;  if ($this->_tpl_vars['paging']['next']): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['DP']; ?>
images/html/next.gif" alt="nastepne"></a><?php endif; ?>

</div>


</div>
<?php endif; ?>