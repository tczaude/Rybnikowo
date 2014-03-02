<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>www.smartsklep.net - Newsletter - {$newsletter_data.introduction.title}</title>
</head>

<body>
	<br /><br />
	<table width="675" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF" style="border:1px solid #eaeaea;">
		<tr>
		  <td>

			    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  style="font-family:verdana;font-size:11px;">
					<tr>
						<td width="657" height="63" bgcolor="#ffffff" style="font-family:verdana;font-size:11px;color:#666666;">
							<img src="{$__CFG.base_url}images/html/logo.gif" alt="www.rybnikowo.pl" />
						</td>
					</tr>
					<tr>
						<td style="font-family:verdana;font-size:11px;color:#666666;">
							
							{if $newsletter_data.introduction}
							
							<!-- introduction -->
							<table cellpadding="10" cellspacing="0" width="100%" style="font-family:verdana;font-size:11px;">
								<tr>
									<td style="padding-top:20px;">									
										<h3>{$newsletter_data.introduction.title}</h3>
										
										<table cellpadding="10" cellspacing="0" width="100%" style="font-family:verdana;font-size:10px;">
											<tr>
												<td><img src="{$__CFG.base_url}images/article/{$newsletter_data.introduction.article_id}_02_01.jpg" alt="{$newsletter_data.introduction.title}"></img></td>
												<td>
												{$newsletter_data.introduction.content}
												</td>
											</tr>
										</table>										
									</td>
								</tr>
							</table>
							<!-- introduction END -->
							
							{/if}
							
							{if $newsletter_data.sections}
							
							<!-- introduction -->
							<table cellpadding="10" cellspacing="0" width="100%" style="font-family:verdana;font-size:10px;">
								{foreach from=$newsletter_data.sections item=article}
								<tr>
									<td style="padding-top:20px;">									
										<h3>Informacje</h3>
										<h4>{$article.title}</h4>
										<table cellpadding="10" cellspacing="0" width="100%" style="font-family:verdana;font-size:10px;">
											<tr>
												<td><img src="{$__CFG.base_url}images/article/{$article.article_id}_02_01.jpg" alt="{$article.title}"></img></td>
												<td>
												{$article.abstract}
												</td>
											</tr>
										</table>
										
									</td>
								</tr>
								{/foreach}
								
							</table>
							<!-- information END -->
							
							{/if}
														
							{if $newsletter_data.products}
							<h3 style="padding-left: 10px;">Warto zobaczyć:</h3>
							<!-- introduction -->
							<table cellpadding="10" cellspacing="0" width="100%" style="font-family:verdana;font-size:10px;">
								{foreach from=$newsletter_data.products item=product}
								<tr>
									<td style="padding-top:20px;">									
										<h4><a href="{$__CFG.base_url}pozycja/{$product.url_name}" style="color: #A60B3E;">{$product.title}</a></h4>
										<table cellpadding="10" cellspacing="0" width="100%" style="font-family:verdana;font-size:10px;">
											<tr>
												<td><img src="{$__CFG.base_url}images/product/{$product.product_id}_01_01.jpg" alt="{$product.title}"></img></td>
												<td>
												
												<span style="color: #A60B3E; font-size: 12px; font-weight: bold;">{$product.price} PLN</span><br/><br/>
												{$product.abstract}
												
												
												</td>
											</tr>
										</table>
										
									</td>
								</tr>
								{/foreach}
								
							</table>
							<!-- information END -->
							
							{/if}											
						</td>
					</tr>
		    </table>
			
		  </td>
		</tr>
</table>
<br />


<table width="675" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
	  <td style="font-family:arial;font-size:8pt;color: #999999;">
	  	{$dict_templates.NewsletterFootContent}

	  </td>
  </tr>
	<tr>
	  <td style="font-family:arial;font-size:8pt;color: #999999;">

	  		<br/><br/>
	  		Jeżeli nie chcesz więcej dostawać naszego newslettera, kliknij na <a href="{$__CFG.base_url}newsletter/unsubscribe/?email={$newsletter_data.subscriber.email}&code={$newsletter_data.subscriber.hash}">tutaj</a>

	  </td>
  </tr>
	<tr>
	  <td style="font-family:arial;font-size:8pt;color: #999999;" align="right">
		<b><a href="{$__CFG.base_url}" style="color:#666666; text-decoration:none;">www.rybnikowo.pl</a></b>
	</td>
  </tr> 
</table>		 

</body>
</html>
