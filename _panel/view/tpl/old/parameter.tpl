{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}

<tr>
	<td align="left">
		
		<form name="ConfigTableEdit" method="post" >
		
		<input type="hidden" name="action" value="SaveChangeableParameters">
		
		<table border="0" cellpadding="5" cellspacing="0" width="960" align="left">
			
			{if $message}
			<tr valign="top">
				<td align="left" style="color:red;" colspan="2">{$message}<br><br></td>
			</tr>
			{/if}
			
			{if $parameters_list}
			{foreach from=$parameters_list item=parameter}
			
			{if $parameter.name eq speed_carousel}
			<tr valign="top">
				<td width="1">szybkość karuzeli:</td>
				<td width="90%">

					<select name="config_form[{$parameter.name}]" class="long"  style="width:330px; border:1px groove #000000;">
						<option value="1" {if $parameter.content eq 1}selected{/if}>1</option>
						<option value="2" {if $parameter.content eq 2}selected{/if}>2</option>
						<option value="3" {if $parameter.content eq 3}selected{/if}>3</option>
						<option value="4" {if $parameter.content eq 4}selected{/if}>4</option>
						<option value="5" {if $parameter.content eq 5}selected{/if}>5</option>
						<option value="6" {if $parameter.content eq 6}selected{/if}>6</option>
						<option value="7" {if $parameter.content eq 7}selected{/if}>7</option>
						<option value="8" {if $parameter.content eq 8}selected{/if}>8</option>
						<option value="9" {if $parameter.content eq 9}selected{/if}>9</option>
						<option value="10" {if $parameter.content eq 10}selected{/if}>10</option>
					</select>
					<img src="{$path}/images/help.gif" title="{$parameter.description}">
				</td>
			</tr>
			
			{elseif $parameter.name eq blog_active}
				<tr valign="top">	
					<td width="1">aktywacja bloga:</td>
					<td width="90%">
				
						<select name="config_form[{$parameter.name}]" class="long"  style="width:330px; border:1px groove #000000;">
							<option value="0" {if $parameter.content eq 0}selected{/if}>Nie</option>
							<option value="1" {if $parameter.content eq 1}selected{/if}>Tak</option>

						</select>
						<img src="{$path}/images/help.gif" title="{$parameter.description}">
					</td>			
				</tr>
			{else}
			<tr valign="top">
				<td width="1">{$parameter.name}:</td>
				<td width="90%">
					<input type="text" name="config_form[{$parameter.name}]" value='{$parameter.content|default:$ret_post.content}' class="long" style="width:330px;">
					<img src="{$path}/images/help.gif" title="{$parameter.description}">
				</td>
			</tr>
			{/if}
			
			{/foreach}
			{/if}
			
			<tr valign="top">
				<td>&nbsp;</td>
				<td align="left" style="padding-left:100px;">
					<input type="submit" value="{$dict_templates.Save}" name="save" class="adm2">
				</td>
			</tr>
			
		</table>
		</form>
	</td>
</tr>


<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
				&nbsp;
				

{include file=foot.tpl}