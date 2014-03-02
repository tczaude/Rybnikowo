{include file="head_pop.tpl"}

	{if $close}
	<script language="JavaScript">
		window.opener.location = '{$location}';
		window.close();
	</script>
	{/if}
{if $reload}
	<script language="JavaScript">
		window.opener.location.reload();
		// window.close();
	</script>
{/if}
	
	{include file="delivery_validate.tpl"}

	<form id="signupForm" enctype="multipart/form-data" method="post">
	<table class="adm3" border="0" cellpadding="3" cellspacing="0" width="95%" align="center">
		<tr>
			<td colspan="2">
			<b><br>
			{if !$delivery.id}Dodawanie kategorii{else}Edycja kategorii{/if}
			</b>
			<br><br>
			{$dict_templates.FieldsRequired}
			</td>
		</tr>

		
		<tr valign="top">
			<td width="20%"> 
				<label for="delivery[name]">Nazwa:</label> 
			</td>
			<td width="80%"> 
				<input class="required" type="text" name="delivery[name]" style="width:370px;" value="{$delivery.name|default:$ret_post.name}">
			</td>
		</tr>
		<tr valign="top">
			<td width="20%"> 
				<label for="delivery[price]">Cena:</label> 
			</td>
			<td width="80%"> 
				<input class="required" type="text" name="delivery[price]" style="width:80px;" value="{$delivery.price|default:$ret_post.price}">&nbsp;&nbsp;PLN
			</td>
		</tr>	
		<tr valign="top">
			<td width="20%"> 
				<label for="delivery[range_from]">Od:</label> 
			</td>
			<td width="80%"> 
				<input class="required" type="text" name="delivery[range_from]" style="width:80px;" value="{$delivery.range_from|default:$ret_post.range_from}">
			</td>
		</tr>
		<tr valign="top">
			<td width="20%"> 
				<label for="delivery[range_to]">Do:</label> 
			</td>
			<td width="80%"> 
				<input class="required" type="text" name="delivery[range_to]" style="width:80px;" value="{$delivery.range_to|default:$ret_post.range_to}">
			</td>
		</tr> 				
		<tr> 
			<td colspan="2">
				<img src="img/kreska_adm_gray.gif" width="95%" height="1">
			</td>
		</tr>
 
		<tr valign="top">
			<td>&nbsp;</td>
			<td align="left">
				<br>
				<input type="hidden" name="delivery[id]" value="{$delivery.id}">
				<input type="hidden" name="delivery[status]" value="1">
				<input type="hidden" name="action" value="SaveDelivery">
				<input type="reset" value="{$dict_templates.Close}" onclick="window.close();">
				<input type="submit" value="{$dict_templates.Save}" name="zapisz">
				<br><br>
			</td>
		</tr>
	</table>
	</form>

{include file="foot_pop.tpl"}

