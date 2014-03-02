<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head_popup.tpl"}
 {if $close}
<script language="JavaScript">
	window.opener.location = '{$location}';
	window.close();
</script>
{/if}   
    <body>
    	
    	{*
    	{include file="popup_message.tpl"}
        *}
		{include file="dispatch_validate.tpl"}
        <div id="top" style="max-width: 400px; min-width: 400px;">
        

           	
            	<div>
                
                    <div id="main">
                    
                        <div id="content" style="margin-left: 0px;">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$dispatch.id}{$dict_templates.AddNewDispatchHeader}{else}{$dict_templates.EditDispatchHeader}{/if}</h2>

							    
							    <form id="dispatchForm" enctype="multipart/form-data" method="post" action="">
									<p>	
										{if !$dispatch.id}
										<input type="hidden" name="dispatch[newsletter_id]" value="{$NewsletterId}">
										{else}
										<input type="hidden" name="dispatch[newsletter_id]" value="{$dispatch.newsletter_id}">
										{/if}
										<input type="hidden" name="dispatch[id]" value="{$dispatch.id}">
										<input type="hidden" name="action" value="SaveDispatch">	
									</p>

							        <p>
										<label for="date">{$dict_templates.DispatchDate}:</label>
										<input class="input-medium" type="text" value="{$dispatch.date|default:$ret_post.date}" name="dispatch[date]" id="date"/>	
								        {literal}
										<script type="text/javascript">$('#date').datetimepicker();</script>
										{/literal}
							        
							        </p>
							        <p>
							            <label for="dispatch[description]">{$dict_templates.DispatchDescription}:</label>
							            <input class="input-medium" type="text" value="{$dispatch.description|default:$ret_post.description}" name="dispatch[description]" id="dispatch[description]"/>
							        </p>
							        {*
							        <p>
							            <label for="selectbox">{$dict_templates.DispatchDescription}:</label>
										
										<textarea rows="15" cols="40" name="dispatch[description]"  class="zaj">{$dispatch.description|default:$ret_post.description}</textarea>
					
							        </p>
						        	*}

							           
							        <p>
							            <input class="button" name="submit" type="submit" value="Zapisz"/>
							            <input style="width: 50px;"  onclick="window.close();" value="Zamknij" class="button">
							        </p>
							    </form>
							    
							</div><!--end content_block-->
							    
							</div><!--end jquery tab-->								
								

                        </div><!--end content-->
                        
                    </div><!--end main-->
                    

                        
                     </div><!--end bg_wrapper-->
                     <div class="clearboth"></div>

                
        </div><!-- end top -->
        
        {literal}
        		
		
<script type="text/javascript">$('#example1').datetimepicker();
</script>

{/literal}
		{literal}	
		
		<script type="text/javascript">
		
		function openwin(url)
		{
			var w = 450;
			var h = 250;
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