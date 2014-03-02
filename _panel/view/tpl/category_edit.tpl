<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="category_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$category.id}Dodaj kategorię{else}Edycja kategorii{/if}</h2>
							   
							    
							    
							    <form class="cmxform" id="signupForm" enctype="multipart/form-data" method="post">
									<input type="hidden" name="category[id]" value="{$category.id}">
									<input type="hidden" name="category[type]" value="{$category.type}">
									<input type="hidden" name="category[parent]" value="{$ParentId|default:"0"}">
									<input type="hidden" name="action" value="SaveCategory">		
									    
							        <p>
							        	W kategorii: <strong>{if $parent.name}{$parent.name}{else}głównej{/if}</strong>
							        </p>
							        <p>
							            <label for="category[title]">Nazwa:</label>
							            <input class="input-big" type="text" value="{$category.name|default:$ret_post.name}" name="category[name]" id="category[name]"/>
							        </p>
							      
							        
							        <p>
							            <label for="category[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="{$category.url_name|default:$ret_post.url_name}" name="category[url_name]" id="category[url_name]"/>
							        	{if $error.url_name}<br/><span style="color: red;">Podany url_name już istnieje.</span>{/if}
							        </p>				
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="category[status]" id="category[status]" >
											<option value="0" {if $category.status eq 0}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="1" {if $category.status eq 1}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							        {if $ParentId eq 0}
									<p>
										<br/>
										<label for="pic_01">Grafika [90px/90px].jpg:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									<br/>
									{if $category.pic_01}
									<p>
										<img src="{$__CFG.base_url}images/category_pictures/{$category.id}_01_01.jpg">
										<input type="checkbox" name="category[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
									{/if}
									{/if}
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


