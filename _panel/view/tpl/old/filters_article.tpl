<table border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr>
		<td width="100%" valign="top" align="center"><img src="img/kreska_adm_gray.gif" width="100%" height="1"></td>
	</tr>
	
	<form name="stuff_search" method="post">
	
	<input type="hidden" id="action" name="action" value="SearchArticle">
	<input type="hidden" id="article_product_page_number" name="article_product_page_number" value="{$paging.current}">
	<input type="hidden" id="article_id" name="search_form[article_id]" value="{$ArticleId}">
	<input type="hidden" id="ArticleId" name="ArticleId" value="{$ArticleId}">
	
	<input type="hidden" id="country_hidden" name="country_ID">
	
	<tr>
		<td>
			<div style="font-weight:bold; cursor:pointer;" onclick="showFilters();">Filtrowanie artykułów:</div>
		</td>
	</tr>
	
	<tr>
		<td>
			
			<div id="filters" style="display:none;">
			
				<div class="filter_option">tytuł : <input type="text" id="name" name="search_form[title]" class="adm11" style="width:150px" onkeyup="ajax_showOptions(this,'SearchProductsByName',event)" value="{$product_filters.phrase}"></div>
				<div class="filter_option">treść : <input type="text" id="name" name="search_form[ean]" class="adm11" style="width:150px" onkeyup="ajax_showOptions(this,'SearchProductsByName',event)" value="{$product_filters.ean}"></div>
			
				<div class="filter_option">
				&nbsp;&nbsp;Kategoria:

					<select id="publisher" name="search_form[publisher]" class="adm3" style="width:150px">
						{foreach from=$dict_templates.article_category item=category key=key}
						<option value="{$key}" {if $category_id eq $key}selected{/if}>{$category}</option>
						{/foreach}
					</select>					
				
				</div>
		
				<div class="filter_option">data od : <input type="text" id="date_premiere_from" name="search_form[date_premiere_from]" class="adm11" style="width:130px" {*onkeyup="ajax_showOptions(this,'SearchProductsByName',event)"*} value="{$product_filters.date_premiere_from}"> <img src="{$path}/images/jscalendar.gif" id="date_premiere_from_trigger" align="absmiddle" style="margin-bottom:5px;cursor:pointer;"></div>
				<div class="filter_option">data do : <input type="text" id="date_premiere_to" name="search_form[date_premiere_to]" class="adm11" style="width:130px" {*onkeyup="ajax_showOptions(this,'SearchProductsByName',event)"*} value="{$product_filters.date_premiere_to}"> <img src="{$path}/images/jscalendar.gif" id="date_premiere_to_trigger" align="absmiddle" style="margin-bottom:5px;cursor:pointer;"></div>
			

			
				<div style="clear:both;"></div>
				
				<div class="filter_option" {*style="padding-left:95px;"*}>
				&nbsp;&nbsp;<input type="submit" value="{$dict_templates.Search}" name="search" style="width:100px;">
				{if $set_filter}&nbsp;&nbsp;<input type="button" value="{$dict_templates.ClearSearch}" name="clear_search" style="width:100px;" onclick="window.location = 'article_product.php?action=ClearSearch&ArticleId={$ArticleId}'">{/if}
				</div>
			</div>
		</td>
	</tr>
	</form>
</table>