<?php
/**
 * Add listing edit
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/edit.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0.1
 */
use uListing\Classes\StmListing;
use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmListingSettings;

$listing =  $user->getListingById(sanitize_text_field($_GET['edit']));
$view = 'add-listing/form';
?>

<?php if($listing) :?>
<div class="container">
    <?php
        StmListingTemplate::load_template($view, array(
            'user'        => $user,
            'listing'     => $listing,
            'user_plans'  => $user_plans,
            'listingType' => $listing->getType(),
            'return_url'  =>  \uListing\Classes\StmUser::getUrl('my-listing'),
            'action'      => esc_html__('Update Property', 'homepress')
        ), true );
    ?>
</div>
<?php else: ?>
    <div class="container">
        <h2><?php esc_html_e('Listing not found', "homepress")?></h2>
    </div>
<?php endif;?>