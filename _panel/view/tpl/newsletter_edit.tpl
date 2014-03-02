<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="newsletter_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$newsletter.id}Dodaj nowy newsletter{else}Edycja newslettera{/if}</h2>
							    
							    
							    <form id="newsletterForm" method="post" enctype="multipart/form-data">
									
									<input type="hidden" name="newsletter_form[id]" value="{$newsletter.id}">
									<input type="hidden" name="newsletter_form[language_id]" value="{$newsletter.language_id|default:$language_id}">
									<input type="hidden" name="newsletter_form[status]" value="2">
									<input type="hidden" name="action" value="SaveNewsletter">		
									    
							        <p>
							            <label for="newsletter_form[name]">Tytuł:</label>
							            <input class="input-big" type="text" value="{$newsletter.name|default:$ret_post.name}" name="newsletter_form[name]" id="newsletter_form[title]"/>
							        </p>
							        <p>
							            <label for="selectbox">Sekcja 1:</label>
										<select name="newsletter_form[sections][]" id="newsletter_form[sections][]" class="input-big">
											<option value="0" {if !$newsletter.sections[0]}selected{/if}>-- wybierz --</option>
											{foreach from=$article_list item=article}
											<option value="{$article.article_id}" {if $article.article_id eq $newsletter.sections[0]}selected{/if}>{$article.title}</option>
											{/foreach}
										</select>
							        </p>
							        {*
							        <p>
							            <label for="selectbox">Sekcja 2:</label>
										<select name="newsletter_form[sections][1]" id="newsletter_form[sections][1]">
											<option value="0" {if !$newsletter.sections[0]}selected{/if}>-- wybierz --</option>
											{foreach from=$article_list item=article}
											<option value="{$article.article_id}" {if $article.article_id eq $newsletter.sections[1]}selected{/if}>{$article.title}</option>
											{/foreach}
										</select>
							        </p>						        
									*}
							           
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


