<?php /* Smarty version 2.6.9, created on 2013-02-22 20:09:36
         compiled from panel_search.tpl */ ?>

			
		<form id="search" method="post" action="/szukaj" name="search">
			<fieldset class="hsearch">
  			<input type="hidden" value="Search" name="action">
			<label for="inputString">Czego szukasz?</label>
			<input type="text" autocomplete="on" name="search_form[phrase]" class="input-text" value="<?php echo $this->_tpl_vars['ret_post']['phrase']; ?>
" id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
			</fieldset>
			<input style="cursor: pointer;" type="submit" value="Szukaj">
			<?php echo '
	
			<script type="text/javascript">
			function lookup(inputString) {
				if(inputString.length < 2) {
					// Hide the suggestion box.
					$(\'#suggestions\').hide();
				} else {
					$.post("/suggest", {queryString: ""+inputString+""}, function(data){
						if(data.length > 0) {
							$(\'#suggestions\').show();
							$(\'#autoSuggestionsList\').html(data);
						}
					});
				}
			} // lookup
			
			function fill(thisValue) {
				
				$(\'#inputString\').val(thisValue);
				setTimeout("$(\'#suggestions\').hide();", 200);
				
			}
			
			</script>			          
			       
			       
			'; ?>

		</form>
		
		
		
					 <div class="suggestionsBox" id="suggestions" style="display: none;">
			
				<div class="suggestionList" id="autoSuggestionsList">
					
				</div>
			</div>	