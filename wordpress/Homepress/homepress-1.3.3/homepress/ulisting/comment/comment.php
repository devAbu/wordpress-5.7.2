<?php
/**
 * Comment comment
 *
 * Template can be modified by copying it to yourtheme/ulisting/comment/comment.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
wp_enqueue_script('star-rating', ULISTING_URL . '/assets/js/vue/star-rating.min.js', array('vue'), ULISTING_VERSION);
wp_enqueue_script('ulisting-comment', ULISTING_URL . '/assets/js/frontend/comment/ulisting-comment.js', array('vue'), ULISTING_VERSION);
wp_add_inline_script("ulisting-comment", " new Vue({el:'#ulisting-comment'})");
?>
<div id="ulisting-comment">
	<ulisting-comment inline-template type="<?php echo esc_attr($params['type'])?>" object_id="<?php echo esc_attr($params['object_id'])?>">
		<div>
            <div class="reviews_top_box">
                <h5><?php esc_html_e("Add a review", "homepress")?></h5>
                <div class="form-group">
                    <star-rating
                        v-bind:increment="1"
                        v-bind:max-rating="5"
                        inactive-color="#cccccc"
                        active-color="#234dd4"
                        v-bind:star-size="20"
                        @rating-selected="rating = $event"
                        :rating="rating">
                    </star-rating>
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" v-model="review"></textarea>
            </div>


            <?php if( is_user_logged_in() ) : ?>
                <div class="form-group">
                    <p class="text-center" v-if="preloader_send"><?php esc_html_e("Load", "homepress")?></p>
                    <button v-if="!preloader_send" @click="submit" type="button" class="homepress-button btn-primary"><?php esc_html_e("Submit", "homepress")?></button>
                </div>
                <p v-if="message">{{message}}</p>
                <ul v-if="errors" class="form-valid-error">
                    <li v-for="error in errors">{{error}}</li>
                </ul>
                <br />
                <br />
            <?php else:?>
                <p><?php esc_html_e( "To leave a review, just log in or sign up!", "homepress" ); ?></p>
                <p><a class="homepress-button btn-success" href="<?php echo \uListing\Classes\StmUser::getProfileUrl();?>"><?php esc_html_e( "Login ", "homepress" ); ?></a></p>
                <br />
            <?php endif;?>


			<h5><?php esc_html_e("Reviews", "homepress"); ?> ({{reviews_total}})</h5>
			<hr>

			<div v-for="( review, index ) in reviews_list">
				<div class="media">
					<img v-bind:src="review.avatar_url" class="mr-3" alt="<?php esc_html_e("Avatar", "homepress")?>" />
					<div class="media-body">
						<div class="stm-row">
							<div class="stm-col-12 stm-col-sm-8">
								<div class="mt-0">{{review.comment_author}} - {{review.comment_date}} {{review.comment_time}}</div>
							</div>
							<div class="stm-col-12 stm-col-sm-4">
								<star-rating
									:inline="true"
									:star-size="16"
									:read-only="true"
                                    inactive-color="#"
                                    active-color="#234dd4"
									:show-rating="false"
									:rating="review.rating">
								</star-rating>
							</div>
						</div>
                        <div class="media-body-comment">{{review.comment_content}}</div>
					</div>
				</div>
				<hr>
			</div>

			<div class="text-center" v-if="show_load_more">
				<p v-if="load_more_loading"><?php esc_html_e("Load", "homepress")?></p>
				<button @click="load_more" v-if="!load_more_loading" class="btn btn-success"><?php esc_html_e("Load more", "homepress")?></button>
			</div>

		</div>
	</ulisting-comment>
</div>



