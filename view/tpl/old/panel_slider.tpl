<!-- slider -->
<div class="slider-b">
	<div class="slider-t">
	<div class="slider-bg">	
	<a style="cursor: pointer;" class="backward">Poprzedni</a>
		<div class="slider-wrapper theme-default">
	            <div class="ribbon"></div>
					<div class="slideHome" style="margin-left: 80px;">
						{foreach from=$slideshow_list item=slide name=slide}
							<div class="slide">
								<a href="{$slide.abstract}">
								<img src="{$DP}images/slideshow/{$slide.slideshow_id}_03_01.jpg" alt="{$slide.title}">
								</a>
							</div>
						{/foreach}

					
					</div>
					<div class="tabsHome">	
						{foreach from=$slideshow_list item=slide name=slide}
							<span><a href="#">&nbsp;</a></span>						
						{/foreach}
						
					</div>


 		 	</div>
 		 <a style="cursor: pointer;" class="forward">Następny</a>
	 </div>
	 </div>
</div> 
<!-- slider end -->
{literal}

		<script language="JavaScript">
		  $(function() {
		      $("div.tabsHome").tabs(".slideHome > .slide", {
		
		    // enable "cross-fading" effect
		    effect: 'fade',
		    fadeOutSpeed: 2000,
		
		    // start from the beginning after the last tab
		    rotate: true
		
		    // use the slideshow plugin. It accepts its own configuration
				}).slideshow({
					
					autoplay: true,
					clickable: false,
					interval: 4000  
			
					});
		    });
		</script>
{/literal} 