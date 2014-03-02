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
                                    <h2 class="jquery_tab_title">Wysyłka</h2>
                                    <p>{$newsletter_details.name}</p>
                                    
                                    
                                    <p>
                                    	<input type="button" class="button" value="{$dict_templates.AddNewDispatch}" onclick="javascript: openwin('{$path}/dispatch/new/{$NewsletterId}');"/>
                                    	<input style="width: 50px;"  onclick="window.close();" value="zamknij" class="button">
						             
                                    </p>
                                    <div id="informacja"></div>
                                    {if $good_message}
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> {$good_message}</p>
									</div>           
                                    {/if}

									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">Wysyłka</div>
											  <div class="optionstop">opcje</div>
									    </li><div class="clrl"></div>
									</ul>
									


									<ul id="order-list">
									
										
								
									{if $dispatch_list}
									{foreach from=$dispatch_list item=dispatch name=dispatch}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
										
									 <li style="background-color: {$row_color}">
											  
										<div class="name">
											{$dispatch.description}
											<br/><span style="color: gray; font-size: 10px;">{$dispatch.date}</span>
										</div>  
										<div class="options" {if $dispatch.status eq '1'}style="color:#bbbbbb;"{/if}>
											<a href="javascript: openwin('{$path}/dispatch/edit/{$dispatch.id}/');"><img src="{$path}/images/page_white_edit.png" border="0" title="Edytuj wysyłkę"/></a>	
											<a href="javascript: openwin('{$path}/dispatch_subscriber/GetDispatchSubscribers/{$dispatch.id}/?NewsletterId={$NewsletterId}');"><img src="{$path}/images/group.png" border="0" title="Wybierz subskrybentów"></a>&nbsp;
											
											{if !$dispatch.status}
											<a href="{$path}/dispatch/remove/{$dispatch.id}/" onclick="if (!confirm('Czy na pewno chcesz usunąć wybraną wysyłkę?')) return false;"><img src="{$path}/images/false.png" border="0" title="Usuń wysyłkę"></a>
											{else}
											&nbsp;
											{/if}
											
											{if !$dispatch.status}
											<a href="javascript: openwin('{$path}/dispatch/send/{$dispatch.id}');"><img src="{$path}/images/email_go.png" border="0" title="Wyślij wysyłkę"></a>&nbsp;
											{else}
											&nbsp;
											{/if}											
										</div>
										<div class="clearboth"></div>
									 </li>
									 
									
									 
									 
									{/foreach}
									{/if}
									
									</ul>

									

                                
                                
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
			var w = 450;
			var h = 520;
			dodanie = window.open(url,'dispatch','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		function openwin_big(url)
		{
			var w = 800;
			var h = 700;
			dodanie = window.open(url,'dispatch','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		</script>
		{/literal}
    </body>
    
</html>