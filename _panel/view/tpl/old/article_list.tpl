{include file=head.tpl}

<table border="0" cellpadding="5" cellspacing="0" width="960" align="center">

{include file="page_intro.tpl"}
{*include file="articles_category_config.tpl"*}

<tr valign="middle" align="left">
	<td>{$dict_templates.SetCategory} :&nbsp;&nbsp;
		<select name="CategoryId" class="adm11"  style="width:330px;" onchange="window.location='{$path}/article/index/' + this.value;">
			{foreach from=$dict_templates.article_category item=category key=key}
			<option value="{$key}" {if $category_id eq $key}selected{/if}>{$category}</option>
			{/foreach}
		</select>
	</td>
</tr>
{if $category_id eq 8 || $category_id eq 9 || $category_id eq 10|| $category_id eq 6}
<tr>
	<td align="left">
		<input type="button" style="width:150px;" value="{$dict_templates.AddNewArticle}" onclick="javascript: openwin('{$path}/article/new/1/{$category_id}');">
	</td>
</tr>
{/if}
<tr>
	<td width="100%" valign="top" align="center" colspan="1">
		
		<img src="{$path}/images/kreska_adm_gray.gif" width="960" height="1"><br>
		
		<table border="0" align="left" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
			{*{include file="filters_article.tpl"}*}
			{include file="paging_article.tpl"}
				<table border="0" cellpadding="5" cellspacing="0" width="960">
				

				<tr>
					<td>
						<table border="0" cellpadding="3" cellspacing="0" width="960">
						
						{if $articles_list}
						
						{foreach from=$articles_list item=article name=article}
						
						{cycle name=color assign=row_color values="#FFFFFF,#EEEEE1"}
						
						<tr bgcolor="{$row_color}">
							
							<td width="90%" align="left" {if $article.status ne 2}style="color:#bbbbbb;"{/if}>
								<span style="font-weight:italic;font-size:9px;color:#bbbbbb;">{$dict_templates.ArticleDateCreated} : {$article.date_created|date_format:"%Y-%m-%d"}</span><br>
								{$article.title}
							</td>
							
							<td>{if !$smarty.foreach.article.first}<a href="{$path}/article/up/{$article.article_id}/{$article.category_id}"><img src="{$path}/images/up.gif" border="0" title="{$dict_templates.MoveUp}"></a>{/if}&nbsp;</td>
							<td>{if !$smarty.foreach.article.last}<a href="{$path}/article/down/{$article.article_id}/{$article.category_id}"><img src="{$path}/images/down.gif" border="0" title="{$dict_templates.MoveDown}"></a>{/if}&nbsp;</td>
							
							<td nowrap align="center">
								{foreach from=$language_list item=language}
									{if $language.id eq $admin_data.language}
									<a href="javascript: openwin('{$path}/article/edit/{$article.article_id}/{$language.id}');"><img src="{$path}/images/page_white_edit.png" border="0" title="{$dict_templates.Edit} ({$language.short})"></a>&nbsp;
									{/if}
								{/foreach}
							</td>
							<td>
								{if $article.status eq 2}
								<a href="{$path}/article/status/{$article.article_id}/1/{$paging.current}" title="ustaw status niewidoczny"><img src="{$path}/images/delete.png" border="0" title="{$dict_templates.SetStatus}"></a>
								{else}
								<a href="{$path}/article/status/{$article.article_id}/2/{$paging.current}" title="ustaw status widoczny"><img src="{$path}/images/tick.png" border="0" title="{$dict_templates.SetStatus}"></a>
								{/if}
							</td>
							{*
							<td nowrap align="center" width="21">
								
								<a href="javascript: openwin_big('article_product.php?action=index&ArticleId={$article.article_id}');" title="wybierz produkty dla artykułu"><img src="{$path}/images/page_white_magnify.png" border="0" title="{$dict_templates.GetProductsForArticle}"></a>

							</td>
							*}
							{if $category_id eq 8 || $category_id eq 9 || $category_id eq 10}
							<td>
								<a href="{$path}/article/remove/{$article.article_id}"><img src="{$path}/images/cut.png" border="0" title="{$dict_templates.Remove}"></a>
							</td>
							{/if}
							
						</tr>
						
						{/foreach}
						
						{else}
						<tr>
							<td colspan="6"><b>{$dict_templates.NoResults}</b></td>
						</tr>
						{/if}
						</table>
					</td>
				</tr>
				</table>
				
				{include file="paging_article.tpl"}

{literal}		
<script type="text/javascript">

function openwin(url)
{
	var w = 550;
	var h = 600;
	dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
}

function openwin_big(url)
{
	var w = 800;
	var h = 700;
	dodanie = window.open(url,'dodanie','resizable,scrollbars,width='+w+',height='+h+',left=' + ((screen.width-w)/2) + ', top=' + ((screen.height-h)/ 2));
}

</script>
{/literal}

{include file=foot.tpl}