<?php

class MenuRoutes {
  function __construct() {
    $this->registerRoutes();
  }

  public function registerRoutes () {
    add_action( 'rest_api_init', function () {
      register_rest_route( 'sms/v1', '/menu/(?P<name>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => array( $this, 'get_menu' )
      ) );
    } );
  }

  public function get_menu ($request) {
    $response = array();
 
    $items = wp_get_nav_menu_items($request['name']);
  
    foreach ($items as $item) {
      // wordpress menus returned are always a flat list, even if it's nested in the admin
      if ($item->menu_item_parent > 0) {
        $response = $this->build_child_items($response, $item);
      } else {
        $response[] = $this->build_item($item);
      }

    } 
  
    return $response;
  }

  public function build_child_items($items, $item) {
    foreach($items as $_possibleParent => &$possibleParent) {
      if (intval($item->menu_item_parent) === $possibleParent['id']) {
        $possibleParent['items'][] = $this->build_item($item);
      } else if (count($possibleParent['items']) > 0) {
        $possibleParent['items'] = $this->build_child_items($possibleParent['items'], $item);
      }
    }
    return $items;
  }

  public function build_item($item) {
    return array(
      'id' => $item->ID,
      'title' => $item->title,
      'url' => $item->url,
      'items' => array(),
    );
  }
}

new MenuRoutes();

