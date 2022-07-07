<?php
/**
 * OxyProps Lite
 *
 * @link              https://oxyprops.com
 * @since             1.0.0
 * @package           OxyProps_Lite
 * 
 * This file triggers on plugin uninstall
 */

 if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
 }

 //  Do stuff like clear database stored data via SQL
 //  global $wpdb;
 //  $wpdb->query("DELETE FROM wp_posts WHERE post_type= 'books'");
 //  $wpdb->query("DELETE FROM wp_postsmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
 //  $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");