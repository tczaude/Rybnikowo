
	<div class="footerSegment">
		<h2>Przed zakupami</h2>
		
		<ul>
			<li><a href="{$DP}pomoc">Pomoc</a></li>
			<li><a href="{$DP}dostawa">Koszt dostawy</a></li>
			<li><a href="{$DP}dostepnosc">Dostępność towarów</a></li>
			<li><a href="{$DP}platnosci">Sposoby płatności</a></li>
			<li><a href="{$DP}przesylka">Odbiór przesyłki</a></li>
		</ul>
	</div>
	
	<div class="footerSegment">
		<h2>Po zakupach</h2>
		
		<ul>
			<li><a href="{$DP}stan-zamowienia">Stan zamówienia</a></li>
			<li><a href="{$DP}reklamacja">Reklamacja</a></li>
			<li><a href="{$DP}zwrot-towaru">Zwrot towaru</a></li>
		</ul>
	</div>
	
	<div class="footerSegment">
		<h2>Moje konto</h2>
		
		<ul>
			{if !$user_data}
			<li><a href="{$DP}choose">Logowanie</a></li>
			<li><a href="{$DP}rejestracja">Rejestracja</a></li>
			<li><a href="{$DP}koszyk">Koszyk</a></li>
			{else}
			<li><a href="{$DP}wyloguj">Wyloguj</a></li>
			<li><a href="{$DP}konto">Moje konto</a></li>
			<li><a href="{$DP}koszyk">Koszyk</a></li>			
			{/if}
		</ul>
	</div>
	
	<div class="footerSegment">
		<h2>Informacje</h2>
		
		<ul>
			<li><a href="{$DP}regulamin">Regulamin</a></li>
			<li><a href="{$DP}polityka">Polityka prywatności</a></li>
		</ul>
	</div>
	
	<div class="footerSegment last">
		<h2>O sklepie</h2>
		
		<ul>
			<li><a href="{$DP}o-nas">O nas</a></li>
			<li><a href="{$DP}blog">Blog</a></li>
			<li><a href="{$DP}kontakt">Kontakt</a></li>
		</ul>
	</div>
	
	<div class="newsletter">
	<address>created by <a target="_blank" href="http://www.code13.pl/"><img src="{$DP}images/html/code13.png" alt="code13"></a></address>
		{*
		
		<h2>Newsletter</h2>
		<p>
			Lorem ipsum dolor amet lorem ipsum dolor amet lorem
		</p>
		<p>
			<input type="text">
		</p>
		<p class="bn">
			<button class="bnSave">zapisz</button>
		</p>
		
		*}
		
	</div>
	
	
