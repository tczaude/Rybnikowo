              <div id="sidebar">
                            <ul class="nav">                         
                                <li><a class="headitem item1" href="#">Artykuły</a>
                                    <ul {if $script_name eq article}class="opened"{/if}><!-- ul items without this class get hiddden by jquery-->
                                    {if $CategoryId ne 1 && $CategoryId ne 6}
                                    <li {if $akcja eq article_edit}style="background-color: #FFFFFF;"{/if}><a href="{$path}/article/new">Dodaj nowy</a></li>
                                    {/if}
                                    <li {if $akcja eq article_list}style="background-color: #FFFFFF;"{/if}><a href="{$path}/article/index">Lista artykułów</a></li>
                                    </ul>
                                </li>
                                <li><a class="headitem item5" href="#">Firmy</a>
                                 <ul {if $script_name eq product}class="opened"{/if}><!-- ul items without this class get hiddden by jquery-->
                                    <li {if $akcja eq product_edit}style="background-color: #FFFFFF;"{/if}><a href="{$path}/product/new">Dodaj nowy</a></li>
                                    <li {if $akcja eq product_list}style="background-color: #FFFFFF;"{/if}><a href="{$path}/product/index">Lista produktów</a></li>
                                    </ul>
                                </li>   
                                <li><a class="headitem item8" href="#">Kategorie</a>
                                 <ul {if $script_name eq category}class="opened"{/if}><!-- ul items without this class get hiddden by jquery-->
                                    <li {if $akcja eq category_edit}style="background-color: #FFFFFF;"{/if}><a href="{$path}/category/new">Dodaj nową kategorię</a></li>
                                    <li {if $akcja eq category_list}style="background-color: #FFFFFF;"{/if}><a href="{$path}/category/index">Lista kategorii</a></li>                         
                                 </ul>
                                </li>  
                                <li><a class="headitem item12" href="#">Reklamy</a>
                                    <ul {if $script_name eq slideshow}class="opened"{/if}><!-- ul items without this class get hiddden by jquery-->                    
                                    <li {if $akcja eq slideshow_edit}style="background-color: #FFFFFF;"{/if}><a href="{$path}/slideshow/new">Dodaj nowy</a></li>                        
                                    <li {if $akcja eq slideshow_list}style="background-color: #FFFFFF;"{/if}><a href="{$path}/slideshow/index">Lista slajdów</a></li>
                                    </ul>
                                </li>                             
                                <li><a class="headitem item3" href="#">Blog</a>
                                    <ul {if $script_name eq blog}class="opened"{/if}>
	                                    <li {if $akcja eq blog_edit}style="background-color: #FFFFFF;"{/if}><a href="{$path}/blog/new">Dodaj wpis</a></li>
	                                    <li {if $akcja eq blog_list}style="background-color: #FFFFFF;"{/if}><a href="{$path}/blog/index">Lista bloga</a></li>
                                    </ul>                            
                                </li>
                                <li><a class="headitem item2" href="#">Partnerzy</a>
                                    <ul {if $script_name eq partner}class="opened"{/if}>
	                                    <li {if $akcja eq partner_edit}style="background-color: #FFFFFF;"{/if}><a href="{$path}/partner/new">Dodaj partnera</a></li>
	                                    <li {if $akcja eq partner_list}style="background-color: #FFFFFF;"{/if}><a href="{$path}/partner/index">Lista partnerów</a></li>
                                    </ul>                            
                                </li>
                                <li><a class="headitem item6" href="#">Kontakty</a>
                         			<ul>
	                                    <li><a href="{$path}/kontakt">Lista kontaktów</a></li>
	                                </ul>
                                </li>

                                
                            </ul><!--end subnav-->
                           
                           
                           <div style="height: 150px;">&nbsp;</div>

                        </div><!--end sidebar-->