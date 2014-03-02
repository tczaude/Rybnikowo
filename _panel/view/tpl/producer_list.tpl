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
                                    <h2 class="jquery_tab_title">Lista kategorii wg producenta</h2>
                                    <div id="info"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
									
									
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
											  			$("#info").load("/_panel/article/sortable/?"+order);
											     	}
											});
											$("#order-list").disableSelection();
										});
										</script>
										{/literal}


									
									
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NAZWA</div>
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $menu_categories}
									
									{foreach from=$menu_categories item=producer name=producer}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li style="background-color: {$row_color}" >
											  
											  <div class="name" style="padding-left:30px;{if $producer.status ne 1} color:#bbbbbb;{/if}">{$producer.name}</div>
											  
											  
											  <div class="options">
                  
													<a href="{$path}/producer/edit/{$producer.id}/{$language.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"/></a>&nbsp;					                                       
													{if $producer.status eq 1}
														<a href="{$path}/producer/status/{$producer.id}/0/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/producer/status/{$producer.id}/1/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
										            <a href="{$path}/producer/remove/{$producer.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
																
											</div>
											{*
											<div class="date">
												{if !$smarty.foreach.producer.first}<a href="{$path}/producer/up/{$producer.id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;
												{if !$smarty.foreach.producer.last}<a href="{$path}/producer/down/{$producer.id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;
											
											</div>
											*}
										<div class="clearboth"></div>
									  </li>
									  {if $producer.sub}
									  {foreach from=$producer.sub item=sub1}
									  {cycle name=color assign=sub_color values="#EFEFEF ,#EFEFEF"}
									  <li style="padding: 2px 10px; background-color: {$sub_color}">
											  
											  <div class="name" style="padding-left:50px;{if $sub1.status ne 1} color:#bbbbbb;{/if}">&nbsp;&rarr;&nbsp;&nbsp;{$sub1.name}</div>
											  
											  <div class="options">
								
													<a href="{$path}/producer/edit/{$sub1.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
					                                       
													{if $sub1.status eq 1}
														<a href="{$path}/producer/status/{$sub1.id}/0/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/producer/status/{$sub1.id}/1/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
										             
													<a href="{$path}/producer/remove/{$sub1.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
																
											</div>
										<div class="clearboth"></div>
									  </li>									  
									  {/foreach}
									  {/if}
									{/foreach}
									
									{else}
									
									<li>Brak wyników</li>
									
									{/if}
									
									</ul>
                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
								
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