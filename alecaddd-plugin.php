<?php
/**
 * @package Akismet
 */
/*
Plugin Name: Alecaddd Plugin
Plugin URI: https://akismet.com/
Description: It helps you to create custome post type. To get started: activate the Alecaddd plugin and then go to your books Settings page to set up your first custom post.
Version: 1.0.0
Author: Sawan Wasnik
Author URI: https://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: alecaddd-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

//following first 3 method/function does same work.

/* 
	if(! defined('ABSPATH')) { // If Unauthorised person is trying to access this file
		die; // Prevent Unauthorised Access
	}

	// if add_action() doesn't exist then wordpress didn't take any action
	if( ! function_exists('add_action')) {
		echo 'hey, you can not access this file';
		exit();
	}
*/
defined('ABSPATH') or die('hey you can\'t access this file');

class AlecadddPlugin
{
	function __construct() {
		// here we are passing custome_post_type as parameter in the array to initialize CPT.
		// $this keyword reffering to AlecadddPlugin Class 
		// add_action() serching custom_post_type in the AlecadddPlugin class.
		add_action('init', array($this, custome_post_type));
	}
	
	function activate() {
		// generating a Custome Post Type
		$this->custome_post_type();
		// flush rewrite rules
		flush_rewrite_rules();
	}

	function deactivate() {
		// flush rewrite rules
		flush_rewrite_rules();
	}

	function unistall() {
		// delete CPT
		// delete all the plugin data from the DB
	}
	function custome_post_type() {
		// registering post type. e.g. 'book' it could be anything.
		register_post_type('book', ['public'=>true, 'label'=>'Books']);
	}
}

if(class_exists('AlecadddPlugin')) {
	
	$alecadddPlugin = new AlecadddPlugin();
}

// activation.
register_activation_hook('FILE', array($alecadddPlugin,'activate'));
 // we are passing here $alecadddPlugin Object and activate() as parameter.

// deactivation
register_activation_hook('FILE', array($alecadddPlugin,'deactivate'));

// uninstall