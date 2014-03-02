<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="article_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$article.id}Dodaj artykuł{else}Edycja artykułu{/if}</h2>
							    
							    
							    {*
								{if $article.id}
									{$dict_templates.GetLanguageVersion} :&nbsp;
									{foreach from=$languages_list item=language}
										&nbsp;<a href="{$path}/article/edit/{$article.article_id}/{$language.id}"><img src="{$path}/images/{$language.short}.gif" border="0" title="{$language.short}"></a>&nbsp;
									{/foreach}
								{/if}    
							    *}
							    
							    
							    <form id="articleForm" method="post" enctype="multipart/form-data">
									{if $article.id}
									<input type="hidden" name="article_form[category_id]" value="{$article.category_id}">
									{else}
									<input type="hidden" name="article_form[category_id]" value="{$CategoryId}">
									{/if}
									
									<input type="hidden" name="article_form[language_id]" value="1">
									<input type="hidden" name="article_form[article_id]" value="{$article.article_id}">
									<input type="hidden" name="action" value="SaveArticle">
									
									    
							        <p>
							            <label for="article_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="{$article.title|default:$ret_post.title}" name="article_form[title]" id="article_form[title]"/>
							        </p>
							      
							        {if $CategoryId eq 2 | $CategoryId eq 3}
							        <p>
							            <label for="article_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="{$article.url_name|default:$ret_post.url_name}" name="article_form[url_name]" id="article_form[url_name]"/>
							        	{if $error.url_name}<br/><span style="color: red;">Podany url_name już istnieje.</span>{/if}
							        </p>	
							        {/if}						        
							        {*
							        {if $CategoryId eq 2 | $CategoryId eq 3}
							        <p>
	                                    <label for="selectbox">Typ:</label>
							            <select style="width: 200px;" name="article_form[type]" id="selectbox">
											<option value="">- wybierz -</option>
											<option value="1" {if $article.type eq 1}selected{/if}>szkolenia</option>
											<option value="2" {if $article.type eq 2}selected{/if}>akcje i wydarzenia</option>
							            </select>							        
							        </p>
							        {/if}
							        						        
							        <p>
										<label for="date">Data utworzenia:</label>
										<input class="input-small flexy_datepicker_input" type="text" value="{$article.date_created|date_format:"%Y-%m-%d"|default:$ret_post.date_created|date_format:"%Y-%m-%d"}" name="article_form[date_created]" id="date"/>	
							        </p>
							        *}
							        {if $CategoryId eq 2 | $CategoryId eq 3}
							        <p>
	                                    <label for="selectbox">Wybierz kategorię:</label>
							            <select style="width: 200px;" name="article_form[category_id]" id="selectbox">
											{foreach from=$dict_templates.article_category item=category key=key}
											<option value="{$key}" {if $CategoryId eq $key}selected{/if}>{$category}</option>
											{/foreach}
							            </select>							        
							        
							        </p>
							        
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="article_form[status]" id="article_form[status]" >
											<option value="1" {if $article.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="2" {if $article.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
									{/if}
							
							        {*
							        <p>
							           <label for="textarea2">Zajawka:</label>
							           <textarea name="article_form[abstract]" id="textarea2" class="richtext" cols="40" rows="15">{$article.abstract|default:$ret_post.abstract}</textarea>
							        </p>
									*}
							        <p>
							        	<label for="textarea2">Treść:</label>
							        	{$sSpaw}
							        </p>
							        {*
							        <p>
							        	<br/>
							            <label for="article_form[podpis]">Podpis:</label>
							            <input class="input-small" type="text" value="{$article.podpis|default:$ret_post.podpis}" name="article_form[podpis]" id="article_form[podpis]"/>
							        </p>							        
									*}
									
									{*
									{if $CategoryId ne 4}
									<p>
										<br/>
										<label for="pic_01">Grafika 1:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									{else}
									<br/>
									{/if}
									{if $article.pic_01}
									<p>
										<img src="{$__CFG.base_url}images/article/{$article.article_id}_01_01.jpg">
										<input type="checkbox" name="article_form[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
									{/if}							        
							        
									<p>
										<br/>
										<label for="pic_02">Grafika 2:</label>
										<input class="input-small" type="file" id="pic_02" name="pic_02" />
										
									</p>
									
									{if $article.pic_02}
									<p>
										<img src="{$__CFG.base_url}images/article/{$article.article_id}_01_02.jpg">
										<input type="checkbox" name="article_form[remove_picture_02]" value="1">Usuń zdjęcie
									<p>
									{/if}
									
									<p>
										<br/>
										<label for="pic_03">Grafika 3:</label>
										<input class="input-small" type="file" id="pic_03" name="pic_03" />
										
									</p>
									
									{if $article.pic_03}
									<p>
										<img src="{$__CFG.base_url}images/article/{$article.article_id}_01_03.jpg">
										<input type="checkbox" name="article_form[remove_picture_03]" value="1">Usuń zdjęcie
									<p>
									{/if}						        
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


