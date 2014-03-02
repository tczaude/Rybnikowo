<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="blog_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$blog.id}Dodaj bloga{else}Edycja bloga{/if}</h2>
							    
							   
							    
							    
									<form id="blogForm" name="BlogEdit" method="post" enctype="multipart/form-data">
									
									<input type="hidden" name="blog_form[language_id]" value="1">
									<input type="hidden" name="blog_form[category_id]" value="1">
									<input type="hidden" name="blog_form[blog_id]" value="{$blog.blog_id}">
									<input type="hidden" name="action" value="SaveBlog">
									
									    
							        <p>
							            <label for="blog_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="{$blog.title|default:$ret_post.title}" name="blog_form[title]" id="blog_form[title]"/>
							        </p>
							      
							        
							        <p>
							            <label for="blog_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="{$blog.url_name|default:$ret_post.url_name}" name="blog_form[url_name]" id="blog_form[url_name]"/>
							        	{if $error.url_name}<br/><span style="color: red;">Podany url_name już istnieje.</span>{/if}
							        </p>							        
							        
							        {if $CategoryId eq 1}
							        <p>
	                                    <label for="selectbox">Typ:</label>
							            <select style="width: 200px;" name="blog_form[type]" id="selectbox">
											<option value="">- wybierz -</option>
											<option value="1" {if $blog.type eq 1}selected{/if}>szkolenia</option>
											<option value="2" {if $blog.type eq 2}selected{/if}>akcje i wydarzenia</option>
							            </select>							        
							        </p>
							        {/if}
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="blog_form[status]" id="blog_form[status]" >
											<option value="1" {if $blog.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="2" {if $blog.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							
							        <p>
	                                    <label for="selectbox">Wybierz kategorię, do której ma być przypisany wpis:</label>
							            <select name="blog_form[author_id]" id="selectbox">
								            <option value="">- wybierz -</option>
												{foreach from=$kind_categories item=category}
												<option value="{$category.id}" {if $blog.author_id eq $category.id}selected{/if}>{$category.name}</option>
												{/foreach}
								            </select>						        
							        
							        </p>							
							        
							        <p>
							           <label for="textarea2">Zajawka:</label>
							           <textarea name="blog_form[abstract]" id="textarea2" cols="40" rows="15">{$blog.abstract|default:$ret_post.abstract}</textarea>
							        </p>

							        <p>
							        	<label for="textarea2">Treść:</label>
							        	{$sSpaw}
							        </p>							        
									
									
									
									
									<p>
										<br/>
										<label for="pic_01">Grafika 1:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									 
									{if $blog.pic_01}
									<p>
										<img src="http://www.rybnikowo.pl/images/blog/{$blog.blog_id}_01_01.jpg">
										<input type="checkbox" name="blog_form[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
									{/if}							        
							        {*
									<p>
										<br/>
										<label for="pic_02">Grafika 2:</label>
										<input class="input-small" type="file" id="pic_02" name="pic_02" />
										
									</p>
									
									{if $blog.pic_02}
									<p>
										<img src="{$__CFG.base_url}images/blog/{$blog.blog_id}_01_02.jpg">
										<input type="checkbox" name="blog_form[remove_picture_02]" value="1">Usuń zdjęcie
									<p>
									{/if}
									
									<p>
										<br/>
										<label for="pic_03">Grafika 3:</label>
										<input class="input-small" type="file" id="pic_03" name="pic_03" />
										
									</p>
									
									{if $blog.pic_03}
									<p>
										<img src="{$__CFG.base_url}images/blog/{$blog.blog_id}_01_03.jpg">
										<input type="checkbox" name="blog_form[remove_picture_03]" value="1">Usuń zdjęcie
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


