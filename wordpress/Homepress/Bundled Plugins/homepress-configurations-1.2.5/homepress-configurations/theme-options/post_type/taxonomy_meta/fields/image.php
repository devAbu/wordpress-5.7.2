<?php
function stmt_to_term_meta_field_image($field_key, $value)
{
    $img_src = wp_get_attachment_image_url($value, 'full');
    ?>
	<div class="stmt_to_image_field">
		<div class="stmt_to_image_field__holder">
			<img src="<?php echo esc_url($img_src); ?>" />
		</div>
		<button class="button button-primary stmt_to_image_field__add">
			<?php esc_html_e('Add image', 'homepress-configurations'); ?>
		</button>
		<input type="hidden"
			   name="<?php echo esc_attr($field_key) ?>"
			   id="<?php echo esc_attr($field_key) ?>"
			   value="<?php echo esc_attr($value); ?>" />
	</div>
	<script type="text/javascript">
        (function($){
            var frame;
            $(document).ready(function(){
                var $btn = '';
                $('.stmt_to_image_field__add').on('click', function(e) {
                    e.preventDefault();
                    $btn = $(this);
                    if ( frame ) {
                        frame.open();
                        return;
                    }

                    frame = wp.media({
                        title: '<?php esc_html_e("Select or Upload Media Of Your Chosen Persuasion", "stmt-to"); ?>',
                        button: {
                            text: '<?php esc_html_e("Use this media", "stmt-to"); ?>'
                        },
                        multiple: false
                    });

                    frame.on( 'select', function() {

                        // Get media attachment details from the frame state
                        var attachment = frame.state().get('selection').first().toJSON();

                        var image_id = attachment.id;
                        var image_url = attachment.url;
                        var $input = $btn.closest('.stmt_to_image_field').find('input');
                        var $img = $btn.closest('.stmt_to_image_field').find('img');

                        console.log($btn);

                        $input.val(image_id);
                        $img.attr('src', image_url);
                    });

                    // Finally, open the modal on click
                    frame.open();

                });
            });
        })(jQuery)
	</script>
<?php }