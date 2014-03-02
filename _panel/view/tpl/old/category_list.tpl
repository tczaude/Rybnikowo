{include file=head.tpl}


<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}

<tr>
	<td align="left">
		<input type="button" value=" {$dict_templates.AddNewCategory} " onclick="javascript: openwin('{$path}/category/new/0');" style="width:150px;">
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
						<table border="0" cellpadding="5" align="left" cellspacing="0" width="960">
						
						{foreach from=$menu_categories item=category name=category}
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
							
							<tr bgcolor="{$row_color}" id="row_{$category.id}">
								
								<td align="left"  {if $category.status ne 1}style="color:#bbbbbb;"{/if}>{$category.name}</td>
								<td align="left" width="20">{if !$smarty.foreach.category.first}<a href="{$path}/category/up/{$category.id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</td>
								<td align="left" width="20">{if !$smarty.foreach.category.last}<a href="{$path}/category/down/{$category.id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</td>

								<td align="right">
									<img src="{$path}/images/page_white_edit.png" title="edytuj kategorię" onclick="javascript: openwin('{$path}/category/edit/{$category.url_name}');" style="cursor:pointer;">
									<img src="{$path}/images/page_white_magnify.png" title="dodaj nową subkategorię" onclick="javascript: openwin('{$path}/category/new/{$category.id}');" style="cursor:pointer;">
									<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć wybraną kategorię?')) window.location='{$path}/category/remove/{$category.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>
									
								</td>
							</tr>
							
							{if $category.sub} 
							 
								{foreach from=$category.sub item=sub1}
									<tr id="row_{$sub1.id}">
										<td align="left" style="padding-left:30px;{if $sub1.status ne 1} color:#bbbbbb;{/if}">&raquo; {$sub1.name}</td>
										<td width="20">&nbsp;</td>
										<td width="20">&nbsp;</td>
										<td align="right">
											<img src="{$path}/images/page_white_edit.png" title="edytuj kategorię" onclick="javascript: openwin('{$path}/category/edit/{$sub1.url_name}');" style="cursor:pointer;">
											{*<img src="{$path}/images/page_white_magnify.png" title="dodaj nową subkategorię" onclick="javascript: openwin('{$path}/category/new/{$sub1.id}');" style="cursor:pointer;">*}
											<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć wybraną kategorię?')) window.location='{$path}/category/remove/{$sub1.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>
										</td>
									</tr>
									{if $sub1.sub} 
    								
    									{foreach from=$sub1.sub item=sub2}
    										<tr id="row_{$sub2.id}">
    											<td align="left" style="padding-left:60px;"><a href="catalog.php?CategoryId={$sub2.id}">&raquo; {$sub2.name}</a></td>
    											<td align="right">
	    											<img src="{$path}/images/page_white_edit.png" title="edytuj kategorię" onclick="javascript: openwin('category.php?action=EditView&CategoryId={$sub2.id}');" style="cursor:pointer;">
													<img src="{$path}/images/page_white_magnify.png" title="dodaj nową subkategorię" onclick="javascript: openwin('category.php?action=CreateView&ParentId={$sub2.id}');" style="cursor:pointer;">
													<a href="remove.php" onclick="removeCategory({$sub2.id}); return false;"><img src="{$path}/images/cross.png" border="0" title="usuń kategorię"></a>
												</td>
    										</tr>
    										{if $sub2.sub} 
		    								
		    									{foreach from=$sub2.sub item=sub3}
		    										<tr id="row_{$sub3.id}">
		    											<td align="left" style="padding-left:90px;"><a href="catalog.php?CategoryId={$sub3.id}">&raquo; {$sub3.name}</a></td>
		    											<td align="right">
			    											<img src="{$path}/images/page_white_edit.png" title="edytuj kategorię" onclick="javascript: openwin('category.php?action=EditView&CategoryId={$sub3.id}');" style="cursor:pointer;">
															<img src="{$path}/images/page_white_magnify.png" title="dodaj nową subkategorię" onclick="javascript: openwin('category.php?action=CreateView&ParentId={$sub3.id}');" style="cursor:pointer;">
															<a href="remove.php" onclick="removeCategory({$sub3.id}); return false;"><img src="{$path}/images/cross.png" border="0" title="usuń kategorię"></a>
														</td>
		    										</tr>
		    										{if $sub3.sub} 
				    								
				    									{foreach from=$sub3.sub item=sub4}
				    									<tr id="row_{$sub4.id}">
				    										<td align="left" style="padding-left:120px;"><a href="catalog.php?CategoryId={$sub4.id}" >&raquo; {$sub4.name}</a></td>
				    										<td align="right">
					    										<img src="{$path}/images/page_white_edit.png" title="edytuj kategorię" onclick="javascript: openwin('category.php?action=EditView&CategoryId={$sub4.id}');" style="cursor:pointer;">
																<img src="{$path}/images/page_white_magnify.png" title="dodaj nową subkategorię" onclick="javascript: openwin('category.php?action=CreateView&ParentId={$sub4.id}');" style="cursor:pointer;">
																<a href="remove.php" onclick="removeCategory({$sub4.id}); return false;"><img src="{$path}/images/cross.png" border="0" title="usuń kategorię"></a>
															</td>
				    									</tr>
				    									{/foreach}
				    								
				    								{/if}
		    										
		    									{/foreach}
		    								
		    								{/if}
    										
    									{/foreach}
    								
    								{/if}
									
								{/foreach}
							
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
	var w = 550;
	var h = 400;
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