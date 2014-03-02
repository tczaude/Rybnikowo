
		<form id="search_mini_form" method="post" action="/szukaj" name="search">
			<fieldset class="hsearch">
  			<input type="hidden" value="Search" name="action">
			<input type="text" autocomplete="on" name="search_form[phrase]" class="input-text" value="{$ret_post.phrase}" id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
			<input type="submit">
			{*<span onclick="showSearchAdvanced();" class="sAdv"><span>wyszukiwanie zaawansowane</span></span> <button class="bnSearch">szukaj</button>*}
			</fieldset>
			{literal}
	
			<script type="text/javascript">
			function lookup(inputString) {
				if(inputString.length < 2) {
					// Hide the suggestion box.
					$('#suggestions').hide();
				} else {
					$.post("/suggest", {queryString: ""+inputString+""}, function(data){
						if(data.length > 0) {
							$('#suggestions').show();
							$('#autoSuggestionsList').html(data);
						}
					});
				}
			} // lookup
			
			function fill(thisValue) {
				
				$('#inputString').val(thisValue);
				setTimeout("$('#suggestions').hide();", 200);
				
			}
			
			</script>			          
			       
			       
			{/literal}
		</form>

	