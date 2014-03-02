{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}
{*include file="carousels_category_config.tpl"*}


<tr>
	<td align="left">
		<input type="button" style="width:150px;" value="Dodaj nową pozycję" onclick="javascript: openwin('{$path}/carousel/new/1/{$category_id}');">
	</td>
</tr>

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<img src="{$path}/images/kreska_adm_gray.gif" width="960" height="1"><br>
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">

				<table border="0" cellpadding="5" cellspacing="0" width="960">
				

				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="960">
						
						{if $carousels_list}
						
						{foreach from=$carousels_list item=carousel name=carousel}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="90%" align="left" {if $carousel.status ne 2}style="color:#bbbbbb;"{/if}>
								<span style="font-weight:italic;font-size:9px;color:#bbbbbb;">Data utworzenia : {$carousel.date_created|date_format:"%Y-%m-%d"}</span><br>
								{$carousel.title}
							</td>
							
							<td>{if !$smarty.foreach.carousel.first}<a href="{$path}/carousel/up/{$carousel.carousel_id}/{$carousel.category_id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</td>
							<td>{if !$smarty.foreach.carousel.last}<a href="{$path}/carousel/down/{$carousel.carousel_id}/{$carousel.category_id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</td>
							
							<td nowrap align="center">
								{foreach from=$language_list item=language}
									{if $language.id eq $admin_data.language}
									<a href="javascript: openwin('{$path}/carousel/edit/{$carousel.carousel_id}/{$language.id}');"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
									{/if}
								{/foreach}
							</td>
							<td>
								{if $carousel.status eq 2}
								<a href="{$path}/carousel/status/{$carousel.carousel_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
								{else}
								<a href="{$path}/carousel/status/{$carousel.carousel_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
								{/if}
							</td>
							
							<td>
								<a href="{$path}/carousel/remove/{$carousel.carousel_id}"><img src="{$path}/images/cut.png" border="0" title="{$dict_templates.Remove}"></a>
							</td>
							
							
						</tr>
						
						{/foreach}
						
						{else}
						<tr>
							<td colspan="6"><b>{$dict_templates.NoResults}</b></td>
						</tr>
						{/if}
						</table>
					</td>
				</tr>
				</table>
				
				

{literal}		
<script type="text/javascript">

function openwin(url)
{
	var w = 550;
	var h = 900;
	dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
}

function openwin_big(url)
{
	var w = 800;
	var h = 700;
	dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
}
</script>
{/literal}

{include file=foot.tpl}