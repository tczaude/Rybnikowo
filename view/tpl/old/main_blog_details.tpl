{literal}
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'titlePosition' 	: 'over',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.6
			});
		});
	</script>
{/literal}


	<article class="details">
		<h2>{$blog_details.title}</h2>
		
		<div class="list2-l">
			
			<a rel="example_group" href="{$DP}images/blog/{$blog_details.blog_id}_04_01.jpg" title="{$blog_details.title}"> 
				<img width="190" style="float: left; padding: 0 35px;" class="pic2" src="{$DP}images/blog/{$blog_details.blog_id}_03_01.jpg" alt="{$blog_details.title}" title="{$blog_details.title}">
			</a>
			<p class="date">{$blog_details.date_created|date_format:"%Y-%m-%d"} {*<a href="#"><img src="{$DP}images/html/bn_recommend.gif" alt="polec znajomemu"></a>*}</p>
			
			<p class="abstract">
				<strong>{$blog_details.abstract}</strong>
			</p>			
			<p>
				{$blog_details.content}
			</p>
	            <div class="detailsLike">
	            

						<div id="fb-root"></div><script src="http://connect.facebook.net/pl_PL/all.js#appId=213809702007823&amp;xfbml=1"></script><fb:like href="{$DP}blog/zobacz/{$blog_details.url_name}/" width="350" show_faces="true" action="like" font=""></fb:like>
						{literal}
						<!-- Umieść ten tag w sekcji head lub bezpośrednio przed zamknięciem tagu body. -->
						<script type="text/javascript" src="http://apis.google.com/js/plusone.js">
						  {lang: 'pl'}
						</script>
						<!-- Umieść ten tag w miejscu, gdzie ma pojawić się przycisk +1 -->
						<g:plusone size="medium"></g:plusone>			
						{/literal}		
            
	            
	            
	            </div>
	            <div class="detailsLike">
	            	<div id="fb-root"></div><script src="http://connect.facebook.net/pl_PL/all.js#xfbml=1"></script><fb:comments href="{$DP}blog/zobacz/{$blog_details.url_name}/" num_posts="5" width="520"></fb:comments>
	            </div>
			<p><a class="button" href="javascript:history.back();"><i>wróć</i></a></p>
		
	</article>