<?php
$prev_next = homepress_get_option( 'post_single_prev_next' );
if( !empty( $prev_next ) ) {
    ?>

    <div class="single-post-prev-next">
        <?php

        //Previous
        $previous_post = get_previous_post( true );

        if( $previous_post ) {

            $args = array(
                'posts_per_page' => 1,
                'include' => $previous_post->ID
            );

            $previous_post = get_posts( $args );

            foreach ($previous_post as $post) {

                setup_postdata($post);

                ?>

                <a href="<?php the_permalink(); ?>" class="previous-post">
                    <?php
                    if ( has_post_thumbnail() ) { ?>
                        <span class="previous-next-post-thumbnail">
                        <?php
                        the_post_thumbnail('homepress-image-post-pagination' );
                        ?>
                    </span>
                    <?php } ?>
                    <span class="previous-next-post-info">
                        <span class="post-name-attr"><?php esc_html_e( 'Previous', 'homepress' ); ?></span>
                        <span class="post-name-title"><?php the_title(); ?></span>
                    </span>
                </a>

                <?php

                wp_reset_postdata();
            }
        } else { ?>
            <div class="previous-post previous-post-active">
                <?php
                if ( has_post_thumbnail() ) { ?>
                    <span class="previous-next-post-thumbnail">
                        <?php
                        the_post_thumbnail('homepress-image-post-pagination' );
                        ?>
                    </span>
                <?php } ?>
                <span class="previous-next-post-info">
                    <span class="post-name-attr"><?php esc_html_e( 'You are here', 'homepress' ); ?></span>
                    <span class="post-name-title"><?php the_title(); ?></span>
                </span>
            </div>
        <?php }

        //Next
        $next_post = get_next_post( true );

        if( $next_post ) {

            $args = array(
                'posts_per_page' => 1,
                'include' => $next_post->ID
            );

            $next_post = get_posts( $args );

            foreach ( $next_post as $post ) {

                setup_postdata($post);

                ?>

                <a href="<?php the_permalink(); ?>" class="next-post">
                    <?php
                    if ( has_post_thumbnail() ) { ?>
                        <span class="previous-next-post-thumbnail">
                        <?php
                        the_post_thumbnail('homepress-image-post-pagination' );
                        ?>
                    </span>
                    <?php } ?>
                    <span class="previous-next-post-info">
                        <span class="post-name-attr"><?php esc_html_e( 'Next', 'homepress' ); ?></span>
                        <span class="post-name-title"><?php the_title(); ?></span>
                    </span>
                </a>

                <?php

                wp_reset_postdata();

            }
        }else { ?>
            <div class="next-post next-post-active">
                <?php
                if ( has_post_thumbnail() ) { ?>
                    <span class="previous-next-post-thumbnail">
                        <?php
                        the_post_thumbnail('homepress-image-post-pagination' );
                        ?>
                    </span>
                <?php } ?>
                <span class="previous-next-post-info">
                    <span class="post-name-attr"><?php esc_html_e( 'You are here', 'homepress' ); ?></span>
                    <span class="post-name-title"><?php the_title(); ?></span>
                </span>
            </div>
        <?php }
        ?>
    </div>
<?php } ?>