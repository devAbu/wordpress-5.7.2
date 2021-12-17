<?php
/**
 * Account register
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/register.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0.1
 */
use uListing\Classes\UlistingUserRole;
$custom_fields = [];
$register_data = [];
$user_role_list = [];
$custom_fields_items = [];
$userRole = new UlistingUserRole();

foreach ($userRole->roles as $key => $role){
	$user_role_list[] = [
		"id" => $key,
		"text" => $role['name'],
	];

 if(class_exists('uListing\UserRole\Classes\UlistingUserRole')) {
      $data = uListing\UserRole\Classes\UlistingUserRole::get_custom_fields($key);

      foreach ($data as $_key => $_val) {
          $custom_fields[$key][$_val['slug']] = "";

          foreach ($_val['items'] as $k => $item){
              $custom_fields_items[$key][$_val['slug']][] = [
                    "id" => $item['slug'],
                    "text" => $item['name']
                  ];
            }
        }
    }
}

$register_data['custom_fields'] = $custom_fields;
$register_data['user_role_list'] = $user_role_list;
$register_data['custom_fields_items'] = $custom_fields_items;
wp_enqueue_script('stm-register', ULISTING_URL . '/assets/js/frontend/stm-register.js', array('vue'), ULISTING_VERSION, true);
wp_add_inline_script('stm-register', "var ulisting_user_register_data = json_parse('". ulisting_convert_content(json_encode($register_data)) ."');", 'before');
?>

<div id="stm-listing-register">
    <h5><?php echo esc_html_e( 'Registration', 'homepress' ); ?></h5>
    <div class="form-field-white">
        <label for="reg-login" class="field-title"><?php esc_html_e( 'Login', 'homepress' ); ?></label>
		<input id="reg-login" type="text" data-v-model="login" class="stm-form-control" placeholder="<?php esc_attr_e( 'Enter login', 'homepress' ); ?>" />
		<span data-v-if="errors['login']" class="form-valid-error">{{errors['login']}}</span>
	</div>
    <div class="form-field-white">
        <label for="reg-first-name" class="field-title"><?php esc_html_e( 'First name', 'homepress' ); ?></label>
		<input id="reg-first-name" type="text" data-v-model="first_name" class="stm-form-control" placeholder="<?php esc_attr_e( 'Enter first name', 'homepress' ); ?>" />
		<span data-v-if="errors['first_name']" class="form-valid-error">{{errors['first_name']}}</span>
	</div>
    <div class="form-field-white">
        <label for="reg-last-name" class="field-title"><?php esc_html_e( 'Last name', 'homepress' ); ?></label>
		<input id="reg-last-name" type="text" data-v-model="last_name" class="stm-form-control" placeholder="<?php esc_attr_e( 'Enter last name', 'homepress' ); ?>" />
		<span data-v-if="errors['last_name']" class="form-valid-error">{{errors['last_name']}}</span>
	</div>
    <div class="form-field-white">
        <label for="reg-email" class="field-title"><?php esc_html_e( 'Email', 'homepress' ); ?></label>
        <input id="reg-email" type="email" data-v-model="email" class="stm-form-control" placeholder="<?php esc_attr_e( 'Enter email', 'homepress' ); ?>"/>
        <span data-v-if="errors['email']" class="form-valid-error">{{errors['email']}}</span>
	</div>
    <div class="form-field-white">
        <label for="reg-role" class="fld-title"><?php esc_html_e( 'User role', 'homepress' ); ?></label>
        <ulisting-select2 placeholder="<?php esc_attr_e( 'Select user role', 'homepress' ); ?>" :options='user_role_list' data-v-model='role' theme='bootstrap4'></ulisting-select2>
		<span data-v-if="errors['role']" class="form-valid-error">{{errors['role']}}</span>
	</div>

    <?php
        if(class_exists('uListing\UserRole\Classes\UlistingUserRole')):?>
        <?php
            foreach ($user_role_list as $user):
                $lists = uListing\UserRole\Classes\UlistingUserRole::get_custom_fields($user['id']);
                foreach ($lists as $list):
            ?>

            <div class="form-field-white" data-v-if="role === '<?php echo esc_attr($user['id'])?>'">
                <?php \uListing\Classes\StmListingTemplate::load_template( 'account/custom-field/fields/'.$list['type'], ['field' => $list, 'model' => 'custom_fields.'.$list['slug']], true );?>
            </div>
    <?php
                endforeach;
            endforeach;
        endif;
    ?>

    <div class="form-field-white">
        <label for="reg-password" class="field-title"><?php esc_html_e( 'Password', 'homepress' ); ?></label>
		<input id="reg-password" type="password" data-v-model="password" class="stm-form-control" placeholder="<?php esc_attr_e( 'Enter password', 'homepress' ); ?>" />
        <span data-v-if="errors['password']" class="form-valid-error">{{errors['password']}}</span>
	</div>
    <div class="form-field-white">
        <label for="reg-password_repeat" class="field-title"><?php esc_html_e( 'Re-enter password', 'homepress' ); ?></label>
		<input id="reg-password_repeat" type="password" data-v-model="password_repeat" class="stm-form-control" placeholder="<?php esc_attr_e( 'Re-enter password', 'homepress' ); ?>" />
        <span data-v-if="errors['password_repeat']" class="form-valid-error">{{errors['password_repeat']}}</span>
	</div>

    <div class="alert alert-success" data-v-if="message" data-v-bind_class="status" ><span class="property-icon-like-up alert-icon"></span> {{message}}</div>

    <div class="form-field-white account-button-right-position">
		<button data-v-on_click="register" type="button" class="homepress-button"><?php echo esc_html_e( 'Register', 'homepress' ); ?></button>
	</div>
<!--        --><?php //do_action( "ulisting-profile-edit-form", ['user' => $user] ); ?>

    <div class="form-loading" data-v-if="loading">
        <?php get_template_part( "partials/global/preloader" ); ?>
    </div>

</div>