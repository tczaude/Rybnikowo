	{literal}
<script language="Javascript">
	  
	$(document).ready(function() {
	  
	    $('#password-clear').show();
	    $('#password-password').hide();
	  
	    $('#password-clear').focus(function() {
	        $('#password-clear').hide();
	        $('#password-password').show();
	        $('#password-password').focus();
	    });
	    $('#password-password').blur(function() {
	        if($('#password-password').val() == '') {
	            $('#password-clear').show();
	            $('#password-password').hide();
	        }
	    });
	    $('.default-value').each(function() {
	        var default_value = this.value;
	        $(this).focus(function() {
	            if(this.value == default_value) {
	                this.value = '';
	            }
	        });
	        $(this).blur(function() {
	            if(this.value == '') {
	                this.value = default_value;
	            }
	        });
	    });
});
  
</script>
 


<style type="text/css">
  
#password-clear {
display: none;
}
  
</style>
	{/literal}
	<h1 id="logo"><a href="/"><span>SmartSklep</span></a></h1>
	
	<nav>
		<ul id="nav1">
			<li><a href="/">strona główna</a></li>
			<li><a href="{$DP}regulamin">regulamin</a></li>
			{*<li><a href="{$DP}aplikacje">aplikacje</a></li>*}
			<li><a href="{$DP}pomoc">pomoc</a></li>		
			<li><a href="{$DP}blog">blog</a></li>
			<li><a href="{$DP}kontakt">kontakt</a></li>
		</ul>
		
		<ul id="nav2">
		
			<li class="m1"><a href="{$DP}promocje">promocje</a></li>
			<li class="m4"><a href="{$DP}nowosci">nowości</a></li>
			<li class="m3"><a href="#">katalog produktów</a>
				<ul>
				{foreach from=$menu_categories item=menu name=menu}	
				{cycle name=color assign=row_color values="#EFEFEF ,#FFF"}
					<li style="background-color: {$row_color}"><a href="{$DP}kategoria/{$menu.url_name}_{$menu.id}">{$menu.name}</a></li>
				{/foreach}
				</ul>
			</li>
			<li class="m2"><a href="http://www.smartserwis.net" target="_blank">serwis</a></li>			
		</ul>

	</nav>
	
	<aside id="ahead">
		
		{include file="panel_search.tpl"}
			<div class="ahead-t">
			<form method="post">
				<fieldset>
					{if $user_data}
	     				<a href="{$DP}konto">Twoje konto</a><a href="{$DP}wyloguj">Wyloguj</a>
	     			{else}
	     				<input type="hidden" value="LoginUser" name="action">
	    				<input name="login" type="text" value="e-mail" onfocus="if(this.value=='e-mail') this.value='';" onblur="if(this.value=='') this.value='e-mail';">
						<input style="display: none;" id="password-clear" type="text" value="hasło" autocomplete="off" />
    					<input style="margin: 0;" id="password-password" type="password" name="password" value="" autocomplete="off" />
						<div class="ahead-b">
							<a href="{$DP}rejestracja">załóż konto</a>
							<input style="cursor: pointer;" type="submit" value="zaloguj">
						</div>	
					{/if}
				</fieldset>
			</form>
			{if !$user_data}
			<div class="pass-re">zapomniałeś hasła? <a href="{$DP}odzyskaj-haslo">Klinkij tu</a></div>
			{else}
			<div class="pass-re">Zalogowany: {$user_data.name} {$user_data.surname} </div>
			{/if}
		</div>
		<div class="hbasket">
			 <a href="{$DP}koszyk">{if $basket.basket_quantity}Produktów: {$basket.basket_quantity}{else}Twój koszyk jest pusty{/if}</a>
		</div>
	</aside>
	

	

	
	
	 <div class="suggestionsBox" id="suggestions" style="display: none;">
	
		<div class="suggestionList" id="autoSuggestionsList">
			
		</div>
	</div>
		
