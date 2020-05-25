<?php
define('THEME_VERSION', '1.0.0');
add_theme_support( 'custom-logo' );
add_theme_support( 'menus' );

function enqueue_blocks() {
  wp_enqueue_style('block-styles', get_template_directory_uri() . '/build/blocks.css', [], THEME_VERSION);
  wp_enqueue_script( 'gutenberg-blocks', get_template_directory_uri() . '/build/blocks.js', [ 'wp-blocks', 'wp-element', 'wp-editor' ], THEME_VERSION, true );
}

/**
 * Makes menu item urls relative
 *
 * @param array $menu_item
 * @return array
 */
function format_menu_item_link($menu_item) {
  $site_url = get_site_url();
  $menu_item_url = (string) $menu_item['url'];

  if (strpos($menu_item_url, $site_url) !== false) {
    $path = parse_url($menu_item_url, PHP_URL_PATH);

    if (!empty($path)) {
      $menu_item['url'] = $path;
    }
  }

  return $menu_item;
}

/**
 * Triggers Bitbucket pipeline with static content generation process
 * on save post action
 *
 * @param int $post_id
 */
//function trigger_build($post_id) {
//  // Bail on auto save
//  if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
//    return;
//  }
//  // Credentials not defined
//  if (!defined('BITBUCKET_PIPELINE_URL') ||
//    !defined('BITBUCKET_USERNAME') ||
//    !defined('BITBUCKET_PASS') ||
//    !defined('BITBUCKET_BRANCH')) {
//    return;
//  }
//  // Make a request to Bitbucket REST API
//  $url = BITBUCKET_PIPELINE_URL;
//  $username = BITBUCKET_USERNAME;
//  $password = BITBUCKET_PASS;
//  $branch = BITBUCKET_BRANCH;
//  // Auth
//  $auth = base64_encode( $username . ':' . $password );
//  // Body
//  $data = [
//    'target' => [
//      'ref_type' => 'branch',
//      'type' => 'pipeline_ref_target',
//      'ref_name' => $branch
//    ]
//  ];
//
//  $body = wp_json_encode($data);
//  // Setup & send Request
//  $request_options = [
//    'headers' => [
//      'Authorization' => 'Basic ' . $auth,
//      'Content-Type' => 'application/json',
//      'Content-Length' => strlen($body)
//    ],
//    'body' => $body
//  ];
//
//  wp_remote_post($url, $request_options);
//}

// ACTIONS
add_action('enqueue_block_editor_assets', 'enqueue_blocks');
//add_action('save_post', 'trigger_build');
// FILTERS
add_filter('rest_menus_format_menu_item', 'format_menu_item_link');
