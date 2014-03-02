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
                                    <h2 class="jquery_tab_title">Lista parametrów</h2>
                                    
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
                                    
									<form name="ConfigTableEdit" method="post" >
									
									<input type="hidden" name="action" value="SaveChangeableParameters">
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">TYTUŁ</div>
											  <div class="paramtop">DANE</div>
											  
											  
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
								
									
									{if $parameters_list}
									{foreach from=$parameters_list item=parameter}
									{cycle name=color assign=row_color values="#EFEFEF ,#FFFFFF"}
									
									
									  <li id="listItem_{$article.article_id}" style="background-color: {$row_color}">
											  

											  <div class="name">
											  	{$parameter.name}
											  	<img src="{$path}/images/help.gif" title="{$parameter.description}">
											  </div>
											  <div class="date">
											  	&nbsp;
											  </div>
											  
											  <div class="options">
												<input class="input-medium" type="text" name="config_form[{$parameter.name}]" value='{$parameter.content|default:$ret_post.content}' id="url"/>
											
											</div>
										<div class="clearboth"></div>
									  </li>
									{/foreach}
									
							        
							            
							      



									{else}
									
									<li>Brak wyników</li>
									
									{/if}
									
									</ul>
						            <br/>
						            <input class="button" name="submit" type="submit" value="Zapisz"/>
									
									{*	
	                                <div id="summary">PODSUMOWANIE</div>
	                                *}
                                
                                
                                </form>
                                <div class="clearboth" style="height: 20px;"></div>  
                                
                                      
                                    
								
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