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
                                    <h2 class="jquery_tab_title">Najlepsze użytkownicy</h2>
                                    <div id="info"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}

                                    <label for="selectbox">Pokaż wg:</label>
						            <select style="width: 200px;" name="selectbox" id="selectbox" onchange="window.location='{$path}/stat/user/{$paging.current}/?user_sort=' + this.value;">
										
										<option value="order_summary" {if $user_sort eq order_summary}selected{/if}>Wartości zamówień</option>
										<option value="order_count" {if $user_sort eq order_count}selected{/if}>Ilości zamówień</option>
										
						            </select>
						            
						            <br/>
									{include file="stat_user_paging.tpl"}
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">KLIENT</div>
											  <div class="datetop">ILOŚĆ</div>
											  
											  <div class="optionstop">WARTOŚĆ</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $user_list}
									
									{foreach from=$user_list item=user name=user}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li style="background-color: {$row_color}">
											  <div class="name"><a href="{$path}/user/edit/{$user.id}">{$user.surname} {$user.name}</a></div>
											  <div class="date" style="width: 70px;">{$user.order_count}</div>
											  
											  <div class="options" style="width: 100px; text-align: right; margin-right: 60px;">{$user.order_summary}</div>
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
								{include file="stat_user_paging.tpl"}
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