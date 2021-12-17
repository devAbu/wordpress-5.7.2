<?php
/**
 * Account login
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/login.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.5.7
 */
use uListing\Classes\StmUser;

wp_enqueue_script('stm-login', ULISTING_URL . '/assets/js/frontend/stm-login.js', array('vue'), ULISTING_VERSION, true);

?>

<div class="stm-listing-login">

    <h3><?php echo esc_html_e( 'Login', 'homepress' ); ?></h3>
	<div class="form-field">
        <label class="field-title"><?php esc_html_e( 'Login', 'homepress' ); ?></label>
		<input type="text" v-model="login" class="stm-form-control"  autocomplete="off" placeholder="<?php esc_attr_e( 'Enter login', 'homepress' ); ?>" />
        <span v-if="errors['login']" class="form-valid-error">{{errors['login']}}</span>
    </div>
	<div class="form-field">
        <div class="stm-row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6"><label class="field-title"><?php esc_html_e( 'Password', 'homepress' ); ?></label></div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 forgot-password-in-form"><a href="<?php echo wp_lostpassword_url(); ?>"><?php echo esc_html_e( 'Forgot?', 'homepress' ); ?></a></div>
        </div>
		<input type="password" v-model="password" class="stm-form-control" autocomplete="off" placeholder="<?php esc_attr_e( 'Enter password', 'homepress' ); ?>" />
        <span v-if="errors['password']" class="form-valid-error">{{errors['password']}}</span>
    </div>
    <div v-if="message && status == 'error'" :class="status" class="form-valid-error">{{message}}</div>
    <div class="form-field-white">
        <div class="homepress-checkbox">
            <label>
                <input type="checkbox" value="1" :true-value="1" :false-value="0" v-model="remember"> <?php esc_html_e( 'Remember me', 'homepress' ); ?>
                <span class="checkbox-frame"><i class="fa fa-check"></i></span>
            </label>
        </div>
	</div>
    <div class="form-field-white">
		<button @click="logIn" type="button" class="homepress-button homepress-button-full"><?php echo esc_html_e( 'Sign In', 'homepress' ); ?></button>
        <div class="user-registration-link">
            <a href="<?php echo StmUser::getProfileUrl(); ?>"><?php esc_html_e( "Registration", "homepress" ); ?></a>
        </div>
    </div>
	<div class="form-loading" v-if="loading">
        <?php get_template_part( "partials/global/preloader" ); ?>
    </div>

    <div v-if="message && status == 'success'" :class="status" class="form-valid-ok">{{message}}</div>
</div>

<div class="ulisting-social-login-modal">
    <?php echo apply_filters('usl_social_login_view', ''); ?>
</div>