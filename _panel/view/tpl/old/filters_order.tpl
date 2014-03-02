<table border="0" cellpadding="2" cellspacing="0" width="100%">
	
	
	<form name="stuff_search" method="post">
	
	<input type="hidden" id="action" name="action" value="SearchShopOrder">
	<input type="hidden" id="order_order_page_number" name="order_order_page_number" value="{$paging.current}">

	
	<input type="hidden" id="country_hidden" name="country_ID">
	
	<tr>
		<td align="left">
			<div style="font-weight:bold; cursor:pointer;" onclick="showFilters();">Filtrowanie zamówień:</div>
		</td>
	</tr>
	
	<tr>
		<td>
			
			{if $set_filter}
				<div id="filters">
			{else}
				<div id="filters" style="display:none;">
			{/if}
				<div class="filter_option">nazwisko : <input type="text" id="name" name="search_form[surname_01]" class="adm11" style="width:150px" value="{$order_filters.surname_01}"></div>
				<div class="filter_option">imię : <input type="text" id="name" name="search_form[name_01]" class="adm11" style="width:150px" value="{$order_filters.name_01}"></div>
				
				
				<div class="filter_option">miasto : <input type="text" id="name" name="search_form[city_01]" class="adm11" style="width:150px" value="{$order_filters.city_01}"></div>
			
			
				<div class="filter_option">data od : 
					<input type="text" id='jscal_field_date_start' name="search_form[date_from]" class="adm11" style="width:130px" value="{$order_filters.date_from}"> 
					<img src="{$path}/images/jscalendar.gif" id='jscal_trigger_date_start' align="absmiddle" style="margin-bottom:5px;cursor:pointer;">
				</div>
				<div class="filter_option">data do : 
					<input type="text" id='jscal_field_date_end' name="search_form[date_to]" class="adm11" style="width:130px" value="{$order_filters.date_to}"> 
					<img src="{$path}/images/jscalendar.gif" id='jscal_trigger_date_end' align="absmiddle" style="margin-bottom:5px;cursor:pointer;">
				</div>
			

			
				<div style="clear:both;"></div>
				
				<div class="filter_option" {*style="padding-left:95px;"*}>
				&nbsp;&nbsp;<input type="submit" value="{$dict_templates.Search}" name="search" style="width:100px;">
				{if $set_filter}&nbsp;&nbsp;<input type="button" value="{$dict_templates.ClearSearch}" name="clear_search" style="width:100px;" onclick="window.location = '{$DP}/_panel/order/clear_filter'">{/if}
				</div>
			</div>
		</td>
	</tr>
	</form>
</table>
{literal}
<script type="text/javascript">



Calendar.setup ({
	inputField : "jscal_field_date_start", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_date_start", singleClick : true, step : 1 
});

Calendar.setup ({
	inputField : "jscal_field_date_end", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger_date_end", singleClick : true, step : 1 
});

</script>
{/literal}