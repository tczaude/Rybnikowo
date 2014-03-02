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
                                    <h2 class="jquery_tab_title">Lista zamówień - łączna wartość: {if $summary_value}{$summary_value|string_format:"%.2f"}{else}0{/if} PLN</h2>
                                    <div id="info"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}

						            
						            <br/>
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;{if $set_filter}color: #797268;{/if}" class="jquery_tab_title" onclick="showFilters();">{if $set_filter}Filtrowanie - włączone{else}Filtrowanie - wyłączone{/if}</h2>
						            
						            
						            {include file="order_filters.tpl"}

									
									{include file="order_paging.tpl"}
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NR, NAZWISKO I IMIĘ</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $orders_list}
									
									{foreach from=$orders_list item=order name=order}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li style="background-color: {$row_color}">
											  
											  <div class="name" style="width: 30px;">{$order.id}</div>
											  
											  <div class="name" style="width: 250px;">{$order.user_surname} {$order.user_name}</div>
											  <div style="float: left;width: 70px;">{$order.to_pay}</div>
											 <div style="float: left;width: 130px;{if $order.delivery eq 3 || $order.delivery eq 6}color: purple; font-weight: bold;{/if}">{$order.user_city}</div>
											 <div style="float: left;width: 180px;{if $order.status eq 1}color: red;{elseif $order.status eq 2}color: orange;{elseif $order.status eq 3}color: navy;{else}color: green;{/if}">{$order.status_name}</div>
											 <div style="float: left;width: 180px;">{$order.status_transaction_name}</div>
											  <div class="date">{$order.date_created|date_format:"%Y-%m-%d"}</div>
											  
											  
											  <div class="options">
											
												<a href="{$path}/order/display/{$order.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
																					
												{*							                                       
												{if $order.status eq 2}
													<a href="{$path}/order/status/{$order.order_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
												{else}
													<a href="{$path}/order/status/{$order.order_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
												{/if}                                       
										                                   
												<a href="javascript: openwin_big('order_product.php?action=index&ArticleId={$order.order_id}');" title="wybierz produkty dla artykułu"><img src="{$path}/images/page_white_magnify.png" border="0" title="{$dict_templates.GetProductsForArticle}"></a>
												*}
												<a href="{$path}/order/remove/{$order.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
															
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
								{include file="order_paging.tpl"}
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
        
    </body>
    
</html>