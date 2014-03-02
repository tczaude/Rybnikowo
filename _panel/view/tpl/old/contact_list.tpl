{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}
{*include file="contacts_category_config.tpl"*}

{*
<tr valign="middle">
	<td>{$dict_templates.SetCategory} :&nbsp;&nbsp;
		<select name="CategoryId" class="adm11"  style="width:330px;" onchange="window.location='contact.php?action=index&CategoryId=' + this.value;">
			{foreach from=$dict_templates.contact_category item=category key=key}
			<option value="{$key}" {if $category_id eq $key}selected{/if}>{$category}</option>
			{/foreach}
		</select>
	</td>
</tr>
*}

{*
<tr>
	<td>
		<a href="javascript: openwin('contact.php?action=CreateView&LanguageId=1&CategoryId=1');">nowy</a>&nbsp;
	</td>
</tr>
*}

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<img src="{$path}/images/kreska_adm_gray.gif" width="960" height="1"><br>
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
				<table border="0" cellpadding="5" cellspacing="0" width="960">
				
				{if $page.id ne 1 and $nazwa_listy}
				<tr>
					<td >
						<b>{$nazwa_listy} : {$nazwa_kategorii}</b>
						<table border="0" cellpadding="0" cellspacing="0" width="960">		
						<tr>
							<td bgcolor="#666666" height="1"><img border="0" src="{$path}/images/t.gif" width="1" height="1" alt=""></td>
							<td align="right" bgcolor="#666666" height="1"><img border="0" src="{$path}/images/t.gif" width="1" height="1" alt=""></td>
						</tr>
						</table>		
					</td>
				</tr>
				{/if}
				
				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="960">
						
						{if $contacts_list}
						
						{foreach from=$contacts_list item=contact name=contact}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="90%" align="left">
								<span style="font-size:9px;color:#bbbbbb;">{$dict_templates.ContactCreated} : {$contact.date_created|date_format:"%d-%m-%Y %H:%M:%S"}</span><br>
								{$contact.surname} {$contact.name} [{$contact.email}]
							</td>
							
							{*
							
							<td>{if !$smarty.foreach.contact.first}<a href="contact.php?action=MoveContactUp&ContactId={$contact.contact_id}&CategoryId={$contact.category_id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</td>
							<td>{if !$smarty.foreach.contact.last}<a href="contact.php?action=MoveContactDown&ContactId={$contact.contact_id}&CategoryId={$contact.category_id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</td>
							
							
							
							<td nowrap align="center">
								<a href="javascript: openwin('contact.php?action=EditView&ContactId={$contact.id}&LanguageId={$language.id}');"><img src="{$path}/images/edit_inline.gif" border="0" title="{$dict_templates.Edit}"></a>&nbsp;
							</td>
							*}
							
							<td align="right">
								<a href="{$path}/kontakt/delete/{$contact.id}"><img src="{$path}/images/delete.png" border="0" title="Usuń wiadomość"></a>
							</td>
						
						</tr>
						
						<div>
						<tr bgcolor="{$row_color}">
							<td width="90%" align="left"><span style="font-size:9px;color:#bbbbbb;">{$contact.content}</span></td>
							<td align="right">&nbsp;</td>
						</tr>
						</div>
						
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
	var w = 450;
	var h = 400;
	dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
}

</script>
{/literal}

{include file=foot.tpl}