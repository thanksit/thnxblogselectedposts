{if isset($thnxblogposts)}
<div class="footer_blog_area col-sm-12 clearfix">
	{if isset($thnxbsp_title)}
		<div class="footer_blog_title">
			<em>{$thnxbsp_title}</em>
		</div>
	{/if}
	<div class="footer_blog_post carousel">
		{foreach from=$thnxblogposts item=thnxblgpst}
		<div class="blog_post">
			<div class="blog_post_left">
				<p>
					{$thnxblgpst.post_date|date_format:"<span>%e</span> <span>%b</span>"}
				</p>
			</div>
			<div class="blog_post_right">
				<h3 class="post_title">
					<a href="{$thnxblgpst.link}">{$thnxblgpst.post_title}</a>
				</h3>
				<div class="post_description">
					<p>
						{if isset($thnxblgpst.post_excerpt) && !empty($thnxblgpst.post_excerpt)}
							{$thnxblgpst.post_excerpt|truncate:120:'...'|escape:'html':'UTF-8' nofilter}
							<a class="read_more" href="{$thnxblgpst.link}"> {l s='Read More >>' mod='thnxblogselectedposts'}</a>
						{else}
							{$thnxblgpst.post_content|truncate:120:'...'|escape:'html':'UTF-8' nofilter}
							<a class="read_more" href="{$thnxblgpst.link}"> {l s='Read More >>' mod='thnxblogselectedposts'}</a>
						{/if}
					</p>
				</div>
			</div>
		</div>
		{/foreach}
	</div>
</div>
{/if}