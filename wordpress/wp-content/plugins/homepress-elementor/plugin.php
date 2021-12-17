<?php
namespace HomepressWidgets;

use HomepressWidgets\Widgets\HomepressButton;
use HomepressWidgets\Widgets\ImageCarousel;
use HomepressWidgets\Widgets\Infobox;
use HomepressWidgets\Widgets\ListingAccount;
use HomepressWidgets\Widgets\ListingCompare;
use HomepressWidgets\Widgets\ListingNeighborhoods;
use HomepressWidgets\Widgets\ListingPosts;
use HomepressWidgets\Widgets\ListingSearch;
use HomepressWidgets\Widgets\ListingTypeBanner;
use HomepressWidgets\Widgets\ListingWishlist;
use HomepressWidgets\Widgets\Logo;
use HomepressWidgets\Widgets\MortgageCalc;
use HomepressWidgets\Widgets\Navigation;
use HomepressWidgets\Widgets\Post;
use HomepressWidgets\Widgets\PropertySlider;
use HomepressWidgets\Widgets\Services;
use HomepressWidgets\Widgets\Staff;
use HomepressWidgets\Widgets\Testimonials;
use HomepressWidgets\Widgets\Users;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */

class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
        require __DIR__ . '/widgets/homepress_button.php';
        require __DIR__ . '/widgets/image_carousel.php';
        require __DIR__ . '/widgets/infobox.php';
        require __DIR__ . '/widgets/listing_account.php';
        require __DIR__ . '/widgets/listing_compare.php';
        require __DIR__ . '/widgets/listing_neighborhoods.php';
        require __DIR__ . '/widgets/listing_posts.php';
        require __DIR__ . '/widgets/listing_search.php';
        require __DIR__ . '/widgets/listing_type_banner.php';
        require __DIR__ . '/widgets/listing_wishlist.php';
        require __DIR__ . '/widgets/logo.php';
        require __DIR__ . '/widgets/mortgage_calc.php';
        require __DIR__ . '/widgets/navigation.php';
        require __DIR__ . '/widgets/post.php';
        require __DIR__ . '/widgets/property_slider.php';
        require __DIR__ . '/widgets/services.php';
        require __DIR__ . '/widgets/staff.php';
        require __DIR__ . '/widgets/testimonials.php';
        require __DIR__ . '/widgets/users.php';
    }

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new HomepressButton() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ImageCarousel() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Infobox() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ListingAccount() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ListingCompare() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ListingNeighborhoods() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ListingPosts() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ListingSearch() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ListingTypeBanner() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ListingWishlist() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Logo() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new MortgageCalc() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Navigation() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Post() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PropertySlider() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Services() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Staff() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Testimonials() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Users() );
    }

}

new Plugin();