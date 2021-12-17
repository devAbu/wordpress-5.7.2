<?php
/**
 * Account edit profile
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/edit-profile.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0.2
 */
use uListing\Classes\StmUser;
use uListing\Classes\StmListingTemplate;
$data = array(
	'user_id' => $user->ID,
	'first_name' => $user->first_name,
	'last_name' => $user->last_name,
	'email' => $user->user_email,
);
$user_meta = apply_filters('ulisting_user_meta_data', ['user' => $user, 'data' => []]);
$edit_data = apply_filters('ulisting_profile_edit_data', ['user' => $user, 'data' => []]);
$data = array_merge($data, $edit_data['data']);
$data['user_meta'] = $user_meta['data'];
$active = ulisting_page_endpoint();

wp_enqueue_script('stm-profile-edit', ULISTING_URL . '/assets/js/frontend/stm-profile-edit.js', array('vue'), ULISTING_VERSION, true);
wp_add_inline_script('stm-profile-edit', "var stm_user_data = json_parse('".ulisting_convert_content(json_encode($data))."');", 'before');
?>

<?php StmListingTemplate::load_template( 'account/navigation', ['user' => $user], true );?>

<div class="container">
    <div id="stm-listing-profile-edit" class="edit-account">
        <?php foreach ( StmUser::get_account_link('account-panel' ) as $item ) : ?>
            <?php if( $active == $item['var'] ) { ?>
                <h2 class="page-title"><?php echo esc_attr( $item['title'] ); ?></h2>
            <?php } ?>
        <?php endforeach; ?>
        <div class="stm-row">
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Avatar', 'homepress' ); ?></label>
                <input type="file"
                    ref="avatar"
                    v-on:change="handleFileUpload()"
                    class="stm-form-control" />
                <span v-if="errors['avatar']" class="form-valid-error">{{errors['avatar']}}</span>
            </div>

            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'First name', 'homepress' ); ?></label>
                <input type="text"
                    v-model="first_name"
                    class="stm-form-control"
                    placeholder="<?php esc_attr_e( 'Enter first name', 'homepress' ); ?>"/>
                <span v-if="errors['first_name']" class="form-valid-error">{{errors['first_name']}}</span>
            </div>

            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo  esc_html_e( 'Last name', 'homepress' ); ?></label>
                <input type="text"
                    v-model="last_name"
                    class="stm-form-control"
                    placeholder="<?php esc_attr_e( 'Enter last name', 'homepress' ); ?>"/>
                <span v-if="errors['last_name']" class="form-valid-error">{{errors['last_name']}}</span>
            </div>

            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo  esc_html_e( 'Email', 'homepress' ); ?></label>
                <input type="email"
                       v-model="email"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter email', 'homepress' ); ?>"/>
                <span v-if="errors['email']" class="form-valid-error">{{errors['email']}}</span>
            </div>

            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Username', 'homepress' ); ?></label>
                <input type="text"
                    v-model="user_meta.nickname.value"
                    class="stm-form-control"
                    placeholder="<?php esc_attr_e( 'Enter username', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Web', 'homepress' ); ?></label>
                <input type="text"
                    v-model="user_meta.url.value"
                    class="stm-form-control"
                    placeholder="<?php esc_attr_e( 'Enter website', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Mobile Phone', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.phone_mobile.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter mobile phone', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Office Phone', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.phone_office.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter office phone', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Fax', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.fax.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter fax', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Address', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.address.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter address', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Latitude', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.latitude.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter latitude', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Longitude', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.longitude.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter longitude', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'License', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.license.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter license', 'homepress' ); ?>"/>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo esc_html_e( 'Tax number', 'homepress' ); ?></label>
                <input type="text"
                       v-model="user_meta.tax_number.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter tax number', 'homepress' ); ?>"/>
            </div>

            <?php do_action( "ulisting-profile-edit-form", ['user' => $user] ); ?>

            <div class="stm-col-12 stm-col-md-12">
                <label><?php echo esc_html_e( 'About Me', 'homepress' ); ?></label>
                <textarea
                       v-model="user_meta.description.value"
                       class="stm-form-control"
                       placeholder="<?php esc_attr_e( 'Enter about me', 'homepress' ); ?>">
                </textarea>
            </div>

            <div class="stm-col-12 stm-col-md-12">
                <hr />
                <h5><?php echo esc_html_e( 'Socials', 'homepress' ); ?></h5>
                <div class="stm-row">
                    <?php foreach ( $user->get_social() as $k => $v ) : ?>
                        <div class="stm-col-12 stm-col-md-6">
                            <div class="edit-account-field">
                                <label><?php echo esc_attr($v['name']); ?></label>
                                <input type="email"
                                    v-model="user_meta.<?php echo esc_attr($k)?>.value"
                                    class="stm-form-control"
                                    placeholder="<?php echo esc_attr($v['name']); ?>"/>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <div class="stm-col-12 stm-col-md-6">
                        <label><?php echo esc_html_e( 'Google plus', 'homepress' ); ?></label>
                        <input type="text"
                               v-model="user_meta.google_plus.value"
                               class="stm-form-control"
                               placeholder="<?php esc_attr_e( 'Google plus', 'homepress' ); ?>"/>
                    </div>
                    <div class="stm-col-12 stm-col-md-6">
                        <label><?php echo esc_html_e( 'Youtube play', 'homepress' ); ?></label>
                        <input type="text"
                               v-model="user_meta.youtube_play.value"
                               class="stm-form-control"
                               placeholder="<?php esc_attr_e( 'Youtube play', 'homepress' ); ?>"/>
                    </div>
                    <div class="stm-col-12 stm-col-md-6">
                        <label><?php echo esc_html_e( 'Linkedin', 'homepress' ); ?></label>
                        <input type="text"
                               v-model="user_meta.linkedin.value"
                               class="stm-form-control"
                               placeholder="<?php esc_attr_e( 'Linkedin', 'homepress' ); ?>"/>
                    </div>
                </div>
            </div>

        </div>

        <div class="account-button-right-position">
            <div class="alert" v-if="message" v-bind:class="'alert-'+status" ><span class="property-icon-like-up alert-icon"></span> {{message}}</div>
            <hr />
            <button @click="edit" type="button" class="homepress-button">
                <span v-if="!loading"><?php echo esc_html_e( 'Update', 'homepress' ); ?></span>
                <span v-if="loading"><?php echo esc_html_e( 'Loading...', 'homepress' ); ?></span>
            </button>
        </div>


        <h3><?php echo esc_html_e('Change Password', 'homepress'); ?></h3>
        <div class="stm-row">

            <div class="stm-col-12 stm-col-md-6">
                <label><?php echo  esc_html_e('Old password', 'homepress'); ?></label>
                <input v-model="old_password" type="password" placeholder="<?php esc_attr_e('Old password', 'homepress'); ?>" class="form-control" />
                <span v-if="password_errors['old_password']" class="form-valid-error">{{password_errors['old_password']}}</span>
            </div>

            <div class="stm-col-12 stm-col-md-6"></div>

            <div class="stm-col-12 stm-col-md-6">
                <label> <?php echo  esc_html_e('New password', 'homepress'); ?></label>
                <input v-model="new_password" type="password" placeholder="<?php esc_attr_e('New password', 'homepress'); ?>" class="form-control">
                <span v-if="password_errors['new_password']" class="form-valid-error">{{password_errors['new_password']}}</span>
            </div>

            <div class="stm-col-12 stm-col-md-6">
                <label> <?php echo  esc_html_e('Confirmation new password', 'homepress'); ?></label>
                <input v-model="new_password_confirmation" type="password" placeholder="<?php esc_attr_e('Confirmation new password', 'homepress'); ?>" class="form-control">
                <span v-if="password_errors['new_password_confirmation']" class="form-valid-error">{{password_errors['new_password_confirmation']}}</span>
            </div>

        </div>

        <div class="account-button-right-position">
            <hr />
            <p v-if="password_loading" class="text-center"><?php echo  esc_html_e('Load...', 'homepress'); ?></p>
            <button v-if="!password_loading" @click="update_password" type="button" class="homepress-button"><?php echo  esc_html_e('Update password', 'homepress'); ?></button>
            <div class="alert" v-if="password_message" v-bind:class="'alert-'+password_status" >{{password_message}}</div>

        </div>

    </div>
</div>








