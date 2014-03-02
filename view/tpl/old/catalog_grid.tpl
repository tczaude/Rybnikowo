<!DOCTYPE HTML>
<html>
	
{include file="head.tpl"}
<body>
{include file="notification.tpl"}
	<div class="bg">
			<div class="container">
				<header>
					
					{include file="header.tpl"}
									
				</header>
				
						
				<section class="breadcrumbs">
					{include file="breadcrumbs.tpl"}
				</section>
				<section class="middle-b">
					<div class="middle-t">
						<div class="middle">
						
							<aside class="sidebar">								
										{include file="sidebar_left.tpl"}								
							</aside>
							
							<section class="content">
								{include file="panel_search_advanced.tpl"}
								{*
								{include file="panel_change_view.tpl"}
								*}
								{include file=$main}
							</section>
							
						</div>
						
					</div>
				</section>
			
				
				<div class="footBottom">
					<div class="footTop">
						<footer>
					
							{include file="footer.tpl"}
					
						</footer>
					</div>
				</div>
				
				
				
			</div>
	</div>		
		
</body>

</html>