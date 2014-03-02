<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        
        
        {include file="user_validate.tpl"}
        
        *}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$user.id}Dodaj użytkownika{else}Edycja użytkownia{/if}</h2>
							    
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}							    
							    
							    <form id="userForm" method="post" enctype="multipart/form-data">
									
									<input type="hidden" name="user_form[id]" value="{$user.id}">
									<input type="hidden" name="action" value="SaveUser">
									<input type="hidden" name="user_form[email_old]" value="{$user.email}">
									    
							        <p>
							            <label for="user_form[surname]">Nazwisko:</label>
							            <input class="input-medium" type="text" value="{$user.surname|default:$ret_post.surname}" name="user_form[surname]" id="user_form[surname]"/>
							        </p>
							        <p>
							            <label for="user_form[name]">Imię:</label>
							            <input class="input-medium" type="text" value="{$user.name|default:$ret_post.name}" name="user_form[name]" id="_formuser[name]"/>
							        </p>
							        <p>
							            <label for="user_form[company]">Firma:</label>
							            <input class="input-medium" type="text" value="{$user.company|default:$ret_post.company}" name="user_form[company]" id="user_form[company]"/>
							        </p>
							        <p>
							            <label for="user_form[nip]">Nip:</label>
							            <input class="input-medium" type="text" value="{$user.nip|default:$ret_post.nip}" name="user_form[nip]" id="user_form[nip]"/>
							        </p>
							        
							        <p>
							            <label for="user_form[street]">Adres:</label>
							            <input class="input-medium" type="text" value="{$user.street|default:$ret_post.street}" name="user_form[street]" id="user_form[street]"/>
							        </p>
							        <p>
							            <label for="user_form[zipcode]">Kod pocztowy:</label>
							            <input class="input-medium" type="text" value="{$user.zipcode|default:$ret_post.zipcode}" name="user_form[zipcode]" id="user_form[zipcode]"/>
							        </p>
							        <p>
							            <label for="user_form[city]">Miejscowość:</label>
							            <input class="input-medium" type="text" value="{$user.city|default:$ret_post.city}" name="user_form[city]" id="user_form[city]"/>
							        </p>								      
							        <p>
							            <label for="user_form[email]">Email:</label>
							            <input class="input-medium" type="text" value="{$user.email|default:$ret_post.email}" name="user_form[email]" id="user_form[email]"/>
							        </p>
							        <p>
							            <label for="user_form[phone]">Telefon:</label>
							            <input class="input-medium" type="text" value="{$user.phone|default:$ret_post.phone}" name="user_form[phone]" id="user_form[phone]"/>
							        </p>							        
							        <p>
							            <label for="user_form[password]">Hasło:</label>
							            <input class="input-medium" type="text" value="{$user.password|default:$ret_post.password}" name="user_form[password]" id="user_form[password]"/>
							        </p>	
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="user_form[status]" id="user_form[status]" >
											<option value="0" {if $user.status eq 0}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="1" {if $user.status eq 1}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
							        <p>
							            <label for="user_form[newsletter]">Newsletter:</label>
							            <input type="checkbox" {if $user.newsletter eq 1|| $ret_post.newsletter eq 1}checked="checked"{/if}value="1" name="user_form[newsletter]" id="user_form[newsletter]"/>
							        </p>							        
							        <p>
							            <label for="user_form[bonus]">Zebrane punkty bonusowe:</label>
							            <input class="input-small" type="text" value="{$user.bonus|default:$ret_post.bonus}" name="user_form[bonus]" id="user_form[bonus]"/>
							        </p>							

							        <p>
							        	<span>Ilość zamówień: {$user.order_count}</span><br/>
							        	<span>Wartość zamówień: {$user.order_summary}</span><br/>
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


