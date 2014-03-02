{include file=head.tpl}

<link rel="stylesheet" href="css/jsTree.css" type="text/css">

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}

<tr>
	<td align="left">
		<input type="button" value="Dodaj nowego autora" onclick="javascript: openwin('{$path}/delivery/new/0');" style="width:150px;">
	</td>
</tr>

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
				
				{*include file="paging_products_search.tpl"*}
			
				<table border="0" cellpadding="5" cellspacing="0" width="960">
			
				<tr>
					<td>
						<table border="0" cellpadding="5" cellspacing="0" width="960">
						
						{foreach from=$deliverys_list item=delivery name=delivery}
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
							
							<tr bgcolor="{$row_color}" id="row_{$category.id}" onmouseover="changeBg('row_{$category.id}', '#EEEEE1');" onmouseout="changeBg('row_{$category.id}', '#fff');">
								
								<td width="90%" align="left"  {if $delivery.status ne 1}style="color:#bbbbbb;"{/if}>{$delivery.name}</td>
								<td>{$delivery.range_from}</td>
								<td>{$delivery.range_to}</td>
								{*
								<td>{if !$smarty.foreach.delivery.first}<a href="{$path}/delivery/up/{$delivery.id}/1"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</td>
								<td>{if !$smarty.foreach.delivery.last}<a href="{$path}/delivery/down/{$delivery.id}/1"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</td>								
								*}
								<td align="right">
									<img src="{$path}/images/page_white_edit.png" title="edytuj kategorię" onclick="javascript: openwin('{$path}/delivery/edit/{$delivery.id}');" style="cursor:pointer;">
									{*<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć autora?')) window.location='{$path}/delivery/remove/{$delivery.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>*}
									
								</td>
							</tr>
							

							
						{/foreach}
		    				
						</table>
					</td>
				</tr>
				</table>

{literal}		
<script type="text/javascript">

function openwin(url)
{
	var w = 550;
	var h = 300;
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