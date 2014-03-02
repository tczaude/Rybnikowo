{include file=head.tpl}

<link rel="stylesheet" href="css/jsTree.css" type="text/css">

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}

<tr>
	<td align="left">
		<input type="button" value="Dodaj admina" onclick="javascript: openwin('{$path}/admin/new/0');" style="width:150px;">
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
						
						{foreach from=$admin_list item=admin name=admin}
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
							
							<tr bgcolor="{$row_color}" id="row_{$category.id}" onmouseover="changeBg('row_{$category.id}', '#EEEEE1');" onmouseout="changeBg('row_{$category.id}', '#fff');">
								
								<td width="60%" align="left" {if $admin.status ne 1}style="color:#bbbbbb;"{/if}>{$admin.surname} {$admin.name} </td>
								<td align="left" {if $admin.level eq 2}style="color: red;"{/if}>{$admin.email}</td>
								<td align="right">
									{if $admin.status eq 1}
									<a href="{$path}/admin/status/{$admin.id}/0/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="ustaw status niewidoczny"></a>
									{else}
									<a href="{$path}/admin/status/{$admin.id}/1/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="ustaw status widoczny"></a>
									{/if}
								</td>
								<td align="right">
									<img src="{$path}/images/page_white_edit.png" title="edytuj kategorię" onclick="javascript: openwin('{$path}/admin/edit/{$admin.id}');" style="cursor:pointer;">
									<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć wybranego admina?')) window.location='{$path}/admin/remove/{$admin.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>
									
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
	var h = 450;
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