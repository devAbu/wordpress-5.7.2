<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

$script_vars = homepress_scripts_vars();

wp_enqueue_script('vue.js', $script_vars['js']."vue.min.js", [], $script_vars['v'], true);
wp_enqueue_script('vue-resource.js', $script_vars['js']."vue-resource.min.js", [], $script_vars['v'], true);
wp_enqueue_script('demo-import', $script_vars['js']."demo-import.js", [], $script_vars['v'], true);

$data = [];
$data['install_end'] = false;
$data['url_template'] = get_template_directory_uri();
$data['ajax_url'] = admin_url('admin-ajax.php');
$data['token'] = envato_market()->get_option('token');
$data['website'] =  esc_url(get_site_url());

wp_add_inline_script("demo-import", " var homepress_demo_import_data = JSON.parse(' ".json_encode($data)." ') ", "before");

$auth_code = stm_check_auth();
?>

<div class="wrap about-wrap stm-admin-wrap  stm-admin-demos-screen">
	<?php homepress_get_admin_tabs('demos'); ?>

	<?php if (empty($auth_code)): ?>
		<div class="stm-admin-message">
			<?php printf(wp_kses_post(__('Please enter your <a href="%s">Activation Token</a> before running the Homepress.', 'homepress')), admin_url("admin.php?page=homepress")); ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($auth_code)): ?>

		<div class="homepress-demo-import homepress-main" id="homepress-demo-import">

			<ul class="progress-indicator">
				<li v-for="(item, key) in step" v-bind:class="{'info':step_check_active(item.id)}">
					<span class="bubble">{{key+1}}</span>
					{{item.title}}
				</li>
			</ul>

			<div class="homepress-demo-import-panel">
				<div class="preloader" v-if="preloader">
					<svg width="70px"  height="70px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;">
						<circle cx="16" cy="50" r="10" fill="none">
							<animate attributeName="r" values="10;0;0;0;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="0s"></animate>
							<animate attributeName="cx" values="84;84;84;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="0s"></animate>
						</circle>
						<circle cx="16" cy="50" r="10" fill="#43C370">
							<animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="-1.5s"></animate>
							<animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="-1.5s"></animate>
						</circle>
						<circle cx="16" cy="50" r="10" fill="#234DD4">
							<animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="-0.75s"></animate>
							<animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="-0.75s"></animate>
						</circle>
						<circle cx="16" cy="50" r="10" fill="#303441">
							<animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="0s"></animate>
							<animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="0s"></animate>
						</circle>
						<circle cx="16" cy="50" r="10" fill="#358EE1">
							<animate attributeName="r" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="0s"></animate>
							<animate attributeName="cx" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="3s" repeatCount="indefinite" begin="0s"></animate>
						</circle>
					</svg>
				</div>

				<div class="step finish" v-if="install_end">
					<span>Installation & Demo Import finished successfully!</span>
                    <div class="auxiliary_buttons">
                        <a href="<?php echo esc_url_raw(admin_url( 'admin.php?page=stmt-to-settings' ) ); ?>" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Theme Options', 'homepress' ); ?></a>
                        <a href="<?php echo esc_url( site_url( '/' ) ); ?>" target="_blank" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Visit site', 'homepress' ); ?></a>
                    </div>
				</div>

				<div v-if="!install_end">

                    <div v-if="!install_load && !preloader"  class="homepress-top">
                        <div class="left">
	                        <label v-if="privacy_policy_is_view()" style="margin-top: 10px;display: inline-block;">
		                        <input type="checkbox" v-model="privacy_policy" >
		                        I have read and agree to the <a style="color: #03a9f4" target="_blank" href="https://stylemixthemes.com/privacy-policy">Privacy Policy.</a>
	                        </label>
                            <button v-if="previous_is_view()" @click="previous" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Previous', 'homepress' ); ?></button>
                        </div>
                        <div class="right">
	                        <button v-if="install_is_view()" @click="start_install" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Start Installation', 'homepress' ); ?></button>
	                        <button v-if="next_is_view()" @click="next" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Next', 'homepress' ); ?></button>
                        </div>
                    </div>

					<!--------------------------- Home page --------------------------->

					<div class="step" v-if="active_step == 'home_page' && !preloader">
						<div class="homepress-demo-import-items">
							<div class="item" v-for="page in home_page" v-bind:class="{active:install_data.home_page == page.id}" @click="install_data.home_page = page.id">
								<div class="inner cursor_pointer">
									<div class="image">
										<img v-bind:src="page.image" alt="{{page.name}}">
									</div>
									<span>{{page.name}}</span>
								</div>
							</div>
						</div>
					</div>

					<!--------------------------- Inventory --------------------------->

					<div class="step" v-if="active_step == 'inventory' && !preloader">
						<div class="homepress-demo-import-items">
							<div class="item" v-for="page in inventory" v-bind:class="{active:install_data.inventory == page.id}" @click="install_data.inventory = page.id">
								<div class="inner cursor_pointer">
									<div class="image">
										<img v-bind:src="page.image" alt="{{page.name}}">
									</div>
									<span>{{page.name}}</span>
								</div>
							</div>
						</div>
					</div>

					<!--------------------------- Single page--------------------------->
					<div class="step" v-if="active_step == 'single_page' && !preloader">
						<div class="homepress-demo-import-items">
							<div class="item" v-for="page in single_page" v-bind:class="{active:install_data.single_page.id == page.id}" @click="install_data.single_page = page">
								<div class="inner cursor_pointer">
									<div class="image">
										<img v-bind:src="page.image" alt="{{page.name}}">
									</div>
									<span>{{page.name}}</span>
								</div>
							</div>
						</div>
					</div>

					<!--------------------------- Listing item grid --------------------------->

					<div class="step" v-if="active_step == 'listing_item_grid' && !preloader">
						<div class="homepress-demo-import-items">
							<div class="item" v-for="page in listing_item_grid" v-bind:class="{active:install_data.listing_item_grid == page.id}" @click="install_data.listing_item_grid = page.id">
								<div class="inner cursor_pointer">
									<div class="image">
										<img v-bind:src="page.image" alt="{{page.name}}">
									</div>
									<span>{{page.name}}</span>
								</div>
							</div>
						</div>
					</div>

					<!--------------------------- Listing item list --------------------------->

					<div class="step" v-if="active_step == 'listing_item_list' && !preloader">
						<div class="homepress-demo-import-items">
							<div class="item" v-for="page in listing_item_list" v-bind:class="{active:install_data.listing_item_list == page.id}" @click="install_data.listing_item_list = page.id">
								<div class="inner cursor_pointer">
									<div class="image">
										<img v-bind:src="page.image" alt="{{page.name}}">
									</div>
									<span>{{page.name}}</span>
								</div>
							</div>
						</div>
					</div>

					<!--------------------------- Listing item map --------------------------->

					<div class="step" v-if="active_step == 'listing_item_map' && !preloader">
						<div class="homepress-demo-import-items">
							<div class="item" v-for="page in listing_item_map" v-bind:class="{active:install_data.listing_item_map == page.id}" @click="install_data.listing_item_map = page.id">
								<div class="inner cursor_pointer">
									<div class="image">
										<img v-bind:src="page.image" alt="{{page.name}}">
									</div>
									<span>{{page.name}}</span>
								</div>
							</div>
						</div>
					</div>

					<!--------------------------- Settings --------------------------->
					<div class="step" v-if="active_step == 'settings' && !preloader">
						<p class="text-center">Settings</p>
					</div>

					<!--------------------------- Install --------------------------->
					<div class="step" v-if="active_step == 'install' && !preloader">

						<div class="install-panel">

							<div class="install-panel-info">
								<div v-if="install_info.image" class="image">
									<img v-bind:src="install_info.image" alt="{{page.name}}">
								</div>
								<div v-if="install_info.message" class="message">
									{{install_info.message}}
								</div>
							</div>

							<div style="clear: both;"></div>

							<div v-if="install_load" class="progress">
								<div class="progress-bar progress-bar-blue progress-bar-striped active"  v-bind:style="'width: '+progress+'%'">
									{{progress.toFixed(0)}}%
								</div>
								<div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 100%">
									<span class="sr-only"><?php _e("Progress", "homepress")?></span>
								</div>
							</div>
<!--							<div v-if="!install_load" class="install-panel-bottom">-->
<!--								<button @click="start_install" class="button button-large button-primary stm-admin-button stm-admin-large-button">Install</button>-->
<!--							</div>-->
						</div>
					</div>

					<div v-if="!install_load && !preloader"  class="homepress-bottom">
						<div class="left">

							<label v-if="privacy_policy_is_view()" style="margin-top: 15px;display: inline-block;">
								<input type="checkbox" v-model="privacy_policy" >
								I have read and agree to the <a style="color: #03a9f4" target="_blank" href="https://stylemixthemes.com/privacy-policy">Privacy Policy.</a>
							</label>

							<button v-if="previous_is_view()" @click="previous" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Previous', 'homepress' ); ?></button>
						</div>

						<div class="right">
							<button v-if="install_is_view()" @click="start_install" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Start Installation', 'homepress' ); ?></button>
							<button v-if="next_is_view()" @click="next" class="button button-large button-primary stm-admin-button stm-admin-large-button"><?php esc_html_e( 'Next', 'homepress' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
