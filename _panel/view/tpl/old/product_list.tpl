{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}
{*include file="products_category_config.tpl"*}

<tr align="left" valign="middle">
	<td>{$dict_templates.SetCategory} :&nbsp;&nbsp;
		<select name="CategoryId" class="adm11"  style="width:330px;" onchange="window.location='{$path}/product/index/' + this.value;">
			{foreach from=$product_categories item=category}
			<option value="{$category.id}" {if $category_id eq $category.id}selected{/if}><b>{$category.parent_name}</b> - {$category.name}</option>
			{/foreach}
		</select>
	</td>
</tr>

<tr>
	<td align="left">
		<input type="button" style="width:150px;" value="{$dict_templates.AddNewProduct}" onclick="javascript: openwin('{$path}/product/new/1/{$category_id}');">
	</td>
</tr>

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<img src="{$path}/images/kreska_adm_gray.gif" width="960" height="1"><br>
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
			{include file="filters_product.tpl"}
			{include file="paging_product.tpl"}
				<table border="0" cellpadding="5" cellspacing="0" width="960">
				

				<tr>
					<td>
						<table border="0" cellpadding="3"  cellspacing="0" width="960">
						
						{if $products_list}
						
						{foreach from=$products_list item=product name=product}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="80%" align="left" {if $product.status ne 2}style="color:#bbbbbb;"{/if}>
								<span style="font-weight:italic;font-size:9px;color:#bbbbbb;">Dodany : {$product.date_created|date_format:"%Y-%m-%d"}</span><br>
								{$product.title}
							</td>
							<td width="10%">{if $product.type eq 1}<span style="color: green;">aukcja</span>{else}<span style="color: red;">kup teraz</span>{/if}</td>
							<td><img src="{$__CFG.base_url}images/product/{$product.product_id}_01_01.jpg"></img></td>
							{if $admin_data.level eq 2}
							<td>{if !$smarty.foreach.product.first}<a href="{$path}/product/up/{$product.product_id}/{$product.category_id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</td>
							<td>{if !$smarty.foreach.product.last}<a href="{$path}/product/down/{$product.product_id}/{$product.category_id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</td>
							{/if}
							<td nowrap align="center">
								{foreach from=$language_list item=language}
									{if $language.id eq $admin_data.language}
									<a href="javascript: openwin('{$path}/product/edit/{$product.product_id}/{$language.id}');"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
									{/if}
								{/foreach}
							</td>
							
							<td>
								{if $product.status eq 2}
								<a href="{$path}/product/status/{$product.product_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="ustaw status niewidoczny"></a>
								{else}
								<a href="{$path}/product/status/{$product.product_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="ustaw status widoczny"></a>
								{/if}
							</td>
							{if $admin_data.level eq 2}
							<td>
								{if $product.promotion eq 0}
								<a href="{$path}/product/promotion/{$product.product_id}/1/{$paging.current}" title="dodaj promocję"><img src="{$path}/images/award_star_gold_1.png" border="0" title="dodaj promocję"></a>
								{else}
								<a href="{$path}/product/promotion/{$product.product_id}/0/{$paging.current}" title="usuń z promocji"><img src="{$path}/images/award_star_gold_3.png" border="0" title="usuń z promocji"></a>
								{/if}
							</td>
							<td>
								{if $product.home eq 0}
								<a href="{$path}/product/home/{$product.product_id}/1/{$paging.current}" title="dodaj do polecanych"><img src="{$path}/images/flag_red.png" border="0" title="dodaj do polecanych"></a>
								{else}
								<a href="{$path}/product/home/{$product.product_id}/0/{$paging.current}" title="usuń z polecanych"><img src="{$path}/images/flag_blue.png" border="0" title="usuń z polecanych"></a>
								{/if}
							</td>
							{*
							<td nowrap align="center" width="21">
								
								<a href="javascript: openwin_big('product_product.php?action=index&ProductId={$product.product_id}');" title="wybierz produkty dla artykułu"><img src="{$path}/images/page_white_magnify.png" border="0" title="{$dict_templates.GetProductsForProduct}"></a>

							</td>
							*}
							<td>
								<a href="{$path}/product/remove/{$product.product_id}/{$product.category_id}"><img src="{$path}/images/cut.png" border="0" title="{$dict_templates.Remove}"></a>
							</td>
							{/if}
							
						</tr>
						
						{/foreach}
						
						{else}
						<tr align="left">
							<td colspan="6"><b>{$dict_templates.NoResults}</b></td>
						</tr>
						{/if}
						</table>
					</td>
				</tr>
				</table>
				
				{include file="paging_product.tpl"}

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