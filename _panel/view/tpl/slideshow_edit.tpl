<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="slideshow_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$slideshow.id}Dodaj slajd{else}Edycja slajdu{/if}</h2>

							    
							    <form id="slideshowForm" method="post" enctype="multipart/form-data">
									{if $slideshow.id}
									<input type="hidden" name="slideshow_form[category_id]" value="{$slideshow.category_id}">
									{else}
									<input type="hidden" name="slideshow_form[category_id]" value="1">
									{/if}
									
									<input type="hidden" name="slideshow_form[language_id]" value="1">
									<input type="hidden" name="slideshow_form[slideshow_id]" value="{$slideshow.slideshow_id}">
									<input type="hidden" name="action" value="SaveSlideshow">
									
									    
							        <p>
							            <label for="slideshow_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="{$slideshow.title|default:$ret_post.title}" name="slideshow_form[title]" id="slideshow_form[title]"/>
							        </p>
							        <p>
							           <label for="textarea">Link:</label>
							           <input class="input-big" type="text" value="{$slideshow.abstract|default:$ret_post.abstract}" name="slideshow_form[abstract]" id="slideshow_form[abstract]"/>
							        </p>
							        <p>
							            <label for="selectbox">Typ linku:</label>
							            <select name="slideshow_form[sended]" id="slideshow_form[sended]" >
											<option value="1" {if $slideshow.sended eq 1}selected{/if}>wewnętrzny</option>
											<option value="2" {if $slideshow.sended eq 2}selected{/if}>zewnętrzny</option>
										
							            </select>
							        </p>
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="slideshow_form[status]" id="slideshow_form[status]" >
											<option value="1" {if $slideshow.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="2" {if $slideshow.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							        {*
							        <p>
							        	<label for="textarea2">Treść:</label>
							        	{$sSpaw}
							        </p>
							        
							        <p>
							        	<br/>
							            <label for="slideshow_form[price]">Cena [X.XX] PLN:</label>
							            <input class="input-medium" type="text" value="{$slideshow.price|default:$ret_post.price}" name="slideshow_form[price]" id="slideshow_form[price]"/>
							        </p>
							        <p>
							        	<br/>
							            <label for="slideshow_form[link]">Link:</label>
							            <input class="input-medium" type="text" value="{$slideshow.link|default:$ret_post.link}" name="slideshow_form[link]" id="slideshow_form[link]"/>
							        </p>							        
									*}
									
									
									
									<p>
										<br/>
										<label for="pic_01">Zdjęcie [265px/265px]:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									
									<br/>
									
									{if $slideshow.pic_01}
									<p>
										<img src="{$__CFG.base_url}images/slideshow/{$slideshow.slideshow_id}_01_01.jpg">
										<input type="checkbox" name="slideshow_form[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
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


