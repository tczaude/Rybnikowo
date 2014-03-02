	<div id="search_advanced" {*if $url_config.0 ne szukaj*}style="display:none;"{*/if*}>	
		<h2>Szukanie zaawansowane</h2>
		<form method="post" action="/szukaj" name="searchadv" >
		<input type="hidden" value="Search" name="action"/>	
			
			<div class="contentLeft">
				<p>
					<label>Nazwa</label>
					<input class="input"  type="text" id="search_form[title]" name="search_form[title]" value="{$ret_post.title}">
				</p>
				<p>
					<label>Producent</label>
					<select  name="search_form[category_parent]" onchange="window.location='{$path}/szukaj/?producent=' + this.value;">
							<option value="clear"> - wybierz - </option>
							{foreach from=$categories item=category_parent}
							<option value="{$category_parent.id}" {if $ret_post.category_parent eq $category_parent.id}selected{/if}>{$category_parent.name}</option>
							{/foreach}
					</select>	
				</p>
			</div>
			
			<div class="contentRight">	
				<p>
					<label>Kategoria</label>
					<select name="search_form[kind_parent]" onchange="window.location='{$path}/szukaj/?kategoria=' + this.value;">
							<option value="clear"> - wybierz - </option>
								{foreach from=$kind_categories item=kind_parent}
								<option value="{$kind_parent.id}" {if $ret_post.kind_parent eq $kind_parent.id}selected{/if}>{$kind_parent.name}</option>
								{/foreach}
					</select>
				</p>
				<p>
						<label>Wybierz typ</label>
						<select name="search_form[type_id]" onchange="window.location='{$path}/szukaj/?cecha=' + this.value;">
						

						<option value="clear"> - wybierz - </option>
						{foreach from=$feature_list item=type}
						<option {if $ret_post.type_id eq $type.id}selected="selected"{/if} value="{$type.id}">{$type.name}</option>
						{/foreach}
						
						
						</select>
				</p>
				<p>				
					<label for="search_form[price_from]">Cena od</label>
					<input class="advPrice" type="text" id="search_form[price_from]" name="search_form[price_from]" value="{$ret_post.price_from}">					
					<label for="search_form[price_from]">Cena do</label>
					<input class="advPrice" type="text" id="search_form[price_to]" name="search_form[price_to]" value="{$ret_post.price_to}">
				</p>

			</div>
				</form>	
			<div class="advButtons">
				{if $advanced}
		
				<button onclick="window.location='{$DP}szukaj/none';" class="bnClean"></button>	

		
				{/if}
				
				<a onclick="javascript:document.searchadv.submit()"><img style="cursor: pointer;" src="{$DP}images/html/bn_search.gif" alt="szukaj"></a>
		
				
			</div>	


</div>