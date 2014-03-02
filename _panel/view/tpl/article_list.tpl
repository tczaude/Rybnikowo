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
                                    <div id="info"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
                                    {*
                                    <label for="selectbox">Wybierz kategorię</label>
						            <select style="width: 200px;" name="selectbox" id="selectbox" onchange="window.location='{$path}/article/index/' + this.value;">
										{foreach from=$dict_templates.article_category item=category key=key}
										<option value="{$key}" {if $category_id eq $key}selected{/if}>{$category}</option>
										{/foreach}
						            </select>
						            
						            <br/>
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;{if $set_filter}color: #797268;{/if}" class="jquery_tab_title" onclick="showFilters();">{if $set_filter}Filtrowanie - włączone{else}Filtrowanie - wyłączone{/if}</h2>
						            
						            
						            {include file="article_filters.tpl"}
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
											  			$("#info").load("/_panel/article/sortable/?"+order);
											     	}
											});
											$("#order-list").disableSelection();
										});
										</script>
										{/literal}


									
									{include file="article_paging.tpl"}
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">TYTUŁ</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									{if $articles_list}
									
									{foreach from=$articles_list item=article name=article}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
									
									
									  <li id="listItem_{$article.article_id}" style="background-color: {$row_color}">
											  
											  {if $set_filter}
											  <img src="{$path}/images/no-arrow.png" title="Wyczyść filtry aby zmienić kolejność" alt="move" width="16" height="16" class="no-handle"/>
											  {else}
											  <img src="{$path}/images/arrow.png" alt="Przeciągnij aby zmienić kolejność" width="16" height="16" class="handle" />
											  {/if}
											  <div class="name">{$article.title}</div>
											  <div class="date">{$article.date_created|date_format:"%Y-%m-%d"}</div>
											  
											  <div class="options">
											  	{foreach from=$language_list item=language}
														{if $language.id eq $admin_data.language}
														<a href="{$path}/article/edit/{$article.article_id}/{$language.id}"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
														{/if}
												{/foreach}
																				
												{if $CategoryId ne 1 && $CategoryId ne 6}
												
																			                                       
												{if $article.status eq 2}
													<a href="{$path}/article/status/{$article.article_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
												{else}
													<a href="{$path}/article/status/{$article.article_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
												{/if}
												
												{if $CategoryId eq 5} 
													{if $article.sended eq 1}
													<img src="{$path}/images/false_off.png" border="0" title="{$dict_templates.Remove}">
													{else}                                      
													<a href="{$path}/article/remove/{$article.article_id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
													{/if}
													{else}
													<a href="{$path}/article/remove/{$article.article_id}"><img src="{$path}/images/false.png" border="0" title="{$dict_templates.Remove}"></a>
													{/if}
												{/if}
												
												
												
												
															
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
								{include file="article_paging.tpl"}
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