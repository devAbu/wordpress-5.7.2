<?php
/**
 * Account add a new agent
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/my-agents/add.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.4
 */
use uListing\Classes\UlistingUserRole;
$data = array(
	'agency_id' => $user->ID
);

wp_enqueue_script('stm-agent-add', ULISTING_URL . '/assets/js/frontend/stm-agent-add.js', array('vue'), ULISTING_VERSION, true);
wp_add_inline_script('stm-agent-add', "var ulisting_user_agent_add_data = json_parse('". ulisting_convert_content(json_encode($data)) ."');", 'before');
?>

<div id="stm-listing-agent-add" class="container">
    <div class="stm-row">
        <div class="stm-col-12 stm-col-md-6">
            <label> <?php echo  esc_html__('First name', "homepress"); ?></label>
            <input type="text"
                   data-v-model="first_name"
                   class="form-control"
                   placeholder="<?php esc_html_e('Enter first name', "homepress"); ?>"/>
            <span data-v-if="errors['first_name']" class="form-valid-error">{{errors['first_name']}}</span>
        </div>
        <div class="stm-col-12 stm-col-md-6">
            <label> <?php echo  esc_html__('Last name', "homepress"); ?></label>
            <input type="text"
                   data-v-model="last_name"
                   class="form-control"
                   placeholder="<?php esc_html_e('Enter last name', "homepress"); ?>"/>
            <span data-v-if="errors['last_name']" class="form-valid-error">{{errors['last_name']}}</span>
        </div>
        <div class="stm-col-12 stm-col-md-6">
            <label> <?php echo  esc_html__('Login', "homepress"); ?></label>
            <input type="text"
                   data-v-model="login"
                   class="form-control"
                   placeholder="<?php esc_html_e('Enter login', "homepress"); ?>"/>
            <span data-v-if="errors['login']" class="form-valid-error">{{errors['login']}}</span>
        </div>
        <div class="stm-col-12 stm-col-md-6">
            <label> <?php echo  esc_html__('Email', "homepress"); ?></label>
            <input type="email"
                   data-v-model="email"
                   class="form-control"
                   placeholder="<?php esc_html_e('Enter email', "homepress"); ?>"/>
            <span data-v-if="errors['email']" class="form-valid-error">{{errors['email']}}</span>
        </div>
        <div class="stm-col-12 stm-col-md-6">
            <label> <?php echo  esc_html__('Password', "homepress"); ?></label>
            <input type="password"
                   data-v-model="password"
                   class="form-control"
                   placeholder="<?php esc_html_e('Enter password', "homepress"); ?>"/>
            <span data-v-if="errors['password']" class="form-valid-error">{{errors['password']}}</span>
        </div>
        <div class="stm-col-12 stm-col-md-6">
            <label> <?php echo  esc_html__('Password repeat', "homepress"); ?></label>
            <input type="password"
                   data-v-model="password_repeat"
                   class="form-control"
                   placeholder="<?php esc_html_e('Enter password repeat', "homepress"); ?>"/>
            <span data-v-if="errors['password_repeat']" class="form-valid-error">{{errors['password_repeat']}}</span>
        </div>

    </div>

    <div class="account-button-right-position">
        <hr />
        <p v-if="loading" class="text-center"><?php echo  esc_html_e('Load...', 'homepress'); ?></p>
        <button v-if="!loading" data-v-on_click="add_agent" type="button" class="homepress-button"><?php echo  esc_html__('Add Agent', "homepress"); ?></button>
        <div class="alert" v-if="message" v-bind:class="'alert-'+status" >{{message}}</div>
    </div>


</div>