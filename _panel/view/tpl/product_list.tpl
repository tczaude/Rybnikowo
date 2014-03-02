<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
                            <div class="jquery_tab">
                            
                                <div class="content_block">
                                    <h2 class="jquery_tab_title">Lista produktów</h2>
                                    <div id="informacja"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
                                    {*
                                    <label for="selectbox">Wybierz kategorię</label>
						            <select name="selectbox" id="selectbox" onchange="window.location='{$path}/product/index/' + this.value;">
										{foreach from=$product_categories item=category}
													{if $category.sub}
													{foreach from=$category.sub item=sub1}
													{if !$sub1.sub}
													<option value="{$sub1.id}" {if $category_id eq $sub1.id}selected{/if}>{$category.name} - {$sub1.name}</option>
													{/if}		
															{if $sub1.sub}
															{foreach from=$sub1.sub item=sub2}
															{if !$sub2.sub}
															<option value="{$sub2.id}" {if $category_id eq $sub2.id}selected{/if}>{$category.name} - {$sub1.name} - {$sub2.name}</option>
															{/if}	
																{if $sub2.sub}
																{foreach from=$sub2.sub item=sub3}
																{if !$sub3.sub}
																<option value="{$sub3.id}" {if $category_id eq $sub3.id}selected{/if}>{$category.name} - {$sub1.name} - {$sub2.name} - {$sub3.name}</option>
																{/if}
																{/foreach}
																{/if}
															{/foreach}
															{/if}												
													{/foreach}
													{/if}
										{/foreach}
						            </select>
						            *}
						            
						            <br/>
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;{if $set_filter}color: #797268;{/if}" class="jquery_tab_title" onclick="showFilters();">{if $set_filter}Filtrowanie - włączone{else}Filtrowanie - wyłączone{/if}</h2>
						            
						            
						            {include file="product_filters.tpl"}
									
									
										{literal} 
										<style>
										.ui-state-highlight { 	background-image: url(../images/bullet2.gif) no-repeat top left #efefef; height: 1.5em; line-height: 1.2em;  }
										</style>                          	
										<script type="text/javascript">
										$(function() {
											$("#order-list").sortable({
												placeholder: 'ui-state-highlight',
											    handle : '.handle',
											    update : function () {
													var order = $('#order-list').sortable('serialize');
											  			$("#informacja").load("/_panel/product/sortable/?"+order);
											     	}
											});
											$("#order-list").disableSelection();
										});
										</script>
										{/literal}


									
									{include file="product_paging.tpl"}
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NAZWA</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $products_list}
									
									{foreach from=$products_list item=product name=product}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li id="listItem_{$product.product_id}" style="background-color: {$row_color}">
											  
											  {if $set_filter}
											  <img src="{$path}/images/no-arrow.png" title="Wyczyść filtry aby zmienić kolejność" alt="move" width="16" height="16" class="no-handle"/>
											  {else}
											  <img src="{$path}/images/arrow.png" alt="Przeciągnij aby zmienić kolejność" width="16" height="16" class="handle" />
											  {/if}
											  <div class="name"><img src="{$__CFG.base_url}images/product/{$product.product_id}_01_01.jpg" width="25" height="25" alt="{$product.title}"/>&nbsp;&nbsp;{$product.title}</div>
											  <div class="date">{$product.date_created|date_format:"%Y-%m-%d"}</div>
											  
											  <div class="options">
											  	{foreach from=$language_list item=language}
														{if $language.id eq $admin_data.language}
														<a href="{$path}/product/edit/{$product.product_id}/{$language.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
														{/if}
												{/foreach}
													{if $product.status eq 2}
														<a href="{$path}/product/status/{$product.product_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/product/status/{$product.product_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}
													{*
													{if $product.promotion eq 0}
														<a href="{$path}/product/promotion/{$product.product_id}/1/{$paging.current}" title="ustaw promocję"><img src="{$path}/images/promo_on.png" border="0" title="ustaw promocję"></a>
													{else}
														<a href="{$path}/product/promotion/{$product.product_id}/0/{$paging.current}" title="usuń z promocji"><img src="{$path}/images/promo_off.png" border="0" title="usuń z promocji"></a>
													{/if}   													                                       

													{if $product.home eq 0}
														<a href="{$path}/product/home/{$product.product_id}/1/{$paging.current}" title="ustaw na stronę główną"><img src="{$path}/images/flag_blue.png" border="0" title="ustaw na stronę główną"></a>
													{else}
														<a href="{$path}/product/home/{$product.product_id}/0/{$paging.current}" title="usuń ze strony głównej"><img src="{$path}/images/flag_red.png" border="0" title="usuń ze strony głównej"></a>
													{/if}
													*} 
													<a href="javascript: openwin('{$path}/related/GetRelatedProducts/{$product.product_id}/');"><img border="0" title="Wybierz kategorie" src="{$path}/images/onebit.png"/></a>
													<a href="javascript: openwin('{$path}/picture/index/{$product.product_id}/');"><img src="{$path}/images/gallery.gif" border="0" title="lista zdjęć"/></a>										            
													<a href="{$path}/product/remove/{$product.product_id}" onclick="if (!confirm('Czy na pewno chcesz usunąć wybrany produkt?')) return false;"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"/></a>
																
									</div>
										<div class="clearboth"></div>
									  </li>
									{/foreach}
									
									{else}
									
									<li>Brak wyników</li>
									
									{/if}
									
									</ul>
						            
								{*	
                                <div id="summary">PODSUMOWANIE</div>
                                *}
                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
								{include file="product_paging.tpl"}
                            	</div><!--end content_block-->

                            	
                            	
                            	
                            	
                                
                            </div><!--end jquery tab-->								
								

                        </div><!--end content-->
                        
                    </div><!--end main-->
                    
					{include file="menu.tpl"}
                        
                     </div><!--end bg_wrapper-->
                     <div class="clearboth"></div>
                <div id="footer">
                Krzysiek 500 069 804
                </div><!--end footer-->
                
        </div><!-- end top -->
		{literal}		
		<script type="text/javascript">
		
		function openwin(url)
		{
			var w = 650;
			var h = 600;
			dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		function openwin_big(url)
		{
			var w = 745;
			var h = 500;
			dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		</script>
		{/literal}
    </body>
    
</html>