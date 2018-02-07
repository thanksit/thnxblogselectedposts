<div class="row home_blog_post_inner carousel">
{foreach from=$thnxblogposts item=thnxblgpst}
	<article class="blog_post col-xs-12 col-sm-4">
		<div class="blog_post_content">
			<div class="blog_post_content_top">
				<div class="post_thumbnail">
					{if $thnxblgpst.post_format == 'video'}
						{assign var="postvideos" value=','|explode:$thnxblgpst.video}
						{if $postvideos|@count > 1 }
							{assign var="postvideos_carosel" value='carousel'}
						{else}
							{assign var="postvideos_carosel" value=''}
						{/if}
						{include file="module:thnxblogselectedposts/views/templates/front/post-video.tpl" videos=$postvideos width='570' height="316" class=$postvideos_carosel}
					{elseif $thnxblgpst.post_format == 'audio'}
						{assign var="postaudio" value=','|explode:$thnxblgpst.audio}
						{if $postaudio|@count > 1 }
							{assign var="postaudio_carosel" value='carousel'}
						{else}
							{assign var="postaudio_carosel" value=''}
						{/if}
						{include file="module:thnxblogselectedposts/views/templates/front/post-audio.tpl" audios=$postaudio width='570' height="316" class=$postaudio_carosel}
					{elseif $thnxblgpst.post_format == 'gallery'}
						{if $thnxblgpst.gallery_lists|@count > 1 }
							{assign var="gallery_carosel" value='carousel'}
						{else}
							{assign var="gallery_carosel" value=''}
						{/if}
						{include file="module:thnxblogselectedposts/views/templates/front/post-gallery.tpl" gallery=$thnxblgpst.gallery_lists imagesize="home_default" class=$gallery_carosel}
					{else}
						<img class="img-responsive" src="{$thnxblgpst.post_img_home_default}" alt="{$thnxblgpst.post_title}">
						<div class="blog_mask">
							<div class="blog_mask_content">
								<a class="thumbnail_lightbox" href="{$thnxblgpst.post_img_large}">
									<i class="icon-expand"></i>
								</a>
							</div>
						</div>
					{/if}
				</div>
			</div>
			<div class="post_content">
				<div class="post_meta clearfix">
					<p class="meta_date">
						<i class="icon-calendar"></i>
						{$thnxblgpst.post_date|date_format:"%b %d, %Y"}
					</p>
					<p class="meta_author">
						<i class="icon-user"></i>
						<span>{$thnxblgpst.post_author_arr.firstname} {$thnxblgpst.post_author_arr.lastname}</span>
					</p>
					<p class="meta_category">
						<i class="icon-tag"></i>
							<a href="{$thnxblgpst.category_default_arr.link}">{$thnxblgpst.category_default_arr.name}</a>
					</p>
				</div>
				<h3 class="post_title"><a href="{$thnxblgpst.link}">{$thnxblgpst.post_title}</a></h3>
				<div class="post_description">
					{if isset($thnxblgpst.post_excerpt) && !empty($thnxblgpst.post_excerpt)}
						<p>{$thnxblgpst.post_excerpt|truncate:100:' { ... }'|escape:'html':'UTF-8' nofilter}</p>
					{else}
						<p>{$thnxblgpst.post_content|truncate:100:' { ... }'|escape:'html':'UTF-8' nofilter}</p>
					{/if}
				</div>
				<div class="read_more d_none">
					<a class="more" href="{$thnxblgpst.link}">{l s='Read More..' mod='thnxblogselectedposts'}</a>
				</div>
			</div>
		</div>
	</article>
{/foreach}
</div> <!-- home_blog_post_inner -->
{*
/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
*}
