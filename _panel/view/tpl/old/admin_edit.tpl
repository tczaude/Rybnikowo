{include file="head_pop.tpl"}

{if $close}
<script language="JavaScript">
	window.opener.location = '{$location}';
	window.close();
</script>
{/if}

<table border="0" cellpadding="3" cellspacing="0" width="95%" align="center">
	<tr>
		<td align="left" colspan="2">
		<b><br>
		{if !$admin.id}Dodawanie nowego admina{else}Edycja admina: {$admin.name} {$admin.surname}{/if}
		</b>
		<br><br>
		{$dict_templates.FieldsRequired}
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	
	{if $error}
	<tr>
		<td colspan="2">
		<span style="color:red;">
		{$error|nl2br}
		</span>
		</td>
	</tr>
	{/if}

			<form name="edit" enctype="multipart/form-data" method="post" action="">
			
			<input type="hidden" name="admin[email_old]" value="{$admin.email}">
				
			<tr valign="top">
				<td width="20%">Imię: </td>
				<td width="80%"> <input type="text" name="admin[name]" style="width:370px;" value="{$admin.name|default:$ret_post.name}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Nazwisko: </td>
				<td> <input type="text" name="admin[surname]" style="width:370px;" value="{$admin.surname|default:$ret_post.surname}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>E-mail: </td>
				<td> <input type="text" name="admin[email]" style="width:370px;" value="{$admin.email|default:$ret_post.email}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Hasło: </td>
				<td> <input type="text" name="admin[password]" style="width:370px;" value="{$admin.password|default:$ret_post.password}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td> WTZ: </td>
				<td>
					<select id="country" name="admin[wtz]" class="adm3">
						<option value="0" {if $admin.wtz eq 0}selected{/if}>- brak (Superadmin)-</option>
						{foreach from=$author_list item=author key=key}
							<option value="{$author.id}" {if $admin.wtz eq $author.id || $ret_post.wtz eq $author.id}selected{/if}>{$author.name}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr valign="middle">
				<td>{$dict_templates.CategoryVisible}:</td>
				<td>
					<select id="status" name="admin[status]" class="adm3">
						<option value="1" {if !$admin.id || $admin.status eq 1 || $ret_post.status eq 1}selected{/if}>{$dict_templates.Yes}</option>
						<option value="0" {if $admin.id && $admin.status eq 0}selected{/if}>{$dict_templates.No}</option>
					</select>
				</td>
			</tr>
			<tr valign="middle">
				<td>Uprawnienia:</td>
				<td>
					<select id="status" name="admin[level]" class="adm3">
						<option value="1" {if $admin.level eq 1}selected{/if}>Admin</option>
						<option value="2" {if $admin.level eq 2}selected{/if}>SuperAdmin</option>
					</select>
				</td>
			</tr>
			
			<tr valign="top">
			<td>&nbsp;</td>
			<td align="left">
				<br>
				<input type="hidden" name="admin[id]" value="{$admin.id}">
				<input type="hidden" name="action" value="SaveAdmin">
				<input type="reset" value="{$dict_templates.Close}" class="adm2" onclick="window.close();">
				<input type="submit" value="{$dict_templates.Save}" name="zapisz" class="adm2">
				<br><br>
			</td>
			</tr>
			
			</form>
		</table>
		
{include file="foot_pop.tpl"}
