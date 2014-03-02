<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
              
              
              
              
	{include file="head_picture.tpl"}
    
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
                                    <h2 class="jquery_tab_title">Zdjęcia</h2>
                                    <p>{$gallery_details.title}</p>
                                    
                                    
                                    <p>
                                    	<input type="button" class="button" value="Dodaj zdjęcie" onclick="javascript: openwin('{$path}/picture/new/{$gallery_details.product_id}');"/>
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
											  
											  <div class="nametop">Zdjęcie</div>
											  <div class="optionstop">Opcje</div>
									    </li><div class="clrl"></div>
									</ul>
									


									<ul id="order-list">
									
										
								
									{if $picture_list}
									{foreach from=$picture_list item=picture name=picture}
									{cycle name=color assign=row_color values="#EFEFEF ,#EFEFEF"}
										
									 <li style="background-color: {$row_color}">
						 				
										<div style="float: left; width: 30px;">{if !$smarty.foreach.picture.first}<a href="{$path}/picture/up/{$picture.picture_id}/{$picture.category_id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</div>
										<div style="float: left; width: 30px;">{if !$smarty.foreach.picture.last}<a href="{$path}/picture/down/{$picture.picture_id}/{$picture.category_id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</div>
												 				
						 				<div class="name"><img src="{$__CFG.base_url}images/picture/{$picture.picture_id}_01_01.jpg" height="25" alt="{$picture.title}"/>&nbsp;&nbsp;{$picture.title}
											<br/><span style="color: gray; font-size: 10px;">{$picture.date}</span>
										</div>  
										<div class="options" {if $picture.status eq '1'}style="color:#bbbbbb;"{/if}>
											<a href="javascript: openwin('{$path}/picture/edit/{$picture.picture_id}/{$picture.category_id}/');"><img src="{$path}/images/page_white_edit.png" border="0" title="Edytuj zdjęcie"/></a>	
											{if $picture.status eq 2}
												<a href="{$path}/picture/status/{$picture.picture_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
											{else}
												<a href="{$path}/picture/status/{$picture.picture_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
											{/if} 
											<a href="{$path}/picture/remove/{$picture.picture_id}/" onclick="if (!confirm('Czy na pewno chcesz usunąć wybrane zdjęcie?')) return false;"><img src="{$path}/images/false.png" border="0" title="Usuń zdjęcie"></a>

											
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
			var w = 400;
			var h = 520;
			dodanie = window.open(url,'picture','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		function openwin_big(url)
		{
			var w = 800;
			var h = 700;
			dodanie = window.open(url,'picture','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
		}
		
		</script>
		{/literal}
    </body>
    
</html>