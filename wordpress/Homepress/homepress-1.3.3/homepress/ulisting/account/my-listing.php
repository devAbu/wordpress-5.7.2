<?php
/**
 * Account my listing
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/my-listing.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.6.2
 */

use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmUser;
use uListing\Classes\UlistingUserRole;

wp_enqueue_script( 'ulisting-my-listing', ULISTING_URL . '/assets/js/frontend/ulisting-my-listing.js', array( 'vue' ), ULISTING_VERSION, true );

$limit = 5;
$sections = [];
$view_type = "list";
$default_listing_type = null;
$upload = wp_get_upload_dir();
$active = ulisting_page_endpoint();
$data[ 'user_id' ] = get_current_user_id();
$page = isset( $query_var[ 0 ] ) ? intval( $query_var[ 0 ] ) : 0;
$query_var = explode( '/', get_query_var( ulisting_page_endpoint() ) );
$params = array( 'limit' => $limit, 'offset' => ( $page > 1 ) ? ( ( $page - 1 ) * $limit ) : 0 );

$data[ 'query_var' ] = $query_var;

if( isset( $_GET[ 'order' ] ) )
    $params[ 'order' ] = esc_attr( $_GET[ 'order' ] );

if( isset( $_GET[ 'order_by' ] ) )
    $params[ 'order_by' ] = esc_attr( $_GET[ 'order_by' ] );

$listings = $user->getListings( false, $params );

$deleteListings = get_option('allow_delete_listings');
$deleteListings = strval($deleteListings) === 'true';
?>

<?php StmListingTemplate::load_template( 'account/navigation', [ 'user' => $user ], true ); ?>

    <div id="ulisting_my_listing" class="container account-my_listing">
        <?php if( !empty( $listings ) ) : ?>
            <div class="stm-row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-sm">
                    <?php foreach ( StmUser::get_account_link( 'account-navigation' ) as $item ) : ?>
                        <?php if( $active == $item[ 'var' ] ) { ?>
                            <h2 class="page-title"><?php echo esc_html( $item[ 'title' ] ); ?></h2>
                            <?php
                            $i = 0;
                            $listing_types = uListing_all_listing_types();
                            ?>
                            <div class="ulisting-user-listings">
                                <?php foreach ( $listing_types as $index => $listing_type ): ?>
                                    <?php

                                    wp_enqueue_style( 'ulisting_builder_stytle_' . "ulisting_item_card_" . $index . "_list", $upload[ 'baseurl' ] . "/ulisting/css/" . "ulisting_item_card_" . $index . "_list" . ".css" );
                                    $count = $user->getListings( true, [ 'listing_type_id' => $index ], '' );
                                    if( $i === 0 ) {
                                        $default_listing_type = isset( $query_var[ 1 ] ) ? intval( $query_var[ 1 ] ) : $index;
                                        $data[ 'default_type' ] = $default_listing_type;
                                    }

                                    $i++;
                                    ?>

                                    <?php if( $count > 0 ): ?>
                                        <div class="form-check-inline">
                                            <label class="form-check-label"
                                                   v-bind:class="{'active':  listing_type === <?php echo esc_attr( $index ) ?>}">
                                                <input type="radio"
                                                       v-bind:checked="listing_type === <?php echo esc_attr( $index ) ?>"
                                                       v-on:change="changeType(<?php echo esc_attr( $index ) ?>)"
                                                       class="form-check-input"
                                                       name="listing_types"><?php echo esc_attr( $listing_type ); ?>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php } ?>
                    <?php endforeach; ?>

                    <div class="my_listing_box_wrap">
                        <?php

                        foreach ( $listing_types as $id => $value ):?>
                            <template v-if="listing_type == <?php echo esc_attr( $id ); ?> && hasAccess">
                                <div class="my_listing_box" v-for="(listing, index) in listings[listing_type]"
                                     v-if="isActive === 'all' || isActive === listing.status">
                                    <div class="stm-row">
                                        <div class="col-lg-10 col-md-12 col-sm-12 col-sm" v-html="listing.html"></div>
                                        <div class="col-lg-2 col-md-12 col-sm-12 col-sm listing-button_box_wrap">
                                            <div class="listing-button_box">

                                                <div v-for="plan in feature_plans"
                                                     v-if="plan.payment_type == 'one_time'">
                                                </div>
                                                <?php
                                                $status = '';
                                                $capabilities = null;

                                                $stmUser = new StmUser( get_current_user_id() );
                                                $userRoles = new UlistingUserRole();

                                                foreach ( $stmUser->roles as $user_role_value ) {
                                                    foreach ( $userRoles->roles as $role_key => $role ) {
                                                        if( $role_key === $user_role_value )
                                                            $capabilities = $role[ 'capabilities' ];
                                                    }
                                                }


                                                if( $capabilities && ( isset( $capabilities[ 'listing_moderation' ] ) && $capabilities[ 'listing_moderation' ] ) )
                                                    $status = true;
                                                ?>

                                                <div class="listing-status-box">
                                                    <div v-if="listing.status === 'publish'" class="listing-status-name published"
                                                         v-bind:class="{'current': listing.active}">
                                                        <div class="status-active"
                                                             @click.prevent="listing.active = !listing.active"><?php esc_attr_e( 'Published', 'homepress' ); ?></div>
                                                        <ul>
                                                            <li>
                                                                <div class="status-actions" @click.prevent="changeStatus(listing.id, 'draft')">
                                                                    <span><?php esc_attr_e( 'Unpublish', 'homepress' ); ?></span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="edit-listing" @click.prevent="editListing('<?php echo ulisting_get_page_link('add_listing') . "?edit="?>' + listing.id)">
                                                                    <span><?php esc_attr_e( 'Edit listing', 'homepress' ); ?></span>
                                                                </div>
                                                            </li>
                                                            <?php if ($deleteListings): ?>
                                                                <li>
                                                                    <div class="delete-actions" @click.prevent="deleteListing(listing.id)">
                                                                        <span><?php esc_attr_e( 'Delete', 'homepress' ); ?></span>
                                                                    </div>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>

                                                    <div v-else-if="listing.status === 'draft'" class="listing-status-name drafted"
                                                         v-bind:class="{'current': listing.active}">
                                                        <div class="status-active"
                                                             @click.prevent="listing.active = !listing.active"><?php esc_attr_e( 'Drafted', 'homepress' ); ?></div>
                                                        <ul>
                                                            <li>
                                                                <div class="status-actions" @click.prevent="changeStatus(listing.id, 'pending')">
                                                                    <span><?php esc_attr_e( 'Publish', 'homepress' ); ?></span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="edit-listing" @click.prevent="editListing('<?php echo ulisting_get_page_link('add_listing') . "?edit="?>' + listing.id)">
                                                                    <span><?php esc_attr_e( 'Edit listing', 'homepress' ); ?></span>
                                                                </div>
                                                            </li>
                                                            <?php if ($deleteListings): ?>
                                                                <li>
                                                                    <div class="delete-actions" @click.prevent="deleteListing(listing.id)">
                                                                        <span><?php esc_attr_e( 'Delete', 'homepress' ); ?></span>
                                                                    </div>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                    <div v-else-if="listing.status === 'pending'" class="listing-status-name pending"
                                                         v-bind:class="{'current': listing.active}">
                                                        <div class="status-active"
                                                             @click.prevent="listing.active = !listing.active"><?php esc_attr_e( 'Pending', 'homepress' ); ?></div>
                                                        <ul>
                                                            <li>
                                                                <div class="status-actions" @click.prevent="changeStatus(listing.id, 'draft')">
                                                                    <span><?php esc_attr_e( 'Cancel', 'homepress' ); ?></span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="edit-listing" @click.prevent="editListing('<?php echo ulisting_get_page_link('add_listing') . "?edit="?>' + listing.id)">
                                                                    <span><?php esc_attr_e( 'Edit listing', 'homepress' ); ?></span>
                                                                </div>
                                                            </li>
                                                            <?php if ($deleteListings): ?>
                                                                <li>
                                                                    <div class="delete-actions" @click.prevent="deleteListing(listing.id)">
                                                                        <span><?php esc_attr_e( 'Delete', 'homepress' ); ?></span>
                                                                    </div>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="promote-listing-button promoted"
                                                     v-bind:class="{active:feature_panel == listing.id}">
                                                    <button @click="panel_feature_switch(listing.id)" v-if="!listing.listing_info">
                                                        <span class="my-listing-button-icon property-icon-bullhorn"></span> <?php esc_html_e( 'Promote listing', 'homepress' ); ?>
                                                    </button>


                                                    <v-timer
                                                            v-else-if="listing.listing_info"
                                                            inline-template
                                                            :starttime="moment.utc(listing.listing_info.created_date).local().format('MM DD YYYY h:mm:ss')"
                                                            :endtime="moment.utc(listing.listing_info.expired_date).local().format('MM DD YYYY h:mm:ss')"
                                                            trans='{
                                                                "day":"d",
                                                                "hours":"h",
                                                                "minutes":"m",
                                                                "seconds":"s",
                                                                "expired":"<?php esc_attr_e( 'Promotion over.', 'homepress' ); ?>",
                                                                "running":"<?php esc_attr_e( 'Promotion ends:', 'homepress' ); ?>",
                                                                "upcoming":"<?php esc_attr_e( 'Promotion will start:', 'homepress' ); ?>",
                                                                "status": {
                                                                "expired":"<?php esc_attr_e( 'Expired', 'homepress' ); ?>",
                                                                "running":"<?php esc_attr_e( 'Running', 'homepress' ); ?>",
                                                                "upcoming":"<?php esc_attr_e( 'Future', 'homepress' ); ?>"
                                                            }}'>
                                                        <div class="promoted-count-box">
                                                            <div class="promoted-count-title">{{ message }} </div>
                                                            <div class="promoted-count">
                                                                <span v-if="days != 0">{{ days }}{{ wordString.day }}</span>
                                                                <span v-if="hours != 0">{{ hours }}{{ wordString.hours }}</span>
                                                                <span>{{ minutes }}{{ wordString.minutes }}</span>
                                                            </div>
                                                        </div>

                                                    </v-timer>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="feature_panel == listing.id" class="promote-panel">

                                        <div v-if="loading" class="text-center">
                                            <div class="stm-spinner">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>

                                        <div v-if="!loading">
                                            <ul class="user-plans-box">
                                                <li v-for="plan in feature_plans"
                                                    class="col-lg-4 col-md-12 col-sm-12 col-sm">
                                                    <div class="user-plan" @click="select_feature_plan(plan)"
                                                         v-bind:class="{user_plan_active:plan.id === feature_plan_select, user_plan_selected:plan.id === selected_plan}">
                                                        <h6 class="user-plan_name"><span>{{plan.name}}</span></h6>

                                                        <p>
                                                            {{plan.feature_limit - plan.use_feature_limit}} <?php esc_html_e( 'of', 'homepress' ); ?>
                                                            {{plan.feature_count}} <?php esc_html_e( 'Feature available.', 'homepress' ); ?></p>
                                                        <div class="active-plan-icon"><i class="fa fa-check"></i></div>
                                                        {{feature_plans.payment_type}}

                                                    </div>
                                                </li>
                                                <li class="col-lg-4 col-md-12 col-sm-12 col-sm">
                                                    <a href="<?php echo ulisting_get_page_link( 'pricing_plan' ); ?>"
                                                       class="add-user-plan-link"
                                                       title="<?php esc_attr_e( 'Buy plan', 'homepress' ); ?>">
                                                        <span class="add-user-plus-icon"></span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <hr/>

                                            <div class="account-button-right-position">
                                                <button @click="save(listing.id, listing.status)" class="homepress-button"
                                                        v-bind:class="{loading:loading_save}"><?php esc_html_e( 'Save', 'homepress' ); ?></button>
                                            </div>

                                            <ul v-if="errors" class="user-plans-box-errors">
                                                <li v-for=" (val, key) in errors">{{val}}</li>
                                            </ul>

                                            <p v-if="message">{{message}}</p>

                                        </div>
                                    </div>
                                </div>
                            </template>
                        <?php endforeach; ?>
                    </div>

                    <div class="account-my_listing_empty" v-if="hasFail">
                        <h3><?php esc_html_e( 'You have no listings yet.', 'homepress' ); ?></h3>
                        <h3><?php esc_html_e( 'But you can create them.', 'homepress' ); ?></h3>
                        <a class="homepress-button"
                           href="<?php echo ulisting_get_page_link( 'add_listing' ) ?>"> <?php _e( 'Add listing', "homepress" ) ?> </a>
                    </div>
                    <div v-if="!preLoader" class="stm-row stm-justify-content-center" style="margin: 10px 0">
                        <div class="stm-spinner">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <?php
                    $data[ 'pagination_settings' ] = array(
                        'maxPagesToShow' => 8,
                        'class' => 'pagination',
                        'item_class' => 'nav-item',
                        'link_class' => 'nav-link',
                    );
                    ?>

                    <?php foreach ( $listing_types as $id => $value ):
                        if( $default_listing_type == $id )
                            $page = isset( $query_var[ 0 ] ) ? intval( $query_var[ 0 ] ) : 0;
                        else
                            $page = 0;
                        ?>

                        <template v-if="listing_type == <?php echo esc_attr( $id ); ?> && hasAccess">
                            <div class="stm-listing-pagination<?php if( $page == 0 ) { ?> first-active<?php } ?>"
                                 v-html="paginator[listing_type]"></div>
                        </template>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-sm">
                    <?php foreach ( $listing_types as $type_index => $listing_type ): ?>
                        <div class="ulisting-my-listing-sidebar"
                             v-if="listing_type == <?php echo esc_attr( $type_index ); ?>">
                            <ul class="my-listing-sidebar-wrap">
                                <li @click="change('all')" :class="{'is-active': isActive === 'all'}"
                                    class="my-listing-sidebar-item"><span><?php echo __( 'All', 'homepress' ); ?></span><span><?php echo esc_attr( $user->getListings( true, [ 'listing_type_id' => $type_index ], '' ) ); ?></span>
                                </li>
                                <li @click="change('publish')" :class="{'is-active': isActive === 'publish'}"
                                    class="my-listing-sidebar-item">
                                    <span><?php echo __( 'Publish', 'homepress' ); ?></span><?php echo esc_attr( $user->getListings( true, [ 'listing_type_id' => $type_index ], 'publish' ) ); ?>
                                </li>
                                <li @click="change('pending')" :class="{'is-active': isActive === 'pending'}"
                                    class="my-listing-sidebar-item">
                                    <span><?php echo __( 'Pending', 'homepress' ); ?></span><?php echo esc_attr( $user->getListings( true, [ 'listing_type_id' => $type_index ], 'pending' ) ); ?>
                                </li>
                                <li @click="change('draft')" :class="{'is-active': isActive === 'draft'}"
                                    class="my-listing-sidebar-item">
                                    <span><?php echo __( 'Draft', 'homepress' ); ?></span><?php echo esc_attr( $user->getListings( true, [ 'listing_type_id' => $type_index ], 'draft' ) ); ?>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="account-my_listing_empty">
                <h3><?php esc_html_e( 'You have no listings yet.', 'homepress' ); ?></h3>
                <h3><?php esc_html_e( 'But you can create them.', 'homepress' ); ?></h3>
                <a class="homepress-button"
                   href="<?php echo ulisting_get_page_link( 'add_listing' ) ?>"> <?php _e( 'Add listing', "homepress" ) ?> </a>
            </div>
        <?php endif; ?>
    </div>
<?php
wp_add_inline_script( 'ulisting-my-listing', "var ulisting_my_listing_data = json_parse('" . ulisting_convert_content( json_encode( $data ) ) . "');", 'before' );