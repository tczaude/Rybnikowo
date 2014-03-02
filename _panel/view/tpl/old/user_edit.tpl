{include file="head_pop.tpl"}

{if $close}
<script language="JavaScript">
	window.opener.location = '{$location}';
	window.close();
</script>
{/if}

<table border="0" cellpadding="3" cellspacing="0" width="95%" align="center">
	<tr>
		<td colspan="2">
		<b><br>
		{if !$user.id}{$dict_templates.AddNewUserHeader}{else}{$dict_templates.EditUserHeader} : {$user.name} {$user.surname}{/if}
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
			
			<input type="hidden" name="user[email_old]" value="{$user.email}">
				
			<tr valign="top">
				<td width="20%">Imię: </td>
				<td width="80%"> <input type="text" name="user[name]" style="width:370px;" value="{$user.name|default:$ret_post.name}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Nazwisko: </td>
				<td> <input type="text" name="user[surname]" style="width:370px;" value="{$user.surname|default:$ret_post.surname}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>E-mail: </td>
				<td> <input type="text" name="user[email]" style="width:370px;" value="{$user.email|default:$ret_post.email}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Hasło: </td>
				<td> <input type="text" name="user[password]" style="width:370px;" value="{$user.password|default:$ret_post.password}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Firma: </td>
				<td> <input type="text" name="user[company]" style="width:370px;" value="{$user.company|default:$ret_post.company}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Ulica: </td>
				<td> <input type="text" name="user[street]" style="width:370px;" value="{$user.street|default:$ret_post.syteet}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Kod pocztowy: </td>
				<td> <input type="text" name="user[zipcode]" style="width:370px;" value="{$user.zipcode|default:$ret_post.zipcode}" class="adm3"></td>
			</tr>
			<tr valign="top">
				<td>Miasto: </td>
				<td> <input type="text" name="user[city]" style="width:370px;" value="{$user.city|default:$ret_post.city}" class="adm3"></td>
			</tr>
			{*
			<tr valign="top">
				<td> {$dict_templates.Country}: </td>
				<td>
					<select id="country" name="user[country]" class="adm3">
						{foreach from=$dict_templates.countries item=country key=key}
							<option value="{$key}" {if $user.country eq $key || $ret_post.country eq $key}selected{/if}>{$country}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			*}
			<tr valign="top">
				<td> {$dict_templates.Phone}: </td>
				<td> <input type="text" name="user[phone]" style="width:370px;" value="{$user.phone|default:$ret_post.phone}" class="adm3"></td>
			</tr>

			
			<tr valign="top">
			<td>&nbsp;</td>
			<td align="left">
				<br>
				<input type="hidden" name="user[id]" value="{$user.id}">
				<input type="hidden" name="action" value="SaveUser">
				<input type="reset" value="{$dict_templates.Close}" class="adm2" onclick="window.close();">
				<input type="submit" value="{$dict_templates.Save}" name="zapisz" class="adm2">
				<br><br>
			</td>
			</tr>
			
			</form>
		</table>
		
{include file="foot_pop.tpl"}
