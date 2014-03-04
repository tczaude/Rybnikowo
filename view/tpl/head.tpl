<head profile="http://dublincore.org/documents/2008/08/04/dc-html/">
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" async></script>
<script type="text/javascript" src="{$DP}js/ddaccordion.js" async></script>
<script type="text/javascript" src="{$DP}js/jquery.validate.js" async></script>
<script type="text/javascript" src="{$DP}js/jquery.fancybox-1.3.4.pack.js" async></script>
<script type="text/javascript" src="{$DP}js/cookie.policy.min.js" async></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="{$DP}js/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

{include file="meta_ext.tpl"}



</head>