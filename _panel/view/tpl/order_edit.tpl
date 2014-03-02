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
							    <h2 class="jquery_tab_title">Podgląd zamówienia nr: (<span style="color: black;">{$order.id}</span>) - {$order.date_created}</h2>
								
								<h4>Dane klienta:</h4>    
						        <p>
						            Imię i nazwisko: <span><strong><a href="{$path}/user/edit/{$order.user_details.id}/">{$order.user_details.surname} {$order.user_details.name}</a></strong></span><br/>
						            Adres: <span><strong>{$order.user_details.street}, {$order.user_details.zipcode} {$order.user_details.city}</strong></span><br/>
						        	Faktura VAT: <span><strong>{if $order.invoice eq 1}<span style="color: red;">TAK</span>{else}<span style="color: black;">NIE{/if}</strong></span><br/>
						        </p>
						        <h4>Dane firmowe:</h4> 
						        <p>
						            Firma: <span><strong>{if $order.user_details.company}<span style="color: red;">{$order.user_details.company}</span>{else}-{/if}</strong></span><br/>						        
						            NIP: <span><strong>{if $order.user_details.nip}<span style="color: red;">{$order.user_details.nip}</span>{else}-{/if}</strong></span><br/>
						        </p>
						        
						        
							    <h4>Dane kontaktowe:</h4>
						        <p>
						            Telefon: <span><strong>{$order.user_details.phone} </strong></span><br/>
						            Adres e-mail: <span><strong><a href="mailto:{$order.user_details.email}">{$order.user_details.email}</a></strong></span><br/>
						        </p>
						        							    
							    <h4>Dostawa:</h4>
						        <p>
						            Forma transportu: <span><strong>{if $order.delivery eq 1}kurier - wpłata na konto{elseif $order.delivery eq 2}kurier - płatnośc online{elseif $order.delivery eq 3}kurier - pobranie{elseif $order.delivery eq 4}poczta - wpłata na konto{elseif $order.delivery eq 5}poczta - płatnośc online{elseif $order.delivery eq 6}poczta - pobranie{elseif $order.delivery eq 7}odbiór własny - płatne przy odbiorze{elseif $order.delivery eq 8}list polecony - wpłata na konto{elseif $order.delivery eq 9}list polecony - płatnośc online{/if}</strong></span><br/>
						            Firma: <span><strong>{if $order.company}<span style="color: red;">{$order.company}</span>{else}-{/if}</strong></span><br/>			            
						            Adres: <span><strong>{$order.surname} {$order.name} - {$order.street}, {$order.zipcode} {$order.city}</strong></span><br/>
						        </p>
							    <h4>Zamawiane produkty:</h4>
						        <p>
						        	{foreach from=$order.details item=product name=product}
						        	
						        	<span>{$smarty.foreach.product.iteration}.<strong><a href="{$__CFG.base_url}pozycja/{$product.url_name}/" target="_blank">{$product.name}</a></strong></span>&nbsp;&nbsp;&nbsp;{$product.quantity|string_format:"%.0f"}&nbsp;   x {$product.price} = {$product.value} PLN<br/>
						        	
						        	{/foreach}

						        </p>						        							    
							    <h4>Podsumowanie:</h4>
						        <p>
						        Wartość: <strong>{$order.value_pln} PLN</strong><br/>
						        Dostawa: <strong>{$order.costs|string_format:"%.2f"} PLN</strong><br/>
						        RAZEM: <strong>{$order.to_pay} PLN</strong><br/><br/>
						        
						        Uwagi: <strong style="color: red;">{$order.description}</strong><br/>
						        
						        {if $order.transaction_status}
						        
						        platnosci.pl: <strong style="color: purple;">{$dict_templates.transaction_message[$order.transaction_status].name}</strong><br/>
						        
						        {/if}
						        
						        
								</p>							    
							    
							    
									<form id="bonusForm" method="post" enctype="multipart/form-data">

										<input type="hidden" name="order_form[order_id]" value="{$order.id}"/>
										<input type="hidden" name="action" value="SaveOrder"/>
									
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="order_form[status]" id="order_form[status]" >
							            {foreach from=$dict_templates.status_message item=status}
											<option value="{$status.id}" {if $order.status eq $status.id}selected{/if}>{$status.name}</option>
										{/foreach}
							            </select>
							        </p>							
								    <p>
							           <label for="order_form[message]">Wiadomość:</label>
							           <textarea name="order_form[message]" id="order_form[message]" class="richtext" cols="40" rows="15">{$order.abstract|default:$ret_post.abstract}</textarea>
							        </p>
							        <p>
							        	<label for="order_form[send]">Wyślij powiadomienie klientowi:</label>
							        	<input type="checkbox" name="order_form[send]" value="1"/>
							        </p>
							        <p>
							        	<label for="order_form[send]">Zapisz:</label>
							        	<input type="checkbox" name="order_form[save]" value="1"/>
							        </p>							        
							        {if $message_list}
							        <p>
							        {foreach from=$message_list item=message}
							        <span style="color: gray;">{$message.date_created}</span><br/>
							        <span>{$message.message}</span><br/><br/>
							        {/foreach}
							        
							        </p>
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


