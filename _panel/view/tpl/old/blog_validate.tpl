{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#blogForm").validate({
		rules: {
			"blog_form[title]": {
				required: true,
				minlength: 5
				
			},
			"blog_form[url_name]": {
				required: true,
				minlength: 5
				
			},
			"blog_form[price]": {
				required: true,
				price: true
			},
			"blog_form[weight]": {
				required: true,
				price: true
			},
			"blog_form[author_id]": {
				required: true
			},
			"blog_form[color]": {
				required: true
			},
			"blog_form[abstract]": {
				required: true,
				minlength: 35
			}			
		},
		messages: {
			"blog_form[title]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"blog_form[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znków"
			},
			"blog_form[price]": {
				required: "Proszę podać cenę",
				price: "Proszę podać poprawną ceną rozdzieloną KROPKĄ"
			},
			"blog_form[weight]": {
				required: "Proszę podać wagę",
				price: "Proszę podać poprawną wagę rozdzieloną KROPKĄ"
			},
			"blog_form[author_id]": {
				required: "Proszę wybrać autora"
			},
			"blog_form[color]": {
				required: "Proszę wybrać kolor"
			},
			"blog_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}
			
		}
		
		

	});
});

</script>

{/literal}

