<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="product_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$product.id}Dodaj produkt{else}Edycja produktu{/if}</h2>
							    
							    
							    {*
								{if $product.id}
									{$dict_templates.GetLanguageVersion} :&nbsp;
									{foreach from=$languages_list item=language}
										&nbsp;<a href="{$path}/product/edit/{$product.product_id}/{$language.id}"><img src="{$path}/images/{$language.short}.gif" border="0" title="{$language.short}"></a>&nbsp;
									{/foreach}
								{/if}    
							    *}
							    
							    
							    <form id="productForm" method="post" enctype="multipart/form-data">
									
									
									
									<input type="hidden" name="product_form[language_id]" value="1">
									<input type="hidden" name="product_form[product_id]" value="{$product.product_id}">
									<input type="hidden" name="action" value="SaveProduct">
									
									    
							        <p>
							            <label for="product_form[title]">Nazwa produktu:</label>
							            <input class="input-big" type="text" value="{$product.title|default:$ret_post.title}" name="product_form[title]" id="product_form[title]"/>
							        </p>
							      
							        
							        <p>
							            <label for="product_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="{$product.url_name|default:$ret_post.url_name}" name="product_form[url_name]" id="product_form[url_name]"/>
							        	{if $error.url_name}<br/><span style="color: red;">Podany url_name już istnieje.</span>{/if}
							        </p>							        					        
							        <p>
							           <label for="textarea">Mapa [425px / 350px]:</label>
							           <textarea name="product_form[video]" id="textarea2"  cols="40" rows="15">{$product.video|default:$ret_post.video}</textarea>
							        </p>
							        <p>
	                                    <label for="selectbox">Kategoria:</label>
							            <select name="product_form[category_id]" class="kategoria" id="selectbox2" onchange="loadSeries();">


								            <option value="">- wybierz -</option>
												{foreach from=$product_categories item=category}
													{if $category.sub}
													{foreach from=$category.sub item=sub1}
													{if !$sub1.sub}
													<option value="{$sub1.id}" {if $product.category_id eq $sub1.id}selected{/if}>{$category.name} - {$sub1.name}</option>
													{/if}		
															{if $sub1.sub}
															{foreach from=$sub1.sub item=sub2}
															{if !$sub2.sub}
															<option value="{$sub2.id}" {if $product.category_id eq $sub2.id}selected{/if}>{$category.name} - {$sub1.name} - {$sub2.name}</option>
															{/if}	
																{if $sub2.sub}
																{foreach from=$sub2.sub item=sub3}
																{if !$sub3.sub}
																<option value="{$sub3.id}" {if $product.category_id eq $sub3.id}selected{/if}>{$category.name} - {$sub1.name} - {$sub2.name} - {$sub3.name}</option>
																{/if}
																{/foreach}
																{/if}
															{/foreach}
															{/if}												
													{/foreach}
													{/if}
												{/foreach}
								        </select>						        							        		        
							        </p>							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="product_form[status]" id="product_form[status]" >
											<option value="1" {if $product.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="2" {if $product.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							        <p>
							            <label for="selectbox">Użyteczność publiczna:</label>
							            <select name="product_form[type]" id="product_form[type]" >
							            	<option value="">- wybierz -</option>
											<option value="1" {if $product.type eq 1}selected{/if}>Nie</option>
											<option value="2" {if $product.type eq 2}selected{/if}>Tak</option>
										
							            </select>
							        </p>
							        <p>
							           <label for="textarea2aaaa">Tagi:</label>
							           <textarea name="product_form[tags]" id="textarea2aaaa" class="richtextaaaaa" cols="40" rows="15">{$product.tags|default:$ret_post.tags}</textarea>
							        </p>
							        <p>
							           <label for="textarea2aaaa">Zajawka:</label>
							           <textarea name="product_form[abstract]" id="textarea2aaaa" class="richtextaaaaa" cols="40" rows="15">{$product.abstract|default:$ret_post.abstract}</textarea>
							        </p>
							        <p>
							           <label for="textarea2">Opis działalności:</label>
							          {$sSpaw}
							        </p>
							        <p>
							           <label for="textarea2">Kontakt:</label>
							          {$sSpaw2}
							        </p>									
									
									<p>
										<br/>
										<label for="pic_01">Logo [jpeg, jpg - kwadrat]:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									
									{if $product.pic_01}
									<p>
										<img src="{$__CFG.base_url}images/product/{$product.product_id}_01_01.jpg">
										<input type="checkbox" name="product_form[remove_picture_01]" value="1">Usuń zdjęcie
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


