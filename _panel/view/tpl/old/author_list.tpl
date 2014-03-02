{include file=head.tpl}

<link rel="stylesheet" href="css/jsTree.css" type="text/css">

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}
{if $admin_data.level eq 2}
<tr>
	<td align="left">
		<input type="button" value="Dodaj nowego autora" onclick="javascript: openwin('{$path}/author/new/0');" style="width:150px;">
	</td>
</tr>
{/if}
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
						
						{foreach from=$authors_list item=author name=author}
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
							{if $admin_data.level eq 2}
							<tr align="left" bgcolor="{$row_color}" id="row_{$category.id}" onmouseover="changeBg('row_{$category.id}', '#EEEEE1');" onmouseout="changeBg('row_{$category.id}', '#fff');">
								
								<td  align="left" {if $author.status ne 1}style="color:#bbbbbb;"{/if}>{$author.name}</td>
								<td  {if $author.status ne 1}style="color:#bbbbbb;"{/if}>{$author.publisher_name}</td>
								<td align="right">
									<img src="{$path}/images/page_white_edit.png" title="edytuj autora" onclick="javascript: openwin('{$path}/author/edit/{$author.id}');" style="cursor:pointer;">
									{*<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć autora?')) window.location='{$path}/author/remove/{$author.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>*}
									
								</td>
							</tr>
							{else}
							{if $admin_data.wtz eq $author.id}
							<tr align="left" bgcolor="{$row_color}" id="row_{$category.id}" onmouseover="changeBg('row_{$category.id}', '#EEEEE1');" onmouseout="changeBg('row_{$category.id}', '#fff');">
								
								<td  align="left" {if $author.status ne 1}style="color:#bbbbbb;"{/if}>{$author.name}</td>
								<td  {if $author.status ne 1}style="color:#bbbbbb;"{/if}>{$author.publisher_name}</td>
								<td align="right">
									<img src="{$path}/images/page_white_edit.png" title="edytuj konto" onclick="javascript: openwin('{$path}/author/edit/{$author.id}');" style="cursor:pointer;">
									{*<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć autora?')) window.location='{$path}/author/remove/{$author.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>*}
									
								</td>
							</tr>
							{/if}
							{/if}

							
						{/foreach}
		    				
						</table>
					</td>
				</tr>
				</table>

{literal}		
<script type="text/javascript">

function openwin(url)
{
	var w = 800;
	var h = 600;
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