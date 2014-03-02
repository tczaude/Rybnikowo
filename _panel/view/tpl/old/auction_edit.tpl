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
		Podgląd aukcji
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
			{$auction.user_details.name}&nbsp;{$auction.user_details.surname}
		</td>
	</tr>
	<tr valign="top">
		<td>Email:</td>
		<td>
			<a href="mailto:{$auction.user_details.email}">{$auction.user_details.email}</a>
		</td>
	</tr>
	<tr valign="middle">
		<td>Adres:</td>
		<td>
			{$auction.user_details.street},&nbsp;{$auction.user_details.zipcode}&nbsp;{$auction.user_details.city},&nbsp;{$auction.user_details.country} 
		</td>
	</tr>
	<tr valign="middle">
		<td>Firma:</td>
		<td>
			{$auction.user_details.company}
		</td>
	</tr>	
	<tr valign="middle">
		<td>Nip:</td>
		<td>
			{$auction.user_details.nip}
		</td>
	</tr>	
	<tr><td><hr></hr></td><td><hr></hr></td></tr>
	<tr valign="top">
	 <td><strong>Sprzedający</strong></td>
	</tr>	
	
	<tr valign="top">
		<td width="30%">Imię i nazwisko:</td>
		<td width="70%">
			{$auction.author_details.name}&nbsp;{$auction.surname_02}
		</td>
	</tr>
	<tr valign="top">
		<td>Email:</td>
		<td>
			<a href="mailto:{$auction.author_details.email}">{$auction.author_details.email}</a>
		</td>
	</tr>	
	
	<tr valign="middle">
		<td>Adres:</td>
		<td>
			{$auction.author_details.street},&nbsp;{$auction.author_details.zipcode}&nbsp;{$auction.author_details.city},&nbsp;{$auction.author_details.country} 
		</td>
	</tr>
	{*
	<tr valign="middle">
		<td>Koszt odstawy:</td>
		<td>
			{$auction.delivery_cost}
		</td>
	</tr>
	*}
	<tr><td><hr></hr></td><td><hr></hr></td></tr>
	<tr valign="top">
	 <td><strong>Pozycje</strong></td>
	</tr>	
	

	<tr valign="middle">
		<td>1&nbsp;x&nbsp;{$auction.product_details.price}&nbsp;=&nbsp;{$auction.product_details.price}</td>
		<td>
			{$auction.product_details.title}
		</td>
	</tr>	

	
	<tr><td><hr></hr></td><td><hr></hr></td></tr>
	<tr valign="top">
	 <td><strong>Podsumowanie</strong></td>
	</tr>
	<tr valign="middle">
		<td>Status:</td>
		<td>
			{if $auction.status eq 1}Potwierdzone{else}Niepotwierdzone{/if}
		</td>
	</tr>	
	<tr valign="middle">
		<td>Do zapłaty:</td>
		<td>
			<strong>{$auction.to_pay}&nbsp;PLN</strong>
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