<?php
/**
 * Config array containing the hook locations and Schema items to remove.
 *
 * @package ChristophHerr\BeansRemoveSchema
 * @author      christophherr
 * @license     GPL-2.0+
 *
 * @since   1.0.0
 */

namespace ChristophHerr\BeansRemoveSchema;

return [
	'beans_header'                     => [
		'itemscope',
		'itemtype',
	],
	'beans_body'                       => [
		'itemscope',
		'itemtype',
	],
	'beans_site_title_link'            => 'itemprop',
	'beans_site_title_tag'             => 'itemprop',
	'beans_primary_menu'               => [
		'itemscope',
		'itemtype',
	],
	'beans_content'                    => [
		'itemprop',
		'itemscope',
		'itemtype',
	],
	'beans_sidebar_primary'            => [
		'itemscope',
		'itemtype',
	],
	'beans_sidebar_secondary'          => [
		'itemscope',
		'itemtype',
	],
	'beans_post'                       => [
		'itemscope',
		'itemtype',
		'itemprop',
	],
	'beans_post_title'                 => 'itemprop',
	'beans_post_body'                  => 'itemprop',
	'beans_post_image_item'            => 'itemprop',
	'beans_post_content'               => 'itemprop',
	'beans_post_meta_date'             => 'itemprop',
	'beans_post_meta_author'           => [
		'itemprop',
		'itemscope',
		'itemtype',
	],
	'beans_post_meta_author_name_meta' => 'itemprop',
	'beans_comment'                    => [
		'itemprop',
		'itemscope',
		'itemtype',
	],
	'beans_comment_title'              => [
		'itemprop',
		'itemscope',
		'itemtype',
	],
	'beans_comment_time'               => 'itemprop',
	'beans_comment_body'               => 'itemprop',
	'beans_footer'                     => [
		'itemscope',
		'itemtype',
	],
];
