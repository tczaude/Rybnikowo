{include file="head_pop.tpl"}

	{if $close}
	<script language="JavaScript">
		//window.opener.location = '{$location}';
		window.opener.location.reload();
		//window.close();
	</script>
	{/if}
	
	{include file="author_validate.tpl"}

	<form class="cmxform" id="signupForm" enctype="multipart/form-data" method="post">
	<table class="adm3" border="0" cellpadding="3" cellspacing="0" width="95%" align="center">
		<tr>
			<td colspan="2">
			<b><br>
			{if !$author.id}Dodawanie sprzedawcy{else}Edycja sprzedawcy{/if}
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
		
		<tr valign="top">
			<td width="30%"> 
				<label for="author[name]">Nazwa:</label> 
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[name]" style="width:400px;" value="{$author.name|default:$ret_post.name}">
			</td>
		</tr>
		
		<tr valign="top">
			<td width="30%">
				<label for="author[url_name]">Nazwa url:</label>
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[url_name]" style="width:300px;" value="{$author.url_name|default:$ret_post.url_name}">
				{if $error.url_name}<div style="display: block;" id="advice-required-entry-adm4" class="validation-advice">Podany url_name już istnieje.</div>{/if}
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<img src="{$path}/images/kreska_adm_gray.gif" width="99%" height="1">
			</td>
		</tr>
		<tr valign="top">
			<td width="30%">
				<label for="author[account]">Konto bankowe:</label>
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[account]" style="width:300px;" value="{$author.account|default:$ret_post.account}">
			</td>
		</tr>
		<tr valign="top">
			<td width="30%">
				<label for="author[account_desc]">Opis konta:</label>
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[account_desc]" style="width:300px;" value="{$author.account_desc|default:$ret_post.account_desc}">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<img src="{$path}/images/kreska_adm_gray.gif" width="99%" height="1">
			</td>
		</tr>
		<tr valign="top">
			<td width="30%">
				<label for="author[adress]">Adres:</label>
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[adress]" style="width:300px;" value="{$author.adress|default:$ret_post.adress}">
			</td>
		</tr>				
		<tr valign="top">
			<td width="30%">
				<label for="author[zipcode]">Kod pocztowy:</label>
			</td>
			<td width="90%">
				<input id="zipcode" class="adm3" type="text" name="author[zipcode]" style="width:100px;" value='{$author.zipcode|default:$ret_post.zipcode}'>
			</td>
		</tr>	
		<tr valign="top">
			<td width="30%">
				<label for="author[city]">Miasto:</label>
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[city]" style="width:300px;" value="{$author.city|default:$ret_post.city}">
			</td>
		</tr>	
		<tr valign="top">
			<td width="30%">
				<label for="author[city]">Email:</label>
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[email]" style="width:300px;" value="{$author.email|default:$ret_post.email}">
			</td>
		</tr>
		<tr valign="top">
			<td width="30%">
				<label for="author[phone]">Telefon:</label>
			</td>
			<td width="70%">
				<input class="adm3" type="text" name="author[phone]" style="width:300px;" value="{$author.phone|default:$ret_post.phone}">
			</td>
		</tr>	
			
	
		
		
		<tr valign="top">
			<td> Opis: </td>
			<td> {$sSpaw} </td>
		</tr>
		
		
		<tr valign="middle">
			<td>{$dict_templates.AuthorVisible}:</td>
			<td>
				<select id="status" name="author[status]" class="adm3" style="width: 400px;">
					<option value="1" {if !$author.id || $author.status eq 1 || $ret_post.status eq 1}selected{/if}>{$dict_templates.Yes}</option>
					<option value="0" {if $author.id && $author.status eq 0}selected{/if}>{$dict_templates.No}</option>
				</select>
			</td>
		</tr>
		
		<tr valign="middle">
			<td>Zdjęcie 1:</td>
			<td><input type="file" id="pic_1" name="pic_01" class="adm3">
			{if $author.pic_01}<img src="http://www.kooperatywa.code13.pl/images/author/{$author.id}_01.jpg">{/if}
			</td> 
		</tr>
		{if $author.pic_01}
		<tr valign="middle">
			<td>&nbsp;</td>
			<td><input type="checkbox" name="author[remove_picture_01]" value="1">Usuń zdjęcie 1</td>
		</tr>
 		{/if}
		<tr valign="top">
			<td>&nbsp;</td>
			<td align="left">
				<br>
				<input type="hidden" name="author[id]" value="{$author.id}">
				<input type="hidden" name="author[parent]" value="{$ParentId|default:"0"}">
				<input type="hidden" name="action" value="SaveAuthor">
				<input type="reset" value="{$dict_templates.Close}" onclick="window.close();">
				<input type="submit" value="{$dict_templates.Save}" name="zapisz">
				<br><br>
			</td>
		</tr>
	</table>
	</form>

{include file="foot_pop.tpl"}

