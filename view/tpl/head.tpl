<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{if $tags.title}{$tags.title|strip_tags}{if $head.title} - {$head.title|strip_tags}{/if} - www.rybnikowo.pl{else}{if $head.title}{$head.title|strip_tags} - {/if}www.rybnikowo.pl{/if}</title>
<link rel="shortcut icon" href="{$DP}images/html/favicon.ico" type="image/x-icon">
<meta name="keywords" content="{foreach from=$categories item=category}{$category.name}, {/foreach}" />
<meta name="description" content="{if $head.description}{$head.description|strip_tags}{else}www.rybnikowo.pl - Katalog firm{/if}" />
{if $url_config.0 eq blog && $url_config.1 eq zobacz}
<link rel="image_src" href="{$DP}images/blog/{$blog_details.blog_id}_03_01.jpg" alt="{$blog_details.product_id}"/>
{elseif $url_config.0 eq firma}
<link rel="image_src" href="{$DP}images/product/{$product_details.product_id}_03_01.jpg" alt="{$product_details.title}" />
{else}
<link rel="image_src" href="{$DP}images/html/rybnikowo.png" alt="rybnikowo.pl" />
{/if}
<meta name="author" content="esalamandra" />
<link rel="stylesheet" type="text/css" href="{$DP}styles/style.css">

<link href="{$DP}styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{$DP}styles/paginator.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="{$DP}js/ddaccordion.js"></script>
<script type="text/javascript" src="{$DP}js/jquery.validate.js"></script>
<script type="text/javascript" src="{$DP}js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="{$DP}js/cookie.policy.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="{$DP}js/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

{*
{literal}
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12454671-48']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
{/literal}
*}

</head>