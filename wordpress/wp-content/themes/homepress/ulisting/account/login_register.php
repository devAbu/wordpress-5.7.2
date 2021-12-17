<?php
/**
 * Account login
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/login.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.3.3
 */
use uListing\Classes\StmUser;

wp_enqueue_script( 'ulisting/frontend/stm-login-register' );
?>

<div id="stm-listing-login-register" class="login-page-box">

    <h5><?php echo esc_html_e( 'Sign in', 'homepress' ); ?></h5>
    <div class="form-field">
        <label for="log-login" class="field-title"><?php esc_html_e( 'Login', 'homepress' ); ?></label>
        <input id="log-login" type="text" data-v-model="login" class="stm-form-control"  autocomplete="off" placeholder="<?php esc_attr_e( 'Enter login', 'homepress' ); ?>" />
        <span data-v-if="errors['login']" class="form-valid-error">{{errors['login']}}</span>
    </div>
    <div class="form-field">
        <div class="stm-row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6"><label for="log-password" class="field-title"><?php esc_html_e( 'Password', 'homepress' ); ?></label></div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 forgot-password-in-form"><a href="<?php echo wp_lostpassword_url(); ?>"><?php echo esc_html_e( 'Forgot?', 'homepress' ); ?></a></div>
        </div>
        <input id="log-password" type="password" data-v-model="password" class="stm-form-control" autocomplete="off" placeholder="<?php esc_attr_e( 'Enter password', 'homepress' ); ?>" />
        <span data-v-if="errors['password']" class="form-valid-error">{{errors['password']}}</span>
    </div>
    <div data-v-if="message && status == 'error'" data-v-bind_class="status" class="form-valid-error">{{message}}</div>
    <div class="form-field-white">
        <div class="homepress-checkbox">
            <label>
                <input type="checkbox" value="1" data-v-bind_true-value="1" data-v-bind_false-value="0" data-v-model="remember"> <?php esc_html_e( 'Remember me', 'homepress' ); ?>
                <span class="checkbox-frame"><i class="fa fa-check"></i></span>
            </label>
        </div>
    </div>
    <div class="form-field-white">
        <button data-v-on_click="logIn" type="button" class="homepress-button homepress-button-full"><?php echo esc_html_e( 'Sign In', 'homepress' ); ?></button>
    </div>
    <div class="form-loading" data-v-if="loading">
        <?php get_template_part( "partials/global/preloader" ); ?>
    </div>

    <div data-v-if="message && status == 'success'" data-v-bind_class="status" class="form-valid-ok">{{message}}</div>
</div>

<div class="ulisting-social-login-register">
    <?php echo apply_filters('usl_social_login_view', ''); ?>

</div>