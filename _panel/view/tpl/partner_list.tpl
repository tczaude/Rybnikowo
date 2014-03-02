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
                                    <h2 class="jquery_tab_title">Lista partnerów</h2>
                                    
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}

						            {*
						            {include file="partner_filters.tpl"}
									*}
									
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
											  			$("#info").load("/_panel/partner/sortable/?"+order);
											     	}
											});
											$("#order-list").disableSelection();
										});
										</script>
										{/literal}


									
									{include file="partner_paging.tpl"}
									
									<div style="display: none;" id="info"></div>
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">TYTUŁ</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $partners_list}
									
									{foreach from=$partners_list item=partner name=partner}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li id="listItem_{$partner.partner_id}" style="background-color: {$row_color}">
											  
											<div style="float: left; width: 30px;">{if !$smarty.foreach.partner.first}<a href="{$path}/partner/up/{$partner.partner_id}/{$partner.category_id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</div>
											<div style="float: left; width: 30px;">{if !$smarty.foreach.partner.last}<a href="{$path}/partner/down/{$partner.partner_id}/{$partner.category_id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</div>
							
											  <div class="name">{$partner.title}</div>
											  <div class="date">{$partner.date_created|date_format:"%Y-%m-%d"}</div>
											  
											  <div class="options">
											  	{foreach from=$language_list item=language}
														{if $language.id eq $admin_data.language}
														<a href="{$path}/partner/edit/{$partner.partner_id}/{$language.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
														{/if}
												{/foreach}
																				
																				                                       
													{if $partner.status eq 2}
														<a href="{$path}/partner/status/{$partner.partner_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{else}
														<a href="{$path}/partner/status/{$partner.partner_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
													{/if}                                       
										            {*                        
													<a href="javascript: openwin_big('partner_product.php?action=index&ArticleId={$partner.partner_id}');" title="wybierz produkty dla artykułu"><img src="{$path}/images/page_white_magnify.png" border="0" title="{$dict_templates.GetProductsForArticle}"></a>
													*}
													<a href="{$path}/partner/remove/{$partner.partner_id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
																
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
								{include file="partner_paging.tpl"}
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