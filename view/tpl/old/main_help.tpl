{literal}
<script type="text/javascript">



//Initialize 2nd demo:
ddaccordion.init({
	headerclass: "hFaq", //Shared CSS class name of headers group
	contentclass: "cFaq", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [{/literal}{$expand_kind}{literal}], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: true, //Should contents open by default be animated into view?
	persiststate: false, //persist state of opened contents within browser session?
	toggleclass: ["close", "open"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
});

</script>
{/literal}

<article class="details">
		<h2>Pomoc</h2>
		
		{foreach from=$help_list item=help}
		<h2 class="hFaq" style="cursor: pointer;">{$help.title}</h2>
		
		<article  class="cFaq" style="margin: 5px 0 0; padding: 0 35px;">{$help.content}</article>
		{/foreach}
</article>