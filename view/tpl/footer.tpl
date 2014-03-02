	<footer>
		<div class="wrapper">
			<h1><a href="/">Rybnikowo.pl - Wszystko pod ręką</a></h1>
			
			<ul>
				<li>
					<p>Kategorie</p>
					<ul>
						{foreach from=$menu_categories item=menu name=menu}
						{if $smarty.foreach.menu.iteration lt 8}
						<li><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name}</a></li>
						{/if}
						{/foreach}
					</ul>
				</li>
				<li>
					<p>&nbsp;</p>
					<ul>
						{foreach from=$menu_categories item=menu name=menu}
						{if $smarty.foreach.menu.iteration lt 15 && $smarty.foreach.menu.iteration gt 7}
						<li><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name}</a></li>
						{/if}
						{/foreach}
					</ul>
				</li>
				<li>
					<p>&nbsp;</p>
					<ul>
						{foreach from=$menu_categories item=menu name=menu}
						{if $smarty.foreach.menu.iteration lt 21 && $smarty.foreach.menu.iteration gt 14}
						<li><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name}</a></li>
						{/if}
						{/foreach}
					</ul>
				</li>

				<li>
					<p>Kontakt</p>
					<ul>	
						<li>tel: 783 306 710</li>
						<li>e-mail: serwis@rybnikowo.pl</li>
					</ul>
				</li>

				
			</ul>
			<div style="float: right; padding: 40px 40px 0 0;">
				
				<div><a target="_new" href="http://www.code13.pl"><img src="{$DP}images/html/bn-c13.png"></a></div>
				
			</div>
			</div>

	</footer>