<div class="home_blog_post_area {$thnxbsp_designlayout}">
	<div class="home_blog_post">
		<div class="page_title_area {$thnx.home_title_style}">
			{if isset($thnxbsp_title)}
				<h3 class="page-heading">
					<em>{$thnxbsp_title}</em>
					<span class="page_title_shadow_text"><span>{$thnxbsp_title}</span></span>
					<span class="heading_carousel_arrow"></span>
				</h3>
			{/if}
			{if isset($thnxbsp_subtext)}
				<p class="page_subtitle d_none">{$thnxbsp_subtext}</p>
			{/if}
			<div class="heading-line d_none"><span></span></div>
		</div>
		{if $thnxbsp_designlayout == 'default'}
			{include file="module:thnxblogselectedposts/views/templates/front/thnxblogselectedposts_default.tpl"}
		{elseif $thnxbsp_designlayout == 'classic'}
			{include file="module:thnxblogselectedposts/views/templates/front/thnxblogselectedposts_classic.tpl"}
		{else}
			{include file="module:thnxblogselectedposts/views/templates/front/thnxblogselectedposts_general.tpl"}
		{/if}
	</div>
</div>