<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

if (!class_exists('Timber')) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

$context = Timber::get_context();
$posts = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();

$menu = new TimberMenu();
$context['menu'] = $menu;
$context['posts'] = $posts;

$context['title'] = 'Archive';
if (is_day()) {
	$context['title'] = 'Archive: ' . get_the_date( 'D M Y' );
} else if (is_month()) {
	$context['title'] = 'Archive: ' . get_the_date( 'M Y' );
} else if (is_year()) {
	$context['title'] = 'Archive: ' . get_the_date( 'Y' );
} else if (is_tag()) {
	$context['title'] = single_tag_title('', false);
} else if (is_category()) {
	$context['title'] = single_cat_title('', false);
	//array_unshift($templates, 'archive-' . get_query_var('cat') . '.twig');
} else if (is_post_type_archive()) {
	$context['title'] = post_type_archive_title( '', false );
	//array_unshift($templates, 'archive-' . get_post_type() . '.twig');
}

$i = 1;
foreach ($posts as $post) {

	foreach (get_the_category($post->ID) as $category) {
		$post->category_slug = $category->slug;
		$post->category_link = get_category_link($category);
	}

	$i++;
}

$context['base_url'] = get_site_url();

if (is_category()) {
	$context['category_slug'] = get_category(get_query_var('cat'))->slug;
}
$templates = array('archive.twig');

if (count($posts) == 0) {
	$context['no_posts'] = true;
}

Timber::render($templates, $context);