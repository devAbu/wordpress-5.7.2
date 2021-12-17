<?php
/**
 * Add listing form
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/form.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.7.4
 */
use uListing\Classes\StmListingAttribute;
use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmListingCategory;
use uListing\Classes\Vendor\ArrayHelper;
use uListing\Classes\StmListingUserRelations;

wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
wp_enqueue_script('stm-google-map', ULISTING_URL . '/assets/js/frontend/stm-google-map.js', array('vue'), ULISTING_VERSION);
wp_enqueue_script('stm-file-dragdrop', ULISTING_URL . '/assets/js/frontend/stm-file-dragdrop.js', array('vue'), ULISTING_VERSION, true);
wp_enqueue_script('stm-location', ULISTING_URL . '/assets/js/frontend/stm-location.js', array('vue'), ULISTING_VERSION, true);
wp_enqueue_script('stm-osm-location', ULISTING_URL . '/assets/js/frontend/stm-osm-location.js', array('vue'), ULISTING_VERSION, true);
wp_enqueue_script('stm-form-listing', ULISTING_URL . '/assets/js/frontend/stm-form-listing.js', array('vue'), ULISTING_VERSION, true);

$submit_form_col = $listingType->getMeta('stm_listing_type_submit_form_col');
$user_role = $user->getRole();
$data = [
	'action' => ($listing) ? "edit" : "add",
	'listing_type' => $listingType->ID,
	'return_url'   => $return_url
];
if($attributeIds = $listingType->getMeta('stm_listing_type_subnit_form', true))
	$attributes = StmListingAttribute::query()->where_in('id', array_flip($attributeIds))->find();
else
	$attributes = [];
foreach ($attributes as $key => $val)
	$attributes[$key]->sort = $attributeIds[$attributes[$key]->id];

ArrayHelper::multisort($attributes, 'sort');
$data['attributes'] = $listingType->getAttributeForAddListing($attributes, $listing);

// Init category
if(isset($attributeIds['category'])) {

    $options = [];
    foreach (StmListingCategory::getListDataArray() as $category)
        if ( isset($category['id']) && $listingType->isListingTypeCategory($category['id']))
            $options[] = $category;

	$data['attributes']['category'] = array(
		'title'    => esc_html__('Category', "homepress"),
		'name'     => 'category',
		'type'     => 'category',
		'options'  => $options,
		'value'    => array(),
	);
}

// Init region
if(isset($attributeIds['region'])) {
	$data['attributes']['region'] = array(
		'title'    => esc_html__('Region', "homepress"),
		'name'     => 'region',
		'type'     => 'region',
		'options'  => \uListing\Classes\StmListingRegion::getListDataArray(),
		'value'    => array(),
	);
}

if($listing) {
	$data['id']               = $listing->ID;
	$data['title']            = $listing->post_title;
	$data['feature_image']   =  $listing->getMeta('stm_listing_feature_image' );

	// Init listing selected category
	foreach ($listing->getCategory() as $category) {
		$data['attributes']['category']['value'][] = $category->term_id;
	}

	// Init listing selected region
	foreach ($listing->getRegion() as $region) {
		$data['attributes']['region']['value'][] = $region->term_id;
	}

	if($listing_plan = $listing->getPlane(\uListing\Lib\PricingPlan\Classes\StmPricingPlans::PRICING_PLANS_TYPE_LIMIT_COUNT)){
		$data['listing_plan'] = $listing_plan;
	}

	$data['listing_plan_select'] = ($listing_plan AND ($user_plan = $listing_plan->getUserPlan())) ? $user_plan->id : 'none';

	// Init selected free listing
	if($listing->getListingsUserRelationsType() == StmListingUserRelations::TYPE_FREE) {
		$data['listing_plan_select']  = StmListingUserRelations::TYPE_FREE;
	}
}

$data['is_admin'] = current_user_can('administrator');

// Init user free plans list
$data['user_plans'][] = array(
	'id'                => 'free',
    'status'            => 'active',
    'static_count'      => (isset($user_role['capabilities']['listing_limit'])) ? $user_role['capabilities']['listing_limit'] : 0,
    'listing_limit'     => (isset($user_role['capabilities']['listing_limit'])) ? $user_role['capabilities']['listing_limit'] : 0,
	'use_listing_limit' => $user->getListings(true,array('type' =>   array('free') )),
	'expired'           => true
);

if(isset($user_plans['user_plans']))
    $data['user_plans'] = array_merge($data['user_plans'], $user_plans['user_plans']);

if(isset($user_plans['feature_plans']))
	$data['feature_plans'] = $user_plans['feature_plans'];

wp_add_inline_script('stm-form-listing', "var stm_listing_form_listing = json_parse('". ulisting_convert_content(json_encode($data)) ."');", 'before');
?>
<div id="stm-listing-form-listing">
	<div class="step" v-if="step == 'form'">
        <h1><?php echo esc_attr( $action ); ?></h1>
        <div class="add-listing-steps add-listing-step-two">
            <div class="add-listing-steps-column active-step"><h6 onclick="history.go(-1)"><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">1</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Listing Type', 'homepress' ); ?></span></span></h6></div>
            <div class="add-listing-steps-column active-step"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">2</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Create Listing', 'homepress' ); ?></span></span></h6></div>
            <div class="add-listing-steps-column"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">3</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Done', 'homepress' ); ?></span></span></h6></div>
        </div>
        <div class="listing-plans-box homepress_loading_preloader preloader_show">
            <h6><?php esc_html_e('Select Package for Listing', 'homepress')?></h6>
            <ul class="user-plans-box">
                <li v-for="plan in user_plans" v-if="plan.type != 'feature' && (plan.listing_limit || plan.listing_limit == 0) || (listing_plan_select == 'none') && (plan.id == 'free' || plan.id == listing_plan_select) && plan.status === 'active'">
                    <div v-if="listing_plan" class="listing_one-off"></div>
                    <div class="user-plan" @click="select_limit_plan(plan)" v-bind:class="{user_plan_active:plan.id == listing_plan_select, user_plan_selected:plan.id == listing_plan_select}">
                        <h6 class="user-plan_name"><span>{{plan.name}}</span></h6>

                        <v-timer
                            v-if="listing_plan_one_time && plan.id == listing_plan_select"
                            inline-template
                            :starttime="moment.utc(listing_plan.created_date).local().format('MM DD YYYY h:mm:ss')"
                            :endtime="moment.utc(listing_plan.expired_date).local().format('MM DD YYYY h:mm:ss')"
                            trans='{
                                "day":"d",
                                "hours":"h",
                                "minutes":"m",
                                "seconds":"s",
                                "expired":"Event has been expired.",
                                "running":"Till the end of event:",
                                "upcoming":"Till start of event:",
                                "status": {
                                "expired":"Expired",
                                "running":"Running",
                                "upcoming":"Future"
                            }}'
                        >
                            <div>
                                <div class="pricing-plan-counter-description">{{ message }}</div>
                                <ul class="pricing-plan-counter">
                                    <li v-if="days != 0">
                                        <span class="number">{{ days }}{{ wordString.day }}</span>
                                        <span class="format"></span>
                                    </li>
                                    <li v-if="hours != 0">
                                        <span class="number">{{ hours }}</span><span class="format">{{ wordString.hours }}</span>
                                    </li>
                                    <li>
                                        <span class="number">{{ minutes }}</span><span class="format">{{ wordString.minutes }}</span>
                                    </li>
                                    <li>
                                        <span class="number">{{ seconds }}</span><span class="format">{{ wordString.seconds }}</span>
                                    </li>
                                </ul>
                            </div>
                        </v-timer>
                        <p>{{ plan.listing_limit - plan.use_listing_limit > 0 ? plan.listing_limit - plan.use_listing_limit : 0 }} <?php esc_html_e( 'of', 'homepress' ); ?> {{plan.static_count}} <?php esc_html_e( 'Listings available.', 'homepress' ); ?></p>
                        <div class="active-plan-icon"><i class="fa fa-check"></i></div>
                    </div>
                </li>
            </ul>
            <template v-if="isAdmin">
                <h6><?php esc_html_e('Admin does not need to select a plan', 'homepress')?></h6>
            </template>
            <template v-else>
                <ul class="user-plans-box">
                    <li v-if="user_plans.length > 0 && user_plans[0]" v-bind:class="{no_limit:user_plans[0].listing_limit == 0}">
                        <a href="<?php echo ulisting_get_page_link( 'pricing_plan' ); ?>" class="add-user-plan-link" title="<?php esc_attr_e( 'Buy plan', 'homepress' ); ?>">
                            <span class="add-user-plus-icon"></span>
                        </a>
                        <div class="add_listing_arrow" v-if="user_plans.length > 0 && user_plans[0] && user_plans[0].listing_limit == 0">
                            <?php esc_html_e( 'You do not have an active subscription. Add a subscription here', 'homepress' ); ?>
                        </div>
                    </li>
                </ul>
            </template>
            <span v-if="errors['user_plan']" class="form-valid-error">{{errors['user_plan']}}</span>
        </div>

        <div class="add-listing-form homepress_loading_preloader preloader_show">
            <div class="stm-row">

                <div class="col-12 col-md-12 col-sm-12">
                    <div class="ulisting-form-group">
                        <label><?php esc_html_e('Title', "homepress")?></label>
                        <input type="text" v-model="title" />
                        <span v-if="errors['title']" class="form-valid-error">{{errors['title']}}</span>
                    </div>
                </div>

                <?php if(isset($data['attributes']['category'])):?>
                    <div class="col-12 col-md-<?php echo (is_array($submit_form_col) AND isset($submit_form_col['category'])) ? $submit_form_col['category'] : 12?> col-sm-12">
                        <?php StmListingTemplate::load_template( 'add-listing/field/category', array('attribute' => (object) $data['attributes']['category'] ), true );?>
                    </div>
                <?php endif;?>

                <?php if(isset($data['attributes']['region'])):?>
                    <div class="col-12 col-md-<?php echo (is_array($submit_form_col) AND isset($submit_form_col['region'])) ? $submit_form_col['region'] : 12?> col-sm-12">
                        <?php StmListingTemplate::load_template( 'add-listing/field/region', array('attribute' => (object) $data['attributes']['region'] ), true );?>
                    </div>
                <?php endif;?>

                <?php foreach ($attributes as $attribute):?>
                    <div class="col-12 add-listing-attribute-box col-md-<?php echo (is_array($submit_form_col) AND isset($submit_form_col[$attribute->id])) ? $submit_form_col[$attribute->id] : 12?> col-sm-12">
                        <?php StmListingTemplate::load_template( 'add-listing/field/'.$attribute->type, array('attribute' => $attribute), true );?>
                    </div>
                <?php endforeach;?>
            </div>

            <div>
                <div v-if="errors.length != 0" class="alert alert-error">
                    <span class="property-icon-close-circle alert-icon"></span>
                    <span class="property-icon-close-circle alert-icon"></span>
                    <ul>
                        <li v-for=" (val, key) in errors">{{val}}</li>
                    </ul>
                </div>
                <div class="alert alert-success" v-if="message && !loading"><span class="property-icon-like-up alert-icon"></span> {{message}}</div>
                <div class="account-button-right-position">
                    <button @click="send" class="ulisting-approve-button homepress-button">
                        <span v-if="!loading"><?php echo esc_attr( $action ); ?></span>
                        <span v-if="loading"><?php esc_html_e( 'Loading...', 'homepress' ); ?></span>
                    </button>
                </div>
            </div>
        </div>
	</div>

	<div class="step"  v-if="step == 'last'">
        <h1><?php echo esc_attr( $action ); ?></h1>
        <div class="add-listing-steps add-listing-step-three">
            <div class="add-listing-steps-column active-step"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">1</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Listing Type', 'homepress' ); ?></span></span></h6></div>
            <div class="add-listing-steps-column active-step"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">2</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Create Listing', 'homepress' ); ?></span></span></h6></div>
            <div class="add-listing-steps-column active-step"><h6><span class="add-listing-steps-icon-wrap"><span class="add-listing-steps-number">3</span> <span class="add-listing-steps-text"><?php esc_html_e( 'Done', 'homepress' ); ?></span></span></h6></div>
        </div>
        <template v-if="isAdmin">
            <h6><?php esc_html_e('Admin does not need to select a plan', 'homepress')?></h6>
        </template>
        <template v-else>
            <div class="listing-plans-box">
                <h6><?php esc_html_e( 'Plan for Featured Listings', 'homepress' )?></h6>
                <ul class="user-plans-box">
                    <li v-for="plan in user_plans" v-if="plan.feature_limit">
                        <div class="user-plan" @click="select_feature_plan(plan)" v-bind:class="{user_plan_active:plan.id == feature_plan_select, user_plan_selected:plan.id == feature_plan_select}">
                            <h6 class="user-plan_name"><span>{{plan.name}}</span></h6>
                            <p>{{plan.feature_limit}} <?php esc_html_e( 'of', 'homepress' ); ?> {{plan.static_count}} <?php esc_html_e( 'Feature available.', 'homepress' ); ?></p>
                            <div class="active-plan-icon"><i class="fa fa-check"></i></div>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo ulisting_get_page_link( 'pricing_plan' ); ?>" class="add-user-plan-link" title="<?php esc_attr_e( 'Buy plan', 'homepress' ); ?>">
                            <span class="add-user-plus-icon"></span>
                        </a>
                    </li>
                </ul>
                <span v-if="errors['user_plan']" class="form-valid-error homepress_loading_preloader preloader_show">{{errors['user_plan']}}</span>
            </div>
        </template>
		<div>
			<ul v-if="errors">
				<li v-for=" (val, key) in errors" class="alert alert-error"><span class="property-icon-close-circle alert-icon"></span> {{val}}</li>
			</ul>
			<div class="alert alert-success" v-if="message"><span class="property-icon-like-up alert-icon"></span> {{message}}</div>
            <hr />
            <div class="account-button-right-position">
                <a :href="'<?php echo ulisting_get_page_link( 'add_listing' )?>?edit=' + id" target="_blank" class="homepress-button"><?php esc_html_e( 'Edit Property', 'homepress' ); ?></a>
                <a :href="return_url" target="_blank" class="homepress-button"><?php esc_html_e( 'View Property', 'homepress' ); ?></a>
                <button @click="set_feature" class="homepress-button">
                    <span v-if="!loading"><?php esc_html_e( 'Make Featured', 'homepress' ); ?></span>
                    <span v-if="loading"><?php esc_html_e( 'Loading...', 'homepress' ); ?></span>
                </button>
            </div>
		</div>
	</div>
</div>