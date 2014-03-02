<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="pl">
<meta name="description" content=" ">
<meta name="keywords" content=" ">
<meta name="author" content="Code13 http://www.code13.pl">
<meta name="robots" content="all">
<title>Kooperatywa - {$dict_templates.Administration}</title>

<link rel="stylesheet" href="{$path}/style/c.css" type="text/css"> 
<link rel="stylesheet" href="{$path}/style/ajax_style.css" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="/_panel/js/jscalendar/calendar-win2k-cold-1.css">
<script type="text/javascript" src="/_panel/js/jscalendar/calendar.js"></script>

<script type="text/javascript" src="/_panel/js/jscalendar/lang/calendar-pl-utf8.js"></script>
<script type="text/javascript" src="/_panel/js/jscalendar/calendar-setup_3.js"></script>


<script type="text/javascript" src="{$path}/js/function.js"></script>
<script type="text/javascript" src="{$path}/js/f.js"></script>
<script type="text/javascript" src="{$path}/js/prototype/prototype.js"></script>
<script type="text/javascript" src="{$path}/js/prototype/validation.js"></script>
<script type="text/javascript" src="{$path}/js/varien/form.js"></script>












</head>
<body align="center">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td align="center">
		<table border="0" cellpadding="5" cellspacing="0" width="960">
			<tr>
				<td>
					<div class="extra-nav">
					<h2>{$dict_templates.AdministrationSection}</h2><br>
					<div>Jesteś zalogowany jako: {$admin_data.surname} {$admin_data.name}</div>
					<ul>
					{if $admin_data.level eq 2}
					{if $script_name eq "parameter"}<li class="active"><span>{$dict_templates.Parameters}</span></li>{else}<li><a href="{$path}/parametry">{$dict_templates.Parameters}</a></li>{/if}
					{if $script_name eq "contact"}<li class="active"><span>Kontakty</span></li>{else}<li><a href="{$path}/kontakt">Kontakty</a></li>{/if}
					{if $script_name eq "delivery"}<li class="active"><span>Dostawa</span></li>{else}<li><a href="{$path}/delivery">Dostawa</a></li>{/if}
					{if $script_name eq "category"}<li class="active"><span>Kategorie</span></li>{else}<li><a href="{$path}/category">Kategorie</a></li>{/if}					
					{/if}
					
					{if $script_name eq "product"}<li class="active"><span>Produkty</span></li>{else}<li><a href="{$path}/product">Produkty</a></li>{/if}
					
					{if $script_name eq "order"}<li class="active"><span>Zamówienia</span></li>{else}<li><a href="{$path}/order">Zamówienia</a></li>{/if}
					
				
					
					{if $script_name eq "auction"}<li class="active"><span>Aukcje</span></li>{else}<li><a href="{$path}/auction">Aukcje</a></li>{/if}
					
					
					
					
					{if $script_name eq "blog"}<li class="active"><span>Blog</span></li>{else}<li><a href="{$path}/blog">Blog</a></li>{/if}					
					{if $script_name eq "author"}<li class="active"><span>{if $admin_data.level eq 2}Sprzedawcy{else}Konto{/if}</span></li>{else}<li><a href="{$path}/author">{if $admin_data.level eq 2}Sprzedawcy{else}Konto{/if}</a></li>{/if}
					{if $admin_data.level eq 2}
					{if $script_name eq "user"}<li class="active"><span>{$dict_templates.Users}</span></li>{else}<li><a href="{$path}/user">{$dict_templates.Users}</a></li>{/if}
					{if $script_name eq "article"}<li class="active"><span>{$dict_templates.Articles}</span></li>{else}<li><a href="{$path}/article">{$dict_templates.Articles}</a></li>{/if}					
					{if $script_name eq "carousel"}<li class="active"><span>Slideshow</span></li>{else}<li><a href="{$path}/carousel">Slideshow</a></li>{/if}
					{if $script_name eq "admin"}<li class="active"><span>Admin</span></li>{else}<li><a href="{$path}/admin">Admin</a></li>{/if}
					{/if}
					
					</ul>
					<br />
					</div>
				</td>
			</tr>
		</table>
		</td>
		</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="100%" valign="top" align="center">
