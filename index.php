<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if (!class_exists('Timber')) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

$context = Timber::get_context();
$posts = Timber::get_posts();

$menu = new TimberMenu();
$context['menu'] = $menu;
$context['posts'] = $posts;

$i = 1;

foreach ($posts as $post) {
	foreach (get_the_category($post->ID) as $category) {
		$post->category_slug = $category->slug;
		$post->category_name = $post->terms[0];
		$post->category_link = get_category_link($category);
	}
	$i++;
}

$context['php_version'] = phpversion();

if (count($posts) == 0) {
	$context['no_posts'] = true;
}

$context['base_url'] = get_site_url();
$context['pagination'] = Timber::get_pagination();

$templates = array('index.twig');

Timber::render($templates, $context);