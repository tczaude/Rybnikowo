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
                                    <h2 class="jquery_tab_title">Lista użytkowników</h2>
                                    
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
						            
						            <br/>
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;{if $set_filter}color: #797268;{/if}" class="jquery_tab_title" onclick="showFilters();">{if $set_filter}Filtrowanie - włączone{else}Filtrowanie - wyłączone{/if}</h2>
						            
						            
						            {include file="user_filters.tpl"}
									


									
									{include file="user_paging.tpl"}
									
									<div style="display: none;" id="info"></div>
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NAZWISKO I IMIĘ</div>

									    </li>
									    
									</ul>
									<div class="clrl">&nbsp;</div>
									<ul id="order-list">
									
									{if $users_list}
									
									{foreach from=$users_list item=user name=user}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li id="listItem_{$user.user_id}" style="background-color: {$row_color}">
											  
											  <div class="name">
											  	<div style="width: 250px; float: left;">{$user.surname} {$user.name}</div>
											  	<div style="width: 120px; float: left;">{$user.city}</div>
											  	<div style="width: 220px; float: left;"><a href="mailto:{$user.email}">{$user.email}</a></div>
											  </div>
											  
											  
											  <div class="options">

													<a href="{$path}/user/edit/{$user.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"/></a>&nbsp;
					                                       
													{if $user.status eq 1}
														<a href="{$path}/user/status/{$user.id}/0" title="ustaw status nieaktywny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"/></a>
													{else}
														<a href="{$path}/user/status/{$user.id}/1" title="ustaw status aktywny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"/></a>
													{/if}                                       

													<a href="{$path}/user/remove/{$user.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"/></a>
																
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
								{include file="user_paging.tpl"}
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