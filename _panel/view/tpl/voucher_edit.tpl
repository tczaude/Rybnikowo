<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="voucher_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$voucher.id}Dodaj kod rabatowy{else}Edycja kodu rabatowego{/if}</h2>
							    
							    
							    
							    <form id="voucherForm" method="post" enctype="multipart/form-data">

									<input type="hidden" name="voucher_form[id]" value="{$voucher.id}">
									<input type="hidden" name="action" value="SaveVoucherFromAdmin">

									    
							        <p>
							            <label for="bonus_code">Kod:</label>
							            <input class="input-small" type="text" value="{$voucher.bonus_code|default:$ret_post.bonus_code}" name="voucher_form[bonus_code]" id="bonus_code"/>
							        	{if $error.bonus_code}
							        	<br><span htmlfor="voucher_form[bonus_code]" generated="true" class="error">{$error.bonus_code}</span>
							        	{/if}
							        	<a href="#" onClick="getPassword('6','bonus_code');">generuj</a>
							        </p>
							        <p>
							            <label for="bonus_value">Wartość [x.00]:</label>
							            <input class="input-small" type="text" value="{$voucher.value|default:$ret_post.value}" name="voucher_form[value]" id="bonus_value"/>
							        </p>
							        {if $voucher.id}
							        {if $voucher.fb_user_name}						        
							        <p>
							            <label for="voucher_form[fb_user_name]">Imię z FB:</label>
							            <input type="hidden" name="voucher_form[fb_user_name]" value="{$voucher.fb_user_name}" id="voucher_form[fb_user_name]"/>
							            <span>{$voucher.fb_user_name}</span>
							        </p>	
							        {/if}
							        
							        {if $voucher.fb_user_email}						        
							        <p>
							            <label for="voucher_form[fb_user_email]">Adres email z FB:</label>
							            <input type="hidden" name="voucher_form[fb_user_email]" value="{$voucher.fb_user_email}" id="voucher_form[fb_user_email]"/>
							            <span>{$voucher.fb_user_email}</span>
							        </p>	
							        {/if}
							        
							        {if $voucher.fb_user_access_token}						        
							        <p>
							            <label for="voucher_form[fb_user_access_token]">Token z FB:</label>
							            <input type="hidden" name="voucher_form[fb_user_access_token]" value="{$voucher.fb_user_access_token}" id="voucher_form[fb_user_access_token]"/>
							            <span>{$voucher.fb_user_access_token}</span>
							        </p>	
							        {/if}
							        {/if}
							        <p>
										<label for="date">Data utworzenia:</label>
										<input class="input-small flexy_datepicker_input" type="text" value="{$voucher.creation_date|date_format:"%Y-%m-%d"|default:$ret_post.creation_date|date_format:"%Y-%m-%d"}" name="voucher_form[creation_date]" id="date"/>	
							        </p>
							        <p>
										<label for="date2">Data ważności:</label>
										<input class="input-small flexy_datepicker_input" type="text" value="{$voucher.end_date|date_format:"%Y-%m-%d"|default:$ret_post.end_date|date_format:"%Y-%m-%d"}" name="voucher_form[end_date]" id="date2"/>	
							        </p>
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="voucher_form[status]" id="voucher_form[status]" >
											<option value="1" {if $voucher.status eq 1}selected{/if}>Aktywny</option>
											<option value="2" {if $voucher.status eq 2}selected{/if}>Nieaktywny</option>
										
							            </select>
							        </p>
							        <p>
							            <label for="selectbox">Wielorazowy:</label>
							            <select name="voucher_form[again]" id="voucher_form[again]" >
							            	<option value="">- wybierz -</option>
											<option value="1" {if $voucher.again eq 1}selected{/if}>Nie</option>
											<option value="2" {if $voucher.again eq 2}selected{/if}>Tak</option>
										
							            </select>
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


