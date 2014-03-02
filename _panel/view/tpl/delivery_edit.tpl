<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        {include file="delivery_validate.tpl"}
        
        <div id="top">
        
			{include file="header.tpl"}
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$delivery.id}Dodaj zakres{else}Edycja zakresu{/if}</h2>
							    
							    <form id="deliveryForm" method="post" enctype="multipart/form-data">
									<input type="hidden" name="delivery_form[id]" value="{$delivery.id}">
									<input type="hidden" name="action" value="SaveDelivery">
									
									    
							        <p>
							            <label for="delivery_form[name]">Nazwa zakresu:</label>
							            <input class="input-big" type="text" value="{$delivery.name|default:$ret_post.name}" name="delivery_form[name]" id="delivery_form[name]"/>
							        </p>
							      
							        
							        <p>
							            <label for="delivery_form[range_from]">Od [x.xx kg]:</label>
							            <input class="input-small" type="text" value="{$delivery.range_from|default:$ret_post.range_from}" name="delivery_form[range_from]" id="delivery_form[range_from]"/>
							        	{if $error.range_from}<br/><span style="color: red;">Podany range_from już istnieje.</span>{/if}
							        </p>						        
							        <p>
							            <label for="delivery_form[range_to]">Do [x.xx kg]:</label>
							            <input class="input-small" type="text" value="{$delivery.range_to|default:$ret_post.range_to}" name="delivery_form[range_to]" id="delivery_form[range_to]"/>
							        	{if $error.range_to}<br/><span style="color: red;">Podany range_to już istnieje.</span>{/if}
							        </p>
							        <p>
							            <label for="delivery_form[price]">Koszt:</label>
							            <input class="input-small" type="text" value="{$delivery.price|default:$ret_post.price}" name="delivery_form[price]" id="delivery_form[price]"/>
							        </p>
							        
							        {*
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="delivery_form[status]" id="delivery_form[status]" >
											<option value="1" {if $delivery.status eq 1}selected{/if}>{$dict_templates.deliveryUnPublished}</option>
											<option value="2" {if $delivery.status eq 2}selected{/if}>{$dict_templates.deliveryPublished}</option>
										
							            </select>
							        </p>
									
							        <p>
							           <label for="textarea2">Zajawka:</label>
							           <textarea name="delivery_form[abstract]" id="textarea2" class="richtext" cols="40" rows="15">{$delivery.abstract|default:$ret_post.abstract}</textarea>
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


