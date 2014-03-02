{include file="head_pop.tpl"}

{if $reload}
	<script language="JavaScript">
		window.opener.location.reload();
		// window.close();
	</script>
{/if}

<table border="0" cellpadding="5" cellspacing="0" width="100%" align="center">
	<tr>
		<td colspan="2">
		<b><br>
		Podgląd zamówienia - f{$order.date_created}
		</b>
		
		</td>
	</tr>		

	
	<tr>
		<td>
			<img src="img/kreska_adm_gray.gif" width="400" height="1">
		</td>
	</tr>
	{if $errors}
	<tr>
		<td align="center">
			<span style="color:red;">
				<b>
				{foreach from=$errors item=er}
					{$er}<br/>
				{/foreach}
				</b>
			</span>
		</td>
	</tr>
	{/if}
</table>

<table border="0" cellpadding="5" cellspacing="0" width="100%">
	

	<tr><td><hr></hr></td><td><hr></hr></tr>
	<tr valign="top">
	 <td><strong>Dane klienta</strong></td>
	</tr>
	
	
	<tr valign="top">
		<td width="30%">Imię i nazwisko:</td>
		<td width="70%">
			{$order.name_01}&nbsp;{$order.surname_01}
		</td>
	</tr>
	<tr valign="top">
		<td>Email:</td>
		<td>
			<a href="mailto:{$order.email_01}">{$order.email_01}</a>
		</td>
	</tr>
	<tr valign="middle">
		<td>Adres:</td>
		<td>
			{$order.street_01},&nbsp;{$order.zipcode_01}&nbsp;{$order.city_01},&nbsp;{$order.country_01} 
		</td>
	</tr>
	<tr valign="middle">
		<td>Firma:</td>
		<td>
			{$order.company_01}
		</td>
	</tr>	
	<tr valign="middle">
		<td>Nip:</td>
		<td>
			{$order.nip_01}
		</td>
	</tr>	
	<tr><td><hr></hr></td><td><hr></hr></td></tr>
	<tr valign="top">
	 <td><strong>Dostawa</strong></td>
	</tr>	
	
	<tr valign="top">
		<td width="30%">Imię i nazwisko:</td>
		<td width="70%">
			{$order.name_02}&nbsp;{$order.surname_02}
		</td>
	</tr>
	<tr valign="top">
		<td>Email:</td>
		<td>
			<a href="mailto:{$order.email_02}">{$order.email_02}</a>
		</td>
	</tr>	
	
	<tr valign="middle">
		<td>Adres:</td>
		<td>
			{$order.street_02},&nbsp;{$order.zipcode_02}&nbsp;{$order.city_02},&nbsp;{$order.country_02} 
		</td>
	</tr>

	<tr valign="middle">
		<td>Typ odstawy:</td>
		<td>
			{$order.delivery_type}
		</td>
	</tr>
	
	<tr valign="middle">
		<td>Koszt odstawy:</td>
		<td>
			{$order.delivery_cost}
		</td>
	</tr>
	<tr><td><hr></hr></td><td><hr></hr></td></tr>
	<tr valign="top">
	 <td><strong>Pozycje</strong></td>
	</tr>	
	
	{foreach from=$order.details item=product name=product}
	<tr valign="middle">
		<td>{$product.quantity}&nbsp;x&nbsp;{$product.price}&nbsp;=&nbsp;{$product.value}</td>
		<td>
			{$product.name}
		</td>
	</tr>	
	{/foreach}
	
	<tr><td><hr></hr></td><td><hr></hr></td></tr>
	<tr valign="top">
	 <td><strong>Podsumowanie</strong></td>
	</tr>
	<tr valign="middle">
		<td>Status:</td>
		<td>
			{if $order.status eq 1}Potwierdzone{else}Niepotwierdzone{/if}
		</td>
	</tr>	
	<tr valign="middle">
		<td>Do zapłaty:</td>
		<td>
			<strong>{$order.to_pay}&nbsp;PLN</strong>
		</td>
	</tr>	
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>

	<tr valign="top">
		<td colspan="2" align="center">
			<input type="button" value="{$dict_templates.Close}" name="close" style="width:100px;" onclick="window.close();">
			<input type="button" value="Drukuj" name="print" style="width:100px;" onclick="window.print();">
		</td>
	</tr>
</table>

<br><br><br>
{include file="foot_pop.tpl"}