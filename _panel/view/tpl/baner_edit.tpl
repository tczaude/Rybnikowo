<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="baner_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$baner.id}Dodaj slajd{else}Edycja slajdu{/if}</h2>

							    
							    <form id="banerForm" method="post" enctype="multipart/form-data">
									{if $baner.id}
									<input type="hidden" name="baner_form[category_id]" value="{$baner.category_id}">
									{else}
									<input type="hidden" name="baner_form[category_id]" value="1">
									{/if}
									
									<input type="hidden" name="baner_form[language_id]" value="1">
									<input type="hidden" name="baner_form[baner_id]" value="{$baner.baner_id}">
									<input type="hidden" name="action" value="SaveBaner">
									
									    
							        <p>
							            <label for="baner_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="{$baner.title|default:$ret_post.title}" name="baner_form[title]" id="baner_form[title]"/>
							        </p>

							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="baner_form[status]" id="baner_form[status]" >
											<option value="1" {if $baner.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="2" {if $baner.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							        <p>
							        	<br/>
							            <label for="baner_form[link]">Link:</label>
							            <input class="input-medium" type="text" value="{$baner.link|default:$ret_post.link}" name="baner_form[link]" id="baner_form[link]"/>
							        </p>
							        {*
							        <p>
							           <label for="textarea">Kod:</label>
							           <textarea name="baner_form[abstract]" id="textarea2"  cols="40" rows="15">{$baner.abstract|default:$ret_post.abstract}</textarea>
							        </p>
							        <p>
							        	<label for="textarea2">Treść:</label>
							        	{$sSpaw}
							        </p>
							        
							        <p>
							        	<br/>
							            <label for="baner_form[price]">Cena [X.XX] PLN:</label>
							            <input class="input-medium" type="text" value="{$baner.price|default:$ret_post.price}" name="baner_form[price]" id="baner_form[price]"/>
							        </p>
							        
									*}
									
									
									
									<p>
										<br/>
										<label for="pic_01">Grafika 1 [200px/130px]:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									
									<br/>
									
									{if $baner.pic_01}
									<p>
										<img src="{$__CFG.base_url}images/producer/{$baner.baner_id}_01_01.jpg">
										<input type="checkbox" name="baner_form[remove_picture_01]" value="1">Usuń zdjęcie
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


