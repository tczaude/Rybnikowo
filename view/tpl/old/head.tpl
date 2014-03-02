<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{if $tags.title}{$tags.title|strip_tags}{if $head.title} - {$head.title|strip_tags}{/if} - www.rybnikowo.code13.pl{else}{if $head.title}{$head.title|strip_tags} - {/if}SmartSklep{/if}</title>
<meta name="keywords" content="" />
<meta name="description" content="{if $head.description}{$head.description|strip_tags}{else}{/if}" />
{if $url_config.0 eq blog && $url_config.1 eq zobacz}
<link rel="image_src" href="{$DP}images/blog/{$blog_details.blog_id}_03_01.jpg" />
{/if}
{if $url_config.0 eq pozycja}
<link rel="image_src" href="{$DP}images/product/{$product_details.product_id}_03_01.jpg" />
{/if}
<meta name="author" content="Code13 - www.code13.pl" />
<link rel="shortcut icon" href="{$DP}images/html/favicon.ico" type="image/x-icon">
<link href="{$DP}styles/style.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/paginator.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/lightbox.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/tabs.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/jbar.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/uniform.default.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/jbar.colors.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css">
<link href="{$DP}styles/slideshow.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="{$DP}js/jquery.tools.min.js"></script>
<script type="text/javascript" src="{$DP}js/jquery.validate.js"></script>
<script type="text/javascript" src="{$DP}js/jquery.bar.js"></script>
<script type="text/javascript" src="{$DP}js/jquery.uniform.js"></script>
<script type="text/javascript" src="{$DP}js/function.js"></script>
<script type="text/javascript" src="{$DP}js/helpers.js"></script>
<script type="text/javascript" src="{$DP}js/ddaccordion.js"></script>
<script type="text/javascript" src="{$DP}js/jtip.js"></script>
<script type="text/javascript" src="{$DP}js/jnivo.pack.js"></script>
<script type="text/javascript" src="{$DP}js/jquery.fancybox-1.3.4.pack.js"></script>
<script src="{$DP}js/jquery.roundabout.min.js"></script>
{if $url_config.0 eq blog && $url_config.1 eq view}
<link rel="image_src" href="{$DP}images/blog/{$blog_details.blog_id}_03_01.jpg" />
{/if}
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 8]>
<link href="{$DP}styles/ie7.css" rel="stylesheet" type="text/css">
<![endif]-->

{literal}
<script type='text/javascript'>
  $(function(){
    $("select, input:checkbox, input:radio").uniform();
     
  });
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12454671-45']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


{/literal}

</head>