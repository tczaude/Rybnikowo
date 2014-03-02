{if $error_login}
		{literal}
		<script>
		$(document).ready(function() {
   
			showWarning('{/literal}{$error_login}{literal}');
		
		});
		
		</script>
		{/literal}
{/if}      	

{if $good_message_popup}
    	{literal}
		<script>
		$(document).ready(function() {
   
			showNotification('{/literal}{$good_message_popup}{literal}');
		
		});
		
		</script>
		{/literal}
{/if}

{if $good_message}
		{literal}
		<script>
		$(document).ready(function() {
   
			showNotification('{/literal}{$good_message}{literal}');
		
		});
		
		</script>
		{/literal}
{/if}
		
{if $bad_message}				
	{literal}
		<script>
		$(document).ready(function() {
   
			showWarning('{/literal}{$bad_message}{literal}');
		
		});
		
		</script>
	{/literal}
{/if}	

{if $error.email}				
{literal}
		<script>
		$(document).ready(function() {
   
			showWarning('{/literal}{$error_email}{literal}');
		
		});
		
		</script>
		{/literal}
{/if}	

{if $register_message}
{literal}
		<script>
		$(document).ready(function() {
   
			showNotification('{/literal}{$register_message}{literal}');
		
		});
		
		</script>
{/literal}
{/if}		