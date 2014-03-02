{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
				
				<table border="0" cellpadding="5" cellspacing="0" width="960">
				
				<tr>
					{if $message}
						<td style="color:red; font-weight: bold; height:40px;" align="left">{$message}</td>
					{/if}
				</tr>
				
				<tr>
					<td class="nagdzial"><strong>{$dict_templates.StuffHeader} :</strong></td>
				</tr>
				
				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="960">
						
						{if $stuff_list}
						
						{foreach from=$stuff_list item=stuff name=stuff}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="95%"  {if !$stuff.status}style="color:#CCCCCC;"{/if}>
								<img src="{$__CFG.stuff_files_url}{$stuff.file_01}" align="left" style="padding: 5px 5px 5px 0px;">
								<p><b>{$stuff.title}</b></p>
								{$stuff.description|truncate:200}
							</td>
							
							<td align="center">
								<a href="set.php" onclick="if (confirm('Czy na pewno chcesz usunąc wybrany materiał ze strony głównej?')) window.location='main.php?action=RemoveStuffFromMainPage&StuffId={$stuff.stuff_id}'; return false;"><img src="img/cross.png" border="0" title="{$dict_templates.Remove}"></a>
							</td>
							
						</tr>
						
						{/foreach}
						
						{else}
						<tr>
							<td colspan="2"><b>{$dict_templates.NoResults}</b></td>
						</tr>
						{/if}
						</table>
					</td>
				</tr>
				</table>

{include file=foot.tpl}