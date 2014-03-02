{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}
{*
<tr>
	<td align="left">
		<input type="button" class="button" value="{$dict_templates.AddNewUser}" onclick="javascript: openwin('user.php?action=CreateView');">
	</td>
</tr>
*}
<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
			
				{include file="paging_users_search.tpl"}
			
				<table border="0" cellpadding="5" cellspacing="0" width="960">
				
				<tr>
					{if $message}
						<td style="color:red; font-weight: bold; height:40px;" align="left">{$message}</td>
					{/if}
				</tr>
				
				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="960">
						
						{if $user_list}
						
						{foreach from=$user_list item=user name=user}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							
							
							<td width="90%" align="left" {if !$user.status}style="color:red;"{/if}{if $user.admin eq 1}style="color:green;"{/if}>
								<b>{$user.surname} {$user.name}</b> [{$user.email}]<br>
							</td>
							
							<td nowrap align="center">
								<a href="javascript: openwin('{$path}/user/edit/{$user.id}');"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit}"></a>&nbsp;
							</td>
							
							<td>
								{if $user.status} 
								<a href="{$path}/user/status/{$user.id}/0" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
								{else}
								<a href="{$path}/user/status/{$user.id}/1" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
								{/if}
							</td>

							<td>
								<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć wybranego użytkownika?')) window.location='{$path}/user/remove/{$user.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>
							</td>
							
						</tr>
						
						{/foreach}
						
						{else}
						<tr>
							<td colspan="4"><b>{$dict_templates.NoResults}</b></td>
						</tr>
						{/if}
						</table>
					</td>
				</tr>
				</table>
				
				{include file="paging_users.tpl"}

{literal}		
<script type="text/javascript">

function openwin(url)
{
	var w = 600;
	var h = 750;
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