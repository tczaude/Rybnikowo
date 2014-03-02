<div id="head">
	<h1 class="logo">
    	<a href="">Code13 - Po twojej stronie w internecie !</a>
    </h1>
    
    <div class="head_memberinfo">
    	{*
    	<div class="head_memberinfo_logo">
        	<span>1</span>
        	<img src="{$path}/images/unreadmail.png" alt=""/>
        </div>
        *}
        <span class='memberinfo_span'>
       		 Witaj  <a href="">{$admin_data.name} {$admin_data.surname}	</a>
        </span>
        
        <span class='memberinfo_span'>
        	<a href="{$__CFG.base_url}" target="_blank">Zobacz stronę</a>
        </span>
        
        <span class='memberinfo_span'>
        	<a href="{$path}/parameter">Parametry</a>
        </span>        
        <span>
        	<a href="{$path}/logout">Wyloguj</a>
        </span>
        {*
        <span class='memberinfo_span2'>
        	<a href="">1 Masz jedną wiadomość</a>
        </span>
        *}
    </div><!--end head_memberinfo-->

</div><!--end head-->