<?php

function uListing_wishlist_plugin_activation() {
	add_option("ulisting_wishlist_active", 1);
}

function uListing_wishlist_plugin_deactivation (){
	delete_option("ulisting_wishlist_active");
}

function uListing_wishlist_plugin_uninstall(){
	delete_option("ulisting_wishlist_active");
}
