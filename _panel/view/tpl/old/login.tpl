<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$head_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="{$path}/style/admin_login.css" type="text/css">


</head>
<body onload="setFocus();">

<div id="ctr" align="center">
		<div class="login">
		<div class="login-form">
			<img src="{$path}/images/admin_section.gif" alt="Login" />
			<form method="post">
			<input type="hidden" name="action" value="LoginAdmin">
			<div class="form-block">
				<div class="inputlabel">Login</div>

				<div><input name="login_form[login]" type="text" class="inputbox" size="15" /></div>
				<div class="inputlabel">Hasło</div>
				<div><input name="login_form[password]" type="password" class="inputbox" size="15" /></div>
				<div align="left"><input type="submit" name="submit" class="button" value="Zaloguj" /></div>
			</div>
			</form>
		</div>
		<div class="login-text">

			<div class="ctr"><img src="{$path}/images/logo.gif" alt="security" /></div>
			

				<p>		
					{if $message}

						<span style="color:red;">
							{$message}
						</span>

					{/if}
				</p>

		</div>
		<div class="clr"></div>
	</div>
</div>
<div id="break"></div>
<noscript>
Uwaga! Aby zarządzać witryną, obsługa Javascript musi być włączona!</noscript>
<div class="footer" align="center">

	<div align="center">
		created by <a href="http://www.code13.pl" style="color: #660000">Code 13</a>	</div>
</div>
</body>
</html>
