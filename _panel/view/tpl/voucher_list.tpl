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
                                    <h2 class="jquery_tab_title">Lista kodów rabatowych</h2>
                                    <div id="info"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
									
									{include file="voucher_paging.tpl"}
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop" style="padding: 0 20px 0 0;">KOD</div>
											  <div class="datetop" style="margin-right: 60px;">DATA WAŻNOŚCI</div>
											  
											  <div class="optionstop" style="margin-right: 35px;">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $vouchers_list}
									
									{foreach from=$vouchers_list item=voucher name=voucher}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li id="listItem_{$voucher.voucher_id}" style="background-color: {$row_color}">
											  
											  <div class="name"{if $voucher.fb_user_email}style="color: red;"{/if}>{$voucher.bonus_code}{if $voucher.fb_user_email} [Facebook]{/if}</div>
											  <div class="date">{$voucher.creation_date|date_format:"%Y-%m-%d"} - {$voucher.end_date|date_format:"%Y-%m-%d"}</div>
											  
											  <div class="options">

												<a href="{$path}/voucher/edit/{$voucher.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit}"></a>&nbsp;

												
																			                                       
												{if $voucher.status eq 2}
													<a href="{$path}/voucher/status/{$voucher.id}/1/{$paging.current}" title="ustaw status aktywny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
												{else}
													<a href="{$path}/voucher/status/{$voucher.id}/2/{$paging.current}" title="ustaw status nieaktywny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
												{/if}
                                   
												<a href="{$path}/voucher/remove/{$voucher.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
	
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
								{include file="voucher_paging.tpl"}
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