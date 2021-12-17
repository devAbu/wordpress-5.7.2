<?php
/**
 * Content width
 */
if( !isset( $content_width ) ) $content_width = 900;

/**
 * Add custom classies to body
 */
function homepress_body_classes( $classes )
{
    if( !is_singular() ) {
        $classes[] = '';
    }
    $enable_preloader = homepress_get_option('enable_preloader', false);
    if($enable_preloader){
        $classes[] = 'enable_preloader';
    }
    $classes[] = 'homepress_layout_' . get_option( 'homepress_layout', 'homepress' );

    return $classes;
}

add_filter( 'body_class', 'homepress_body_classes' );

/**
 * Add ping back url
 */
function homepress_pingback_header()
{
    if( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}

add_action( 'wp_head', 'homepress_pingback_header' );

function homepress_add_nonces()
{
    $variables = array(
        'stm_ajax_add_review' => wp_create_nonce( 'stm_ajax_add_review' )
    );
    echo( '<script type="text/javascript">window.wp_data = ' . json_encode( $variables ) . ';</script>' );
}

add_action( 'wp_head', 'homepress_add_nonces' );
add_action( 'admin_head', 'homepress_add_nonces' );

/**
 * Custom excerpt size
 */
function homepress_minimize_word( $word, $length = '40', $affix = '...' )
{

    if( !empty( intval( $length ) ) ) {
        $w_length = mb_strlen( $word );
        if( $w_length > $length ) {
            $word = mb_strimwidth( $word, 0, $length, $affix );
        }
    }

    return sanitize_text_field( $word );
}

/**
 * Get list of options
 *
 * @return mixed|void
 */
function homepress_stored_theme_options()
{
    $options = get_option( 'stmt_to_settings', array() );
    return apply_filters( 'homepress_stored_theme_options', $options );
}

/**
 * Get single theme option
 *
 * @param $option_name
 * @return null
 */
function homepress_get_option( $option_name, $default = false )
{
    $options = homepress_stored_theme_options();
    $option = null;

    if( !empty( $options[ $option_name ] ) ) {
        $option = $options[ $option_name ];
    } elseif( isset( $default ) ) {
        $option = $default;
    }

    return $option;
}

/**
 * Get image url by id
 */
function homepress_get_image_url( $id, $size = 'full' )
{
    $url = '';
    if( !empty( $id ) ) {
        $image = wp_get_attachment_image_src( $id, $size, false );
        if( !empty( $image[ 0 ] ) ) {
            $url = $image[ 0 ];
        }
    }

    return $url;
}

/**
 * Custom search form
 */
function homepress_search_form( $form )
{
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
        <input type="text" placeholder="' . esc_attr( 'Search...', 'homepress' ) . '" value="' . get_search_query() . '" name="s" class="search-field" />
        <button type="submit" class="search-submit"><span class="property-icon-search"></span> <span class="search-button-text">' . esc_html__( 'Search', 'homepress' ) . '</span></button>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'homepress_search_form', 100 );

/**
 * Check if string is bool
 */
function homepress_check_string( $string )
{
    return $string === 'true';
}

/**
 * Crop images
 */
add_image_size( 'homepress-image-post-single', 825, 450, true );
add_image_size( 'homepress-image-post-archive', 765, 504, true );
add_image_size( 'homepress-image-post-pagination', 555, 160, true );
add_image_size( 'homepress-image-search-result', 350, 230, true );
add_image_size( 'homepress-image-services-archive', 510, 510, true );

/**
 * Pagination
 */
if( !function_exists( 'homepress_pagination' ) ) :
    function homepress_pagination( $paging_extra_class = '', $current_query = '' )
    {
        global $wp_query, $wp_rewrite;

        if( !$current_query ) {
            $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
            $pages = $wp_query->max_num_pages;
        } else {
            $paged = $current_query->query_vars[ 'paged' ];
            $pages = $current_query->max_num_pages;
        }

        if( $pages < 2 ) {
            return;
        }

        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args = array();
        $url_parts = explode( '?', $pagenum_link );

        if( isset( $url_parts[ 1 ] ) ) {
            wp_parse_str( $url_parts[ 1 ], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format = $wp_rewrite->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        $links = paginate_links( array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $pages,
            'current' => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => __( 'Prev', 'homepress' ),
            'next_text' => __( 'Next', 'homepress' ),
            'type' => 'list'
        ) );

        if( $links ) :
            ?>
            <?php echo wp_kses_post( $links ); ?>
        <?php
        endif;
    }
endif;

/**
 * Contact form 7 custom recipient
 */
function homepress_send_cf7_message_to_user( $wpcf )
{
    if( !empty( $_POST[ 'homepress_changed_recipient' ] ) ) {
        $mail = $wpcf->prop( 'mail' );

        $mail_to = get_the_author_meta( 'email', intval( $_POST[ 'homepress_changed_recipient' ] ) );

        if( !empty( $mail_to ) ) {
            $mail[ 'recipient' ] = sanitize_email( $mail_to );
            $wpcf->set_properties( array( 'mail' => $mail ) );
        }
    }

    return $wpcf;
}

add_action( "wpcf7_before_send_mail", "homepress_send_cf7_message_to_user", 8, 1 );

/**
 * Add custom user fields
 */
function homepress_user_profile_fields( $user )
{ ?>
    <h3><?php esc_html_e( 'Extra profile information', 'homepress' ); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="verified_user"><?php esc_html_e( 'Verified user', 'homepress' ); ?></label></th>
            <td>
                <input type="checkbox" name="verified_user" id="verified_user"
                       value="yes" <?php if( get_user_meta( $user->ID, 'verified_user', true ) == 'yes' ) echo 'checked="checked"'; ?> />
            </td>
        </tr>
    </table>
<?php }

add_action( 'show_user_profile', 'homepress_user_profile_fields' );
add_action( 'edit_user_profile', 'homepress_user_profile_fields' );

/**
 * Save custom user fields
 */
function homepress_save_user_profile_fields( $user_id )
{
    if( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'verified_user', isset( $_POST[ 'verified_user' ] ) ? 'yes' : null );
}

add_action( 'personal_options_update', 'homepress_save_user_profile_fields' );
add_action( 'edit_user_profile_update', 'homepress_save_user_profile_fields' );

/**
 * Get cookie
 */
function homepress_get_cookie( $name )
{
    $cookie = ( !empty( $_COOKIE[ $name ] ) ) ? $_COOKIE[ $name ] : '';
    return $cookie;
}

function homepress_allowed_html(){
    return array(
        'a' => array(
            'href'  => true,
            'title' => true,
        ),
        'img'     => array(
            'src' => true,
            'alt' => true,
        ),
        'h1'     => array(),
        'h2'     => array(),
        'h3'     => array(),
        'h4'     => array(),
        'h5'     => array(),
        'h6'     => array(),
        'h7'     => array(),
        'br'     => array(),
        'em'     => array(),
        'i'     => array(),
        'hr'     => array(),
        'span'     => array(),
        'b'     => array(),
        'strong' => array(),
        'p' => array()
    );
}

function homepress_esc_html($content) {
    return wp_kses($content, homepress_allowed_html() );
}

add_filter('elementor/frontend/the_content', function ($content) {
    return $content;
}, 10, 1);

//Header position for Elementor header
add_filter('elementor/frontend/builder_content_data', function ($data, $post_id) {

    $header_position = get_post_meta($post_id, 'hfe_header_positions', true);

    wp_localize_script('stm-hfe', "hfe_position_{$post_id}", array(
        'id' => $post_id,
        'header_position' => $header_position,
    ));

    return $data;

}, 10, 2);