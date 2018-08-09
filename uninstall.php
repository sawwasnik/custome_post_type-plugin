<?php
// to check if wordpress generate uninstall request by itself and prevent to get uninstalled by
// unauthorised person. 
if(! defined('wp_uninstall_plugin')) {
	die();
}

/* method 1 & 2 does same work. both are use to delete plugin data from database when
	plugin get uninstalled. */

// 1. cleared database stored data.
$books = get_posts(array('post_type' => 'book','numberofposts' => -1));
foreach($books as $book) {
	wp_delete_post($book->ID, true);
}

// or
// 2. Access database via SQL to clear plugin relevant data.
global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE post_type='book'");
// wp_posts is table name where all post are get saved.
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN(SELECT id FROM wp_posts)");
// wp_postmeta is table where all meta data releted wp_posts get saved.
$wpid->query("DELETE FROM wp_term_reletionships WHERE object_id NOT IN(SELECT id FROM wp_posts)");