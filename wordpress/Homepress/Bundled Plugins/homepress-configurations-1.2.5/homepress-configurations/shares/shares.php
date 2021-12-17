<?php
function stm_get_image_url($id, $size = 'full')
{
	$url = '';
	if (!empty($id)) {
		$image = wp_get_attachment_image_src($id, $size, false);
		if (!empty($image[0])) {
			$url = $image[0];
		}
	}

	return $url;
}

function stm_get_shares()
{

	$link = get_the_permalink();
	$image = stm_get_image_url(get_post_thumbnail_id());

	$socials = array();

	$socials['facebook'] = "https://www.facebook.com/sharer/sharer.php?u={$link}";
	$socials['twitter'] = "https://twitter.com/home?status={$link}";
	$socials['google-plus-g'] = "https://plus.google.com/share?url={$link}";
	$socials['linkedin-in'] = "https://www.linkedin.com/shareArticle?mini=true&url={$link}&title=&summary=&source=";
	$socials['pinterest'] = "https://pinterest.com/pin/create/button/?url={$link}&media={$image}&description=";
	ob_start();
	?>

    <div class="stm_share">
		<?php foreach ($socials as $social => $url): ?>
            <a href="#"
               class="stm_js__shareble stm_share_<?php echo esc_attr($social); ?>"
               data-share="<?php echo esc_url($url); ?>"
               data-social="<?php echo esc_attr($social); ?>">
                <span class="property-share-icons property-icon-<?php echo esc_attr($social); ?>"></span>
                <span class="property-share-icons-title">
                <?php
                    if ( $social == 'twitter' ) {
                        esc_html_e( 'Tweet', 'homepress' );
                    } elseif ( $social == 'pinterest' ) {
                        esc_html_e( 'Pin it', 'homepress' );
                    } else {
                        esc_html_e( 'Share', 'homepress' );
                    }
                ?>
                </span>
            </a>
		<?php endforeach; ?>
        <a href="mailto:?subject=<?php the_permalink(); ?>" class="stm_share_email"><span class="property-icon-envelope-solid"></span></a>
    </div>

	<?php echo ob_get_clean();
}