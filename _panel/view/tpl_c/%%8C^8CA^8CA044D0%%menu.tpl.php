<?php /* Smarty version 2.6.9, created on 2013-04-04 15:46:39
         compiled from menu.tpl */ ?>
              <div id="sidebar">
                            <ul class="nav">                         
                                <li><a class="headitem item1" href="#">Artykuły</a>
                                    <ul <?php if ($this->_tpl_vars['script_name'] == article): ?>class="opened"<?php endif; ?>><!-- ul items without this class get hiddden by jquery-->
                                    <?php if ($this->_tpl_vars['CategoryId'] != 1 && $this->_tpl_vars['CategoryId'] != 6): ?>
                                    <li <?php if ($this->_tpl_vars['akcja'] == article_edit): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/article/new">Dodaj nowy</a></li>
                                    <?php endif; ?>
                                    <li <?php if ($this->_tpl_vars['akcja'] == article_list): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/article/index">Lista artykułów</a></li>
                                    </ul>
                                </li>
                                <li><a class="headitem item5" href="#">Firmy</a>
                                 <ul <?php if ($this->_tpl_vars['script_name'] == product): ?>class="opened"<?php endif; ?>><!-- ul items without this class get hiddden by jquery-->
                                    <li <?php if ($this->_tpl_vars['akcja'] == product_edit): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/product/new">Dodaj nowy</a></li>
                                    <li <?php if ($this->_tpl_vars['akcja'] == product_list): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/product/index">Lista produktów</a></li>
                                    </ul>
                                </li>   
                                <li><a class="headitem item8" href="#">Kategorie</a>
                                 <ul <?php if ($this->_tpl_vars['script_name'] == category): ?>class="opened"<?php endif; ?>><!-- ul items without this class get hiddden by jquery-->
                                    <li <?php if ($this->_tpl_vars['akcja'] == category_edit): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/category/new">Dodaj nową kategorię</a></li>
                                    <li <?php if ($this->_tpl_vars['akcja'] == category_list): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/category/index">Lista kategorii</a></li>                         
                                 </ul>
                                </li>  
                                <li><a class="headitem item12" href="#">Reklamy</a>
                                    <ul <?php if ($this->_tpl_vars['script_name'] == slideshow): ?>class="opened"<?php endif; ?>><!-- ul items without this class get hiddden by jquery-->                    
                                    <li <?php if ($this->_tpl_vars['akcja'] == slideshow_edit): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/slideshow/new">Dodaj nowy</a></li>                        
                                    <li <?php if ($this->_tpl_vars['akcja'] == slideshow_list): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/slideshow/index">Lista slajdów</a></li>
                                    </ul>
                                </li>                             
                                <li><a class="headitem item3" href="#">Blog</a>
                                    <ul <?php if ($this->_tpl_vars['script_name'] == blog): ?>class="opened"<?php endif; ?>>
	                                    <li <?php if ($this->_tpl_vars['akcja'] == blog_edit): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/blog/new">Dodaj wpis</a></li>
	                                    <li <?php if ($this->_tpl_vars['akcja'] == blog_list): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/blog/index">Lista bloga</a></li>
                                    </ul>                            
                                </li>
                                <li><a class="headitem item2" href="#">Partnerzy</a>
                                    <ul <?php if ($this->_tpl_vars['script_name'] == partner): ?>class="opened"<?php endif; ?>>
	                                    <li <?php if ($this->_tpl_vars['akcja'] == partner_edit): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/new">Dodaj partnera</a></li>
	                                    <li <?php if ($this->_tpl_vars['akcja'] == partner_list): ?>style="background-color: #FFFFFF;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/index">Lista partnerów</a></li>
                                    </ul>                            
                                </li>
                                <li><a class="headitem item6" href="#">Kontakty</a>
                         			<ul>
	                                    <li><a href="<?php echo $this->_tpl_vars['path']; ?>
/kontakt">Lista kontaktów</a></li>
	                                </ul>
                                </li>

                                
                            </ul><!--end subnav-->
                           
                           
                           <div style="height: 150px;">&nbsp;</div>

                        </div><!--end sidebar-->