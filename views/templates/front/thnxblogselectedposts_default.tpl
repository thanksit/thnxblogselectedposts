<div class="row home_blog_post_inner">
	{$i=0}{$j=2}{$k=0}{$l=3}
	{foreach from=$thnxblogposts item=thnxblgpst}
		{if $i == $j}
			{$k = $j+1}
			{$j = $j+4}
		{elseif $i == $l}
			{$k = $l+1}
			{$l = $l+4}
		{else}
			{$k = 0}
		{/if}
		<article class="blog_post col-xs-12 col-sm-12 col-md-12 col-lg-6 blog_post_{if $k != 0}thumb_right{else}thumb_left{/if}">
			<div class="blog_post_content row">
				<div class="blog_post_content_top col-sm-12 col-md-6">
					<div class="post_thumbnail">
						{if isset($thnxblgpst.post_format) && $thnxblgpst.post_format == 'video'}
							{assign var="postvideos" value=','|explode:$thnxblgpst.video}
							{if $postvideos|@count > 1 }
								{assign var="postvideos_carosel" value='carousel'}
							{else}
								{assign var="postvideos_carosel" value=''}
							{/if}
							{include file="module:thnxblogselectedposts/views/templates/front/post-video.tpl" videos=$postvideos width='270' height="270" class=$postvideos_carosel}
						{elseif isset($thnxblgpst.post_format) && $thnxblgpst.post_format == 'audio'}
							{assign var="postaudio" value=','|explode:$thnxblgpst.audio}
							{if $postaudio|@count > 1 }
								{assign var="postaudio_carosel" value='carousel'}
							{else}
								{assign var="postaudio_carosel" value=''}
							{/if}
							{include file="module:thnxblogselectedposts/views/templates/front/post-audio.tpl" audios=$postaudio width='270' height="270" class=$postaudio_carosel}
						{elseif isset($thnxblgpst.post_format) && $thnxblgpst.post_format == 'gallery'}
							{if $thnxblgpst.gallery_lists|@count > 1 }
								{assign var="gallery_carosel" value='carousel'}
							{else}
								{assign var="gallery_carosel" value=''}
							{/if}
							{include file="module:thnxblogselectedposts/views/templates/front/post-gallery.tpl" gallery=$thnxblgpst.gallery_lists imagesize="home_default" class=$gallery_carosel}
						{else}
							<div class="post_thumbnail_img" style="background:url({$thnxblgpst.post_img_home_default}) no-repeat scroll center center/ cover; min-height: 270px;">
							</div>	
							<div class="blog_mask">
								<div class="blog_mask_content">
									<a class="thumbnail_lightbox" href="{$thnxblgpst.post_img_medium}">
										<i class="icon-expand"></i>
									</a>
								</div>
							</div>
						{/if}
							<div class="post_meta_date">
								{$thnxblgpst.post_date|date_format:"<b>%e</b> %b" nofilter}
							</div>
					</div>
				</div>
				<div class="post_content col-sm-12 col-md-6">
					<h3 class="post_title"><a href="{$thnxblgpst.link}">{$thnxblgpst.post_title}</a></h3>
					<div class="post_meta clearfix">
						<p class="meta_author">
							<span>{l s='By' mod='thnxblogselectedposts'} {$thnxblgpst.post_author_arr.firstname} {$thnxblgpst.post_author_arr.lastname}</span>
						</p>
						<p class="meta_category">
							<span>{l s='In' mod='thnxblogselectedposts'}</span>
							<a href="{$thnxblgpst.category_default_arr.link}">{$thnxblgpst.category_default_arr.name}</a>
						</p>
					</div>
					<div class="post_description">
						{if isset($thnxblgpst.post_excerpt) && !empty($thnxblgpst.post_excerpt)}
							<p>{$thnxblgpst.post_excerpt|truncate:100:''|escape:'html':'UTF-8' nofilter}</p>
						{else}
							<p>{$thnxblgpst.post_content|truncate:100:''|escape:'html':'UTF-8' nofilter}</p>
						{/if}
					</div>
					<div class="read_more">
						<a class="more" href="{$thnxblgpst.link}">{l s='Read More' mod='thnxblogselectedposts'}</a>
					</div>
				</div>
			</div>
		</article>
			{$i = $i+1}
	{/foreach}
</div> <!-- home_blog_post_inner -->
