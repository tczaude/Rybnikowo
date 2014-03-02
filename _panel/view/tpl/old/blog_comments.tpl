{include file=head_pop.tpl}
 
<table border="0" cellpadding="5" cellspacing="0" width="95%" align="center">

{include file="popup_intro.tpl"}

<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
				
				{*include file="filters_blog_comments.tpl"
				
				{include file="paging_blog_comments.tpl"}
				*}
				<table border="0" cellpadding="5" cellspacing="0" width="100%">
				
				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="100%">
						
						<form name="article_form" method="post">
						
						<input type="hidden" name="ProductId" value="{$ProductId}">
						
						{if $comment_list}
						
						{foreach from=$comment_list item=comment name=comment}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="90%"  {if $comment.status eq '0'}style="color:#bbbbbb;"{/if}>
								<b>{$comment.login}</b><br/>
								{$comment.content|truncate:250}
							</td>
							
							<td>
								<a href="{$path}/blog_comments/remove/{$comment.id}/{$comment.blog_id}" onclick="if (confirm('Czy na pewno chcesz usunąć wybrany komentarz?')) window.location='{$path}/blog_comments/remove/{$comment.id}/{$comment.blog_id}'; return false"><img src="{$path}/images/cut.png" border="0" title="{$dict_templates.RemoveRelatedProduct}"></a>
							</td>
							
							
						</tr>

						
						{/foreach}
						
						
						</form>
	
						
						{else}
						<tr>
							<td colspan="4"><b>{$dict_templates.NoResults}</b></td>
						</tr>
						{/if}
						
						<tr>
							<td colspan="4" align="center" height="50"><input type="button" value="{$dict_templates.Close}" name="close" style="width:100px;" onclick="window.close();"></td>
						</tr>
						
						</table>
					</td>
				</tr>
				</table>
				{*
				{include file="paging_blog_comments.tpl"}
				*}
{literal}		
<script type="text/javascript">

function openwin(url)
{
	var w = 600;
	var h = 600;
	dodanie = window.open(url,'article','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
}

</script>
{/literal}

{include file=foot_pop.tpl}