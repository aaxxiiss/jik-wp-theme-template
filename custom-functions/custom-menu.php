<?php
// custom menu, based on example @ https://digwp.com/2011/11/html-formatting-custom-menus/
function clean_custom_menus() {
	$menu_name = 'top-menu';
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<nav class="navbar navbar-expand navbar-dark bg-dark py-0 mb-5">' ."\n";
        $menu_list .= "\t\t\t\t". '<div class="container">' ."\n";
		$menu_list .= "\t\t\t\t\t". '<ul class="navbar-nav text-uppercase mx-auto">' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= "\t\t\t\t\t\t". '<li class="nav-item mx-3"><a class="nav-link text-light" href="'. $url .'">'. $title .'</a></li>' ."\n";
		}
        $menu_list .= "\t\t\t\t\t". '</ul>' ."\n";
        $menu_list .= "\t\t\t". '</div>' ."\n";
		$menu_list .= "\t\t\t". '</nav>' ."\n";
	} else {
		$menu_list = '<div class="container text-danger">No menu defined</div>';
	}
	echo $menu_list;
}