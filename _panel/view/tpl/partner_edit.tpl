<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="partner_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$partner.id}Dodaj partnera{else}Edycja partnera{/if}</h2>
							    
							   
							    
							    
									<form id="partnerForm" name="PartnerEdit" method="post" enctype="multipart/form-data">
									
									<input type="hidden" name="partner_form[language_id]" value="1">
									<input type="hidden" name="partner_form[category_id]" value="1">
									<input type="hidden" name="partner_form[partner_id]" value="{$partner.partner_id}">
									<input type="hidden" name="action" value="SavePartner">
									
									    
							        <p>
							            <label for="partner_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="{$partner.title|default:$ret_post.title}" name="partner_form[title]" id="partner_form[title]"/>
							        </p>
							      
							        
							        <p>
							            <label for="partner_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="{$partner.url_name|default:$ret_post.url_name}" name="partner_form[url_name]" id="partner_form[url_name]"/>
							        	{if $error.url_name}<br/><span style="color: red;">Podany url_name już istnieje.</span>{/if}
							        </p>							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="partner_form[status]" id="partner_form[status]" >
											<option value="1" {if $partner.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="2" {if $partner.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							        <p>
							           <label for="textarea2">Link [http://www.onet.pl]:</label>
							           <input class="input-big" type="text" value="{$partner.abstract|default:$ret_post.abstract}" name="partner_form[abstract]" id="partner_form[abstract]"/>
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
									 
									{if $partner.pic_01}
									<p>
										<img src="http://www.rybnikowo.pl/images/partner/{$partner.partner_id}_01_01.jpg">
										<input type="checkbox" name="partner_form[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
									{/if}							        
							        {*
									<p>
										<br/>
										<label for="pic_02">Grafika 2:</label>
										<input class="input-small" type="file" id="pic_02" name="pic_02" />
										
									</p>
									
									{if $partner.pic_02}
									<p>
										<img src="{$__CFG.base_url}images/partner/{$partner.partner_id}_01_02.jpg">
										<input type="checkbox" name="partner_form[remove_picture_02]" value="1">Usuń zdjęcie
									<p>
									{/if}
									
									<p>
										<br/>
										<label for="pic_03">Grafika 3:</label>
										<input class="input-small" type="file" id="pic_03" name="pic_03" />
										
									</p>
									
									{if $partner.pic_03}
									<p>
										<img src="{$__CFG.base_url}images/partner/{$partner.partner_id}_01_03.jpg">
										<input type="checkbox" name="partner_form[remove_picture_03]" value="1">Usuń zdjęcie
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


