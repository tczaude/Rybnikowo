<ul class="category">
	{foreach from=$menu_categories item=menu name=menu}	
	<li {if $smarty.foreach.menu.index eq 0 || $smarty.foreach.menu.index eq 1 || $smarty.foreach.menu.index eq 2 || $smarty.foreach.menu.index eq 3 || $smarty.foreach.menu.index eq 4} style="border-top: 0;"{/if}><a href="{$DP}kategoria/{$menu.url_name}" style="background-image:url({$DP}images/category_pictures/{$menu.id}_02_01.jpg);">{$menu.name}</a></li>
	{/foreach}
</ul>