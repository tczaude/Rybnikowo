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
                                    <h2 class="jquery_tab_title">Lista artykułów</h2>
                                    
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;{if $set_filter}color: #797268;{/if}" class="jquery_tab_title" onclick="showFilters();">{if $set_filter}Filtrowanie - włączone{else}Filtrowanie - wyłączone{/if}</h2>
						            
									{*include file="newsletter_paging.tpl"*}
									
									<div style="display: none;" id="info"></div>
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">TYTUŁ</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $newsletter_list}
									
									{foreach from=$newsletter_list item=newsletter name=newsletter}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li id="listItem_{$newsletter.newsletter_id}" style="background-color: {$row_color}">
											  
											  <div class="name">{$newsletter.name}</div>
											  <div class="date">{$newsletter.date_created|date_format:"%Y-%m-%d"}</div>
											  
											  <div class="options">

													<a href="{$path}/newsletter/edit/{$newsletter.id}/"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit}"/></a>&nbsp;	
																				
																				                                       
													{if $newsletter.status eq 2}
														<a href="{$path}/newsletter/status/{$newsletter.newsletter_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/newsletter/status/{$newsletter.newsletter_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
													<a href="{$path}/newsletter/preview/{$newsletter.id}"><img src="{$path}/images/magnifier.png" border="0" title="Podgląd"/></a>
													
													<a href="javascript: openwin('{$path}/dispatch/GetDispatchesForNewsletter/{$newsletter.id}/');"><img src="{$path}/images/email_go.png" border="0" title="Wyślij newsletter"/></a>
																											
													<a href="{$path}/newsletter/remove/{$newsletter.id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"/></a>
																
									</div>
										<div class="clearboth"></div>
									  </li>
									{/foreach}
									
									{else}
									
									<li>Brak wyników</li>
									
									{/if}
									
									</ul>

                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
								{*include file="newsletter_paging.tpl"*}
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