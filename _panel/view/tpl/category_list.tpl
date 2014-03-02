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
                                    <h2 class="jquery_tab_title">Lista kategorii</h2>
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
											  <div class="datetop">OPCJE</div>
											  
											  <div class="optionstop">KOLEJNOŚĆ</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $menu_categories}
									
									{foreach from=$menu_categories item=category name=category}
									{cycle name=color assign=row_color values="#c3d5c5 ,#c3d5c5"}
									
									
									  <li style="background-color: {$row_color}" >
											  
											  <div class="name" style="padding-left:30px;{if $category.status ne 1} color:#bbbbbb;{/if}">{$category.name}</div>
											  
											  
											  <div class="options" style="margin-right: 50px;">
													<a href="{$path}/category/new/{$category.id}"><img src="{$path}/images/add.png" title="dodaj nową subkategorię" border="0" style="cursor:pointer;"/></a>                  
													<a href="{$path}/category/edit/{$category.id}/{$language.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"/></a>&nbsp;
											
																				
																				                                       
													{if $category.status eq 1}
														<a href="{$path}/category/status/{$category.id}/0/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/category/status/{$category.id}/1/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
										            <a href="{$path}/category/remove/{$category.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
																
											</div>
											<div class="date">
												{if !$smarty.foreach.category.first}<a href="{$path}/category/up/{$category.id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;
												{if !$smarty.foreach.category.last}<a href="{$path}/category/down/{$category.id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;
											
											</div>
										<div class="clearboth"></div>
									  </li>
									  {if $category.sub}
									  {foreach from=$category.sub item=sub1}
									  {cycle name=color assign=sub_color values="#EFEFEF ,#EFEFEF"}
									  <li style="padding: 2px 10px; background-color: {$sub_color}">
											  
											  <div class="name" style="padding-left:100px;{if $sub1.status ne 1} color:#bbbbbb;{/if}">&nbsp;&rarr;&nbsp;&nbsp;{$sub1.name}</div>
											  
											  <div class="options" style="margin-right: 50px;">
													
													<a href="{$path}/category/edit/{$sub1.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
					                                       
													{if $sub1.status eq 1}
														<a href="{$path}/category/status/{$sub1.id}/0/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/category/status/{$sub1.id}/1/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
										             
													<a href="{$path}/category/remove/{$sub1.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
																
											</div>
										<div class="clearboth"></div>
									  </li>
									  
									  {if $sub1.sub}
									  {foreach from=$sub1.sub item=sub2}
									  {cycle name=color assign=sub_color values="#EFEFEF ,#EFEFEF"}
									  <li style="padding: 2px 10px; background-color: {$sub_color}">
											  
											  <div class="name" style="padding-left:200px;{if $sub2.status ne 1} color:#bbbbbb;{/if}">&nbsp;&nbsp;&nbsp;&nbsp;&rarr;&nbsp;&nbsp;{$sub2.name}</div>
											  
											  <div class="options">
													<a href="{$path}/category/new/{$sub2.id}"><img src="{$path}/images/add.png" title="dodaj nową subkategorię" border="0" style="cursor:pointer;"/></a>
													<a href="{$path}/category/edit/{$sub2.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
					                                       
													{if $sub2.status eq 1}
														<a href="{$path}/category/status/{$sub2.id}/0/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/category/status/{$sub2.id}/1/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
										             
													<a href="{$path}/category/remove/{$sub2.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
																
											</div>
										<div class="clearboth"></div>
									  </li>	
									  
									  {if $sub2.sub}
									  {foreach from=$sub2.sub item=sub3}
									  {cycle name=color assign=sub_color values="#EFEFEF ,#EFEFEF"}
									  <li style="padding: 2px 10px; background-color: {$sub_color}">
											  
											  <div class="name" style="padding-left:300px;{if $sub3.status ne 1} color:#bbbbbb;{/if}">&nbsp;&nbsp;&nbsp;&nbsp;&rarr;&nbsp;&nbsp;{$sub3.name}</div>
											  
											  <div class="options">
													
													<a href="{$path}/category/edit/{$sub3.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
					                                       
													{if $sub3.status eq 1}
														<a href="{$path}/category/status/{$sub3.id}/0/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/category/status/{$sub3.id}/1/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
										             
													<a href="{$path}/category/remove/{$sub3.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
																
											</div>
										<div class="clearboth"></div>
									  </li>									  
									  {/foreach}
									  {/if}										  
									  
									  
									  								  
									  {/foreach}
									  {/if}									  
									  
									  								  
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