<br>
<ul id="progress">
 {if $url_config.0 eq koszyk}
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/koszyk'">
 		<p>krok 1</p>
 		<span style="padding-left: 30px;">koszyk</span>
 	</li>
 	<li class="step">
 		<p>krok 2</p>
 		<span style="padding-left: 25px;">dostawa</span>
 	</li>
 	<li class="step">
 		<p>krok 3</p>
 		<span style="padding-left: 25px;">podgląd</span>
 	</li>
 	<li class="step">
 		<p>krok 4</p>
 		<span style="padding-left: 25px;">gotowe</span>
 	</li>	
 {elseif $url_config.0 eq zamowienie}
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/koszyk'">
 		<p>krok 1</p>
 		<span style="padding-left: 30px;">koszyk</span>
 	</li>
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/zamowienie'">
 		<p>krok 2</p>
 		<span style="padding-left: 25px;">dostawa</span>
 	</li>
 	<li class="step">
 		<p>krok 3</p>
 		<span style="padding-left: 25px;">podgląd</span>
 	</li>
 	<li class="step">
 		<p>krok 4</p>
 		<span style="padding-left: 25px;">gotowe</span>
 	</li>		
 {elseif $url_config.0 eq checkout}
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/koszyk'">
 		<p>krok 1</p>
 		<span style="padding-left: 30px;">koszyk</span>
 	</li>
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/zamowienie'">
 		<p>krok 2</p>
 		<span style="padding-left: 25px;">dostawa</span>
 	</li>
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/checkout'">
 		<p>krok 3</p>
 		<span style="padding-left: 25px;">podgląd</span>
 	</li>
 	<li class="step">
 		<p>krok 4</p>
 		<span style="padding-left: 25px;">gotowe</span>
 	</li>		
 {elseif $url_config.0 eq preview}
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/koszyk'">
 		<p>krok 1</p>
 		<span style="padding-left: 30px;">koszyk</span>
 	</li>
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/zamowienie'">
 		<p>krok 2</p>
 		<span style="padding-left: 25px;">dostawa</span>
 	</li>
 	<li class="stepon" style="cursor: pointer;" onclick="window.location='/checkout'">
 		<p>krok 3</p>
 		<span style="padding-left: 25px;">podgląd</span>
 	</li>
 	<li class="step">
 		<p>krok 4</p>
 		<span style="padding-left: 25px;">gotowe</span>
 	</li>			
 {elseif $url_config.0 eq finish}
 	<li class="stepon">
 		<p>krok 1</p>
 		<span style="padding-left: 30px;">koszyk</span>
 	</li>
 	<li class="stepon">
 		<p>krok 2</p>
 		<span style="padding-left: 25px;">dostawa</span>
 	</li>
 	<li class="stepon">
 		<p>krok 3</p>
 		<span style="padding-left: 25px;">podgląd</span>
 	</li>
 	<li class="stepon">
 		<p>krok 4</p>
 		<span style="padding-left: 25px;">gotowe</span>
 	</li>			
 {/if}
</ul>