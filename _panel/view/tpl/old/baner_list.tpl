{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}

<tr>
	<td>
		<input type="button" value=" {$dict_templates.AddNewPicture} " onclick="javascript: openwin('baner.php?action=CreateView&LanguageId=1&CategoryId=1&TypeId=1');">
	</td>
</tr>

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<img src="img/kreska_adm_gray.gif" width="960" height="1"><br>
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
				<table border="0" cellpadding="5" cellspacing="0" width="960">
				
				{if $page.id ne 1 and $nazwa_listy}
				<tr>
					<td>
						<b>{$nazwa_listy} : {$nazwa_kategorii}</b>
						<table border="0" cellpadding="0" cellspacing="0" width="960">		
						<tr>
							<td bgcolor="#666666" height="1"><img border="0" src="img/t.gif" width="1" height="1" alt=""></td>
							<td align="right" bgcolor="#666666" height="1"><img border="0" src="img/t.gif" width="1" height="1" alt=""></td>
						</tr>
						</table>		
					</td>
				</tr>
				{/if}
				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="960">
						
						{if $baners_list}
						
						{foreach from=$baners_list item=baner name=baner}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="90%"  {if $art.published eq '0'}style="color:#bbbbbb;"{/if}>
								<img src="{$__CFG.baners_pictures_url}{$baner.pic_01}" align="left" style="margin:5px; margin-right:15px;">
							</td>
							
							<td>{if !$smarty.foreach.baner.first}<a href="baner.php?action=MoveBanerUp&BanerId={$baner.baner_id}&CategoryId={$baner.category_id}"><img src="img/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</td>
							<td>{if !$smarty.foreach.baner.last}<a href="baner.php?action=MoveBanerDown&BanerId={$baner.baner_id}&CategoryId={$baner.category_id}"><img src="img/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</td>
							
							<td nowrap align="center">
								{foreach from=$language_list item=language}
								{if $language.id eq $admin_data.language}
								<a href="javascript: openwin('baner.php?action=EditView&BanerId={$baner.baner_id}&LanguageId={$language.id}');"><img src="img/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
								{/if}
								{/foreach}
							</td>
							
							<td>
								<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć wybrany baner?')) window.location='baner.php?action=RemoveBaner&BanerId={$baner.baner_id}'; return false;"><img src="img/cross.png" border="0" title="{$dict_templates.Remove}"></a>
							</td>
						
						</tr>
						
						{/foreach}
						
						{else}
						<tr>
							<td colspan="5"><b>{$dict_templates.NoResults}</b></td>
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
	var w = 600;
	var h = 300;
	dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
}

</script>
{/literal}

{include file=foot.tpl}