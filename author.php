<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
global $wp_query;

$menu = new TimberMenu();
$context['menu'] = $menu;

$context = Timber::get_context();
$posts = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();
$context['posts'] = $posts;

$i = 1;
foreach ($posts as $post) {
	foreach (get_the_category($post->ID) as $category) {
		$post->category_slug = $category->slug;
		$post->category_link = get_category_link($category);
	}

	$i++;
}

$context['base_url'] = get_site_url();

if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new TimberUser( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title'] = 'Artiklar från ' . $author->name();
}
Timber::render( array( 'author.twig', 'archive.twig' ), $context );
