<table border="0" cellpadding="2" cellspacing="0" width="100%">
	
	<form name="stuff_search" method="post">
	
	<input type="hidden" id="action" name="action" value="SearchProduct">
	<input type="hidden" id="product_product_page_number" name="product_product_page_number" value="{$paging.current}">
	<input type="hidden" id="product_id" name="search_form[product_id]" value="{$ProductId}">
	<input type="hidden" id="ProductId" name="ProductId" value="{$ProductId}">
	
	<input type="hidden" id="country_hidden" name="country_ID">
	
	<tr>
		<td align="left">
			<div style="font-weight:bold; cursor:pointer;" onclick="showFilters();">Filtrowanie produktów:</div>
		</td>
	</tr>
	
	<tr>
		<td align="left">
			
			{if $set_filter}
				<div id="filters">
			{else}
				<div id="filters" style="display:none;">
			{/if}
			
				<div class="filter_option">nazwa : <input type="text" id="name" name="search_form[title]" class="adm11" style="width:150px" value="{$order_filters.title}"></div>
				{if $admin_data.level eq 2}
				<div class="filter_option">sprzedawca : 			
					<select name="search_form[author_id]" style="width: 150px; border: 1px groove #000000;">
						<option value="">- wybierz -</option>
						{foreach from=$author_list item=author}
						<option value="{$author.id}" {if $order_filters.author_id eq $author.id}selected{/if}>{$author.name}</option>
						{/foreach}
					</select>
				</div>
				{/if}
				<div class="filter_option">kolor : 
				
					<select name="search_form[color]" style="width: 150px; border: 1px groove #000000;">
						<option value="">- wybierz -</option>
						{foreach from=$dict_templates.colors item=color}
						<option {if $order_filters.color eq $color.id}selected{/if} style="background: {$color.background} none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; color: {$color.color};" value="{$color.id}">{$color.name}</option>
						{/foreach}
					</select>					
	
				</div>			
				<div class="filter_option">typ : 
				
					<select name="search_form[type]" style="width: 150px; border: 1px groove #000000;">
						<option value="">- wybierz -</option>
						<option {if $order_filters.type eq 1}selected{/if} style="" value="1">Aukcja</option>
						<option {if $order_filters.type eq 2}selected{/if} style="" value="2">Kup teraz</option>
					</select>					
	
				</div>				
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
				</form>
				<form method="post">
				<input type="hidden" name="action" value="ClearSearch">
				{if $set_filter}&nbsp;&nbsp;<input type="submit" value="{$dict_templates.ClearSearch}" name="clear_search" style="width:100px;">{/if}
				</form>
				</div>
			</div>
		</td>
	</tr>
	
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