{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}
{*include file="orders_category_config.tpl"*}
{*
<tr valign="middle" align="left">
	<td>{$dict_templates.SetCategory} :&nbsp;&nbsp;
		<select name="CategoryId" class="adm11"  style="width:330px;" onchange="window.location='{$path}/order/index/' + this.value;">
			{foreach from=$order_categories item=category key=key}
			<option value="{$key}" {if $category_id eq $key}selected{/if}>{$category.name}</option>
			{/foreach}
		</select>
	</td>
</tr>

<tr>
	<td>
		<input type="button" style="width:150px;" value="{$dict_templates.AddNewOrder}" onclick="javascript: openwin('{$path}/order/new/1/{$category_id}');">
	</td>
</tr>
*}

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<img src="{$path}/images/kreska_adm_gray.gif" width="960" height="1"><br>
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
			{include file="filters_order.tpl"}
			{include file="paging_order.tpl"}
				<table border="0" cellpadding="5" cellspacing="0" width="960">
				

				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="960">
						
						{if $orders_list}
						
						{foreach from=$orders_list item=order name=order}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="50%" align="left" {if $order.status ne 1}style="color:#bbbbbb;"{/if}>
								<span style="font-weight:italic;font-size:9px;color:#bbbbbb;">Dnia : {$order.date_created}</span><br>
								{$order.surname_01}&nbsp;{$order.name_01}
							</td>
							<td width="10%" style="text-align: left;">{$order.city_01}</td>
							<td width="10%" style="text-align: left;">{$order.city_01}</td>
							<td width="10%" style="text-align: left;">{$order.delivery_type}</td>
							<td width="10%" style="text-align: right;">{$order.value_pln}&nbsp;PLN</td>
							<td width="10%">&nbsp;</td>
							<td nowrap align="center">
								<a href="javascript: openwin('{$path}/order/display/{$order.id}/{$language.id}');"><img src="{$path}/images/magnifier.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
							</td>
							
							<td>
								<a href="remove.php" onclick="if (confirm('Czy na pewno chcesz usunąć wybraną kategorię?')) window.location='{$path}/order/remove/{$order.id}'; return false;"><img src="{$path}/images/cross.png" border="0" title="{$dict_templates.Remove}"></a>
							</td>
							{*
							<td>
								{if $order.promotion eq 0}
								<a href="{$path}/order/promotion/{$order.id}/1/{$paging.current}" title="dodaj promocję"><img src="{$path}/images/award_star_gold_1.png" border="0" title="dodaj promocję"></a>
								{else}
								<a href="{$path}/order/promotion/{$order.id}/0/{$paging.current}" title="usuń z promocji"><img src="{$path}/images/award_star_gold_3.png" border="0" title="usuń z promocji"></a>
								{/if}
							</td>
							<td>
								{if $order.home eq 0}
								<a href="{$path}/order/home/{$order.id}/1/{$paging.current}" title="dodaj do polecanych"><img src="{$path}/images/flag_red.png" border="0" title="dodaj do polecanych"></a>
								{else}
								<a href="{$path}/order/home/{$order.id}/0/{$paging.current}" title="usuń z polecanych"><img src="{$path}/images/flag_blue.png" border="0" title="usuń z polecanych"></a>
								{/if}
							</td>
							*}
						</tr>
						
						{/foreach}
						
						{else}
						<tr>
							<td colspan="6"><b>{$dict_templates.NoResults}</b></td>
						</tr>
						{/if}
						</table>
					</td>
				</tr>
				</table>
				
				{include file="paging_order.tpl"}

{literal}		
<script type="text/javascript">

function openwin(url)
{
	var w = 550;
	var h = 600;
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