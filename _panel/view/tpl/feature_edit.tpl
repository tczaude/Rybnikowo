<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="feature_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$feature.id}Dodaj cechę produktu{else}Edycja cechy produktu{/if}</h2>
							   
							    <p><a href="{$__CFG.base_url}szukaj/?cecha={$feature.id}">{$__CFG.base_url}szukaj/?cecha={$feature.id}</a></p>
							    
							    <form class="cmxform" id="signupForm" enctype="multipart/form-data" method="post">
									<input type="hidden" name="feature[id]" value="{$feature.id}">
									<input type="hidden" name="action" value="SaveFeature">		
							        <p>
							            <label for="feature[title]">Nazwa:</label>
							            <input class="input-big" type="text" value="{$feature.name|default:$ret_post.name}" name="feature[name]" id="feature[name]"/>
							        </p>
							        <p>
							           <label for="textarea2">Opis:</label>
							           <textarea name="feature[content]" cols="40" rows="15">{$feature.content|default:$ret_post.content}</textarea>
							        </p>				        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="feature[status]" id="feature[status]" >
											<option value="0" {if $feature.status eq 0}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="1" {if $feature.status eq 1}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
									<p>
										<br/>
										<label for="pic_01">Grafika [330px/150px]:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
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


