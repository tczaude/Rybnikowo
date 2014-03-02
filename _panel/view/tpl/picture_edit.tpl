<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	{include file="head_picture.tpl"}
 {if $close}
<script language="JavaScript">
	window.opener.location = '{$location}';
	window.close();
</script>
{/if}   
    <body>
    	
		{include file="picture_validate.tpl"}
        <div id="top" style="max-width: 300px; min-width: 300px;">
        

           	
            	<div>
                
                    <div id="main">
                    
                        <div id="content" style="margin-left: 0px;">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title">{if !$picture.id}Dodawanie zdjęcia{else}Edycja zdjęcia{/if}</h2>

							    
							    <form id="pictureForm" method="post" enctype="multipart/form-data">

									{if $picture.id}
									<input type="hidden" name="picture_form[category_id]" value="{$url_config.4}">
									{else}
									<input type="hidden" name="picture_form[category_id]" value="{$url_config.3}">
									{/if}									
									
								
									<input type="hidden" name="picture_form[language_id]" value="{$picture.language_id|default:$language_id}">
									<input type="hidden" name="picture_form[picture_id]" value="{$picture.picture_id}">
									<input type="hidden" name="action" value="SavePicture">
									
									    
							        <p>
							            <label for="picture_form[title]">Nazwa:</label>
							            <input class="input-medium" type="text" value="{$picture.title|default:$ret_post.title}" name="picture_form[title]" id="picture_form[title]"/>
							        </p>
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="picture_form[status]" id="picture_form[status]" >
											<option value="1" {if $picture.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
											<option value="2" {if $picture.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
										
							            </select>
							        </p>
									{*
							        <p>
							           <label for="textarea2">Opis:</label>
							           <textarea style="width: 240px;" name="picture_form[abstract]" id="textarea2" class="richtext" cols="40" rows="15">{$picture.abstract|default:$ret_post.abstract}</textarea>
							        </p>
							        *}
							        <p>
							            <label for="picture_form[podpis]">Podpis:</label>
							            <input class="input-big" type="text" value="{$picture.podpis|default:$ret_post.podpis}" name="picture_form[podpis]" id="picture_form[podpis]"/>
							        </p>	
									<p>
										<br/>
										<label for="pic_01">Grafika 1:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									
									{if $picture.pic_01}
									<p>
										<img src="{$__CFG.base_url}images/picture/{$picture.picture_id}_01_01.jpg">
										<input type="checkbox" name="picture_form[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
									{/if}							        

							        <p>
							            <input class="button" name="submit" type="submit" value="Zapisz"/>
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