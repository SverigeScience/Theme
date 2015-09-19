<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();

$context['post'] = $post;
$context['category_slug'] = null;
$context['category_link'] = null;

$menu = new TimberMenu();
$context['menu'] = $menu;

foreach(get_the_category() as $category) {
  $context['category_slug'] = $category->slug;
  $post->category_name = $post->terms[0];
  $context['category_link'] = get_category_link($category);
}

$context['wp_title'] = trim($post->title());
$context['comment_form'] = TimberHelper::get_comment_form();

$context['post_description'] = strip_tags(trim(substr($post->content, 3, 200))) . '…';

$author_email = $post->author->user_email;
$author_profile_picture_size = 128;
$author_profile_picture_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($author_email))) . "&s=" . $author_profile_picture_size;

$context['author_profile_picture'] = $author_profile_picture_url;

if (post_password_required($post->ID)) {
	Timber::render('single-password.twig', $context);
} else {
	Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $context);
}