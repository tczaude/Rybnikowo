<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Error</title>
<link href="/styles/error.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="content">
		<div style="background-image: url(' {$DP}images/html/error.png'); background-repeat: no-repeat;">
		<div style="padding-left: 220px; height: 200px;">
		<h1>{$error_heading}</h1>
		{$error_message}
		{if $back}
		<br><br>
		<a href="{$back}">wróć</a>
		{/if}
		</div>
		</div>
	</div>
</body>
</html>