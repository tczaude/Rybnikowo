<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="producer_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$producer.id}Dodaj kategorię wg producenta{else}Edycja kategorii wg producenta{/if}</h2>
							   
							    
							    
							    <form class="cmxform" id="signupForm" enctype="multipart/form-data" method="post">
									<input type="hidden" name="producer[id]" value="{$producer.id}">
									<input type="hidden" name="producer[parent]" value="{$ParentId|default:"0"}">
									<input type="hidden" name="action" value="SaveProducer">		
									    
							        <p>
							        	W kategorii: <strong>{if $parent.name}{$parent.name}{else}głównej{/if}</strong>
							        </p>
							        <p>
							            <label for="producer[title]">Nazwa:</label>
							            <input class="input-big" type="text" value="{$producer.name|default:$ret_post.name}" name="producer[name]" id="producer[name]"/>
							        </p>
							      
							        
							        <p>
							            <label for="producer[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="{$producer.url_name|default:$ret_post.url_name}" name="producer[url_name]" id="producer[url_name]"/>
							        	{if $error.url_name}<br/><span style="color: red;">Podany url_name już istnieje.</span>{/if}
							        </p>				
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="producer[status]" id="producer[status]" >
											<option value="0" {if $producer.status eq 0}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="1" {if $producer.status eq 1}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							        <p>
							            <input class="button" name="submit" type="submit" value="Zapisz"/>
							        </p>
							    </form>
							    
							</div><!--end content_block-->
							    
							</div><!--end jquery tab-->						
								

                        </div><!--end content-->
                        
                    </div><!--end main-->
                    
					{include file="menu.tpl"}
                        
                     </div><!--end bg_wrapper-->
                     
                <div id="footer">
                
                </div><!--end footer-->
                
        </div><!-- end top -->
        
    </body>
    
</html>


