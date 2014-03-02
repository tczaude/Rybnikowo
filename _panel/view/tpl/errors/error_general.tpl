<html>
<head>
<title>Error</title>
<link href="/styles/error.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="content">
		<h1>{$error_heading}</h1>
		{$error_message}
		{if $back}
		<br><br>
		<a href="{$back}">wróć</a>
		{/if}
	</div>
</body>
</html>