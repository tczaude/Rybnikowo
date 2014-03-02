<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head_popup.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        
        <div id="top">
        

           	
            	<div>
                
                    <div id="main">
                    
                        <div id="content" style="margin-left: 0px;">
                        
                            <div class="jquery_tab">
                            
                                <div class="content_block">
                                    <h2 class="jquery_tab_title">Wybierz kategorie dla firmy</h2>
                                    <p>[{$product.related_amount}] - {$product.title}</p>
                                    <div id="informacja"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
                                                                    
									<form action="{$path}/related/Search/{$ProductId}/" name="related_search" method="post">
									
									<input type="hidden" id="action" name="action" value="Search">
									<input type="hidden" id="related_page_number" name="related_page_number" value="{$paging.current}">

									nazwa : <input class="input-small"  type="text" name="search_form[name]" value="{$related_filters.name}">&nbsp;&nbsp;<br/>
									<input type="submit" class="button" name="search" value="szukaj">
									{if $set_filter}
									<input type="button" class="button" value="Wyczyść" name="clear_search" onclick="window.location = '{$path}/related/ClearSearch/{$ProductId}/'">
									{/if}
									<input type="button" class="button" value="Tylko powiązane" name="related_only" onclick="window.location = '{$path}/related/RelatedOnly/{$ProductId}/'">

									
									</form>                                   
                                    
						            
						            
						            <br/>
						            
									{include file="product_related_paging.tpl"}
															            
									<ul id="listtop">
										<li class="top">
											  <div class="nametop">Nazwa</div>  
											  <div class="optionstop">Usuń dowiązanie</div>
									    </li><div class="clrl"></div>
									</ul>
									
									<form name="product_form" method="post">
									<input type="hidden" name="ProductId" value="{$ProductId}">   
									<table>
										<tr>
											
											<td>
												<input style="margin-left: 10px;" id="checktest" type="checkbox" onclick="checkUncheckAll(this)">	
											</td>
											<td>
												- zaznacz wszystkie
											</td>
										</tr>
									</table>
																	
									
									
									<ul id="order-list">
									
										
								
									
									{foreach from=$category_list item=category name=category}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
										
									 <li style="background-color: {$row_color}">
											  
										<div style="float: left; margin-left: 15px;" class="options">
										{$category.name}
										</div>
										<div class="clearboth"></div>
									 </li>
									 {if $category.sub}
										{foreach from=$category.sub item=subcategory name=subcategory}
										{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
											
										 <li style="background-color: {$row_color}; padding-left: 40px;">
												  
											<input style="float: left;" type="checkbox" name="related[{$subcategory.id}]" value="1" {if $subcategory.selected}checked{/if}/>
											<div style="float: left; margin-left: 15px;" class="options">
											{$subcategory.name}
											</div>
											<div style="float: right; margin-right: 15px;" class="options">
											<a href="{$path}/related/remove/{$ProductId}/{$subcategory.id}/?PagingCurrent={$paging.current}"><img src="{$path}/images/false.png" border="0" title="Usuń powiązanie"></a>
											</div>
											<div class="clearboth"></div>
										 </li>									 
										{/foreach}
									 {/if}
									 
									{/foreach}

									
									</ul>
									<br/>
									dla wszystkich zaznaczonych :
									<select name="action" class="adm11">
										<option value="AddRelatedProductBulk">dodaj do produktu</option>
										<option value="RemoveRelatedProductBulk">usuń z produktu</option>
									</select>&nbsp;&nbsp;
                                	<input style="float: right; margin: 7px 15px 0 0;" type="submit" value="Zapisz" class="button">
						            </form>
									

                                
                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
                            	</div><!--end content_block-->

                            	
                                 <br/>   
								{include file="product_related_paging.tpl"}
                            	</div><!--end content_block-->                            	
                            	
                            	
                                
                            </div><!--end jquery tab-->								
								

                        </div><!--end content-->
                        
                    </div><!--end main-->
                    

                        
                     </div><!--end bg_wrapper-->
                     <div class="clearboth"></div>

                
        </div><!-- end top -->
		{literal}		
		<script type="text/javascript">
		
		function openwin(url)
		{
			var w = 650;
			var h = 600;
			dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		function openwin_big(url)
		{
			var w = 745;
			var h = 500;
			dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		</script>
		{/literal}
    </body>
    
</html>