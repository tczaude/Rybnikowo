{include file="panel_progress.tpl}


			
		<h2>Transakcja zakończona</h2>
		
		<p class="finish" style="padding-left: 30px;">
			Wysłaliśmy na adres na Twój adres ({$user_data.email}) potwierdzenie tego zamówienia. 
		</p>
		
		<div class="basketButtons">
				<a href="/" class="button"><i>powrót do sklepu</i></a>
		</div>
		
		
	
{literal}
<script type="text/javascript"><!--
ceneo_client_email = '{/literal}{$user_data.email}{literal}';
ceneo_order_id = '{/literal}{$OrderIdFinish}{literal}';
//-->
</script>
<script type="text/javascript" src="https://ssl.ceneo.pl/transactions/track/v2/script.js?accountGuid="></script>
	
{/literal}