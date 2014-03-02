<!-- slider -->
{literal}
		<style>
			#slider ul {
				list-style: none;
				padding: 0;
				margin: 0 auto;
				width: 45em;
				height: 25em;
			}
			#slider li {
				height: 24em;
				width: 45em;
				text-align: center;
				cursor: pointer;
				top: 10px;
			}
				#slider li img {
					width: 100%;
				}
				#slider li.roundabout-in-focus {
					cursor: default;
				}
			#slider span {
				display: block;
			}
		</style>
		{/literal}
<div class="slider-b">
	<div class="slider-t">
	<div class="slider-bg">	
	<a href="#" class="s-left">Poprzedni</a>
		<div class="slider-wrapper theme-default">
	            <div class="ribbon"></div>
	            <div id="slider" class="nivoSlider">
			            
				{foreach item=slideshow from=$slideshow_list name=slideshow}
					<a href="{$slideshow.abstract}">
						<img data-transition="slideInLeft"  title="#{$slideshow.slideshow_id}" src="{$DP}images/slideshow/{$slideshow.slideshow_id}_03_01.jpg" alt="{$slideshow.title}">
					</a>
				{/foreach}
				
	
				<ul class="slider">
					<li><span><a title="Zobacz" href="http://www.smartsklep.net/kategoria/Iphone_1_5"><img src="{$DP}images/html/p1.png" alt="Award" /></a></span></li>
					<li><span><a title="Zobacz" href="http://www.smartsklep.net/pozycja/Apple-iPad-2-16GB-Wi-Fi-%28czarny%29"><img src="{$DP}images/html/p2.png" alt="Backpack" /></a></span></li>
					<li><span><a title="Zobacz" href="http://www.smartsklep.net/kategoria/Iphone_1_5"><img src="{$DP}images/html/p3.png" alt="Award" /></a></span></li>
					<li><span><a title="Zobacz" href="http://www.smartsklep.net/pozycja/Apple-iPad-2-16GB-Wi-Fi-%28czarny%29"><img src="{$DP}images/html/p4.png" alt="Backpack" /></a></span></li>
					
				</ul>						
						
			</div>
				
				{*foreach item=slideshow from=$slideshow_list name=slideshow} 
				<div id="{$slideshow.slideshow_id}" class="nivo-html-caption">
	                
					{$slideshow.abstract}
					
					!!OBRAZKI NAJLEPIEJ O WYMIARZE 690x236!!
	                
					<p class="captionLink"><a href="#">więcej &raquo;</a></p> 
	            </div>
				{/foreach*}


 		 	</div>
 		 <a href="#" class="s-right">Następny</a>
	 </div>
	 </div>
</div> 
<!-- slider end -->
{literal}

		<script>
			$(document).ready(function() {
				$('.slider').roundabout({

			         btnNext: ".s-right",
			         btnPrev: ".s-left",
			         duration: 2000,
			         autoplayDuration: 8000,
			         reflect: true,
			         autoplay: true
			         

				});
			});
		</script>
{/literal}