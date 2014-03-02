<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head_popup.tpl"}
    
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
        
        
        <div id="top" style="min-width: 420px; max-width: 420px;">
        

           	
            	<div>
                
                    <div id="main">
                    
                        <div id="content" style="margin-left: 0px;">
                        
                            <div class="jquery_tab">
                            
                                <div class="content_block">
                                    <h2 class="jquery_tab_title">Wybierz subskrybentów</h2>
                                    <p>{$product_details.title}</p>
                                    <div id="informacja"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}
									
									<form name="subscriber_form" method="post">
									<input type="hidden" name="DispatchId" value="{$DispatchId}">
									<table style="padding-left: 8px;">
										<tr>
											
											<td>
												<input id="checktest" type="checkbox" onclick="checkUncheckAll(this)">	
											</td>
											<td>
												- zaznacz wszystkie
											</td>
										</tr>
									</table>
																	
									
									
									<ul id="order-list">
									
										
								
									
									{foreach from=$subscriber_list item=subscriber name=subscriber}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
										
									 <li style="background-color: {$row_color}">
											  
										
										<div class="name" style="width: 30px;"><input type="checkbox" name="subscribers[{$subscriber.id}]" value="1" {if $subscriber.selected}checked{/if}>&nbsp;</div>  
										<div {if $subscriber.status eq '0'}style="color:#bbbbbb;"{/if}>
											{$subscriber.name}{$subscriber.surname} {$subscriber.firstname} [{$subscriber.email}]
											
										</div>
										<div class="clearboth"></div>
									 </li>
									 
									
									 
									 
									{/foreach}

									
									</ul>
									<table style="padding-left: 8px;">
										<tr>
											<td colspan="3" height="40" style="border-bottom:1px solid #666666;">
												dla wszystkich zaznaczonych :
												<select name="action">
													<option value="SaveSubscribersForDispatch">ustaw do wysyłki</option>
													<option value="RemoveSubscribers">usuń odbiorców (z serwisu)</option>
												</select>&nbsp;&nbsp;
												
											</td>
										</tr>
									</table>									
									
									

                                	<input style="float: right; margin: 7px 15px 0 0;" type="submit" value="Zapisz" class="button">
						             </form>
									

                                
                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
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