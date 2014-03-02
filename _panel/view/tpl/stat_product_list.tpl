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
                                    <h2 class="jquery_tab_title">Najlepsze produkty</h2>
                                    <div id="info"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}

                                    <label for="selectbox">Pokaż wg:</label>
						            <select style="width: 200px;" name="selectbox" id="selectbox" onchange="window.location='{$path}/stat/product/{$paging.current}/?prod_sort=' + this.value;">
										
										<option value="value_summary" {if $prod_sort eq value_summary}selected{/if}>Wartości</option>
										<option value="value_count" {if $prod_sort eq value_count}selected{/if}>Ilości</option>
										
						            </select>
						            
						            <br/>
									{include file="stat_product_paging.tpl"}
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NAZWA</div>
											  <div class="datetop">ILOŚĆ</div>
											  
											  <div class="optionstop">WARTOŚĆ</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $order_list}
									
									{foreach from=$order_list item=order name=order}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li style="background-color: {$row_color}">
											  <div class="name"><a href="{$path}/product/edit/{$order.product_id}/1/">{$order.title}</a></div>
											  <div class="date" style="width: 70px;">{$order.value_count}</div>
											  
											  <div class="options" style="width: 100px; text-align: right; margin-right: 60px;">{$order.value_summary}</div>
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
								{include file="stat_product_paging.tpl"}
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