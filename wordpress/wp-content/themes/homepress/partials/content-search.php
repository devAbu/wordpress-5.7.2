<?php
//Get the ID for metaboxes fields
$id = get_the_ID();

//Title settings
$title_box_style = homepress_get_option( 'title_box_style' );
$title = homepress_get_option( 'title_box_title' );

//Sidebar settings
$sidebar_id = homepress_get_option( 'sidebar_id' );
$sidebar_position = homepress_get_option( 'sidebar_position' );

if ( have_posts() ): ?>

    <div class="archive-post-search-result">

        <div class="container">

            <div class="row">

                <?php if ( $sidebar_position == 'left' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-post__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar left -->

                <?php } ?>

                <div class="<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>col-lg-9<?php else: ?>col-lg-12<?php endif; ?> col-md-12 col-sm-12 col-sm archive-search__content">

                    <div class="search-result-form">

                        <div class="search-result-count">
                            <?php esc_html_e( 'Search for', 'homepress' ); ?>
                        </div>

                        <div class="search-result-field">

                            <?php get_search_form( 'homepress_search_form' ); ?>

                        </div>

                    </div>

                    <?php if ( !empty( $title ) && $title_box_style == 'style_1' ) { ?>

                        <h1 class="site-title">
                            <?php

                            $allsearch = new WP_Query( "s=$s&showposts=0" );
                            echo esc_attr( $allsearch ->found_posts );

                            ?>

                            <span><?php esc_html_e( 'results found', 'homepress' ); ?></span></h1>

                    <?php } ?>

                    <?php while ( have_posts() ): the_post();
                        //Post data
                        $author_name = get_the_author_meta( 'display_name' );
                        $posted = get_the_time( 'U' );
                    ?>

                        <div class="archive-post_content">

                            <?php if( has_post_thumbnail() ) : ?>

                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'homepress-image-search-result' ); ?></a>
                                </div>

                                <div class="archive-post_content_info">

                            <?php else: ?>

                                <div class="archive-post_content_info no_image">

                            <?php endif; ?>

                                <?php
                                $post_category = get_the_category();

                                if( $post_category ) : ?>

                                    <div class="search-category-list">

                                        <?php foreach( $post_category as $category ) {

                                            $category_link_array[] = '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a>';
                                        }

                                            echo implode( ', ', $category_link_array );

                                        ?>
                                    </div>

                                <?php endif; ?>

                                <div class="post-title">

                                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                        <h5><?php echo homepress_minimize_word( get_the_title(), 38, '...' ); ?> </h5>
                                    </a>

                                </div>

                                <?php if ( get_the_excerpt() ) { ?>

                                    <div class="post-excerpt">
                                        <?php echo homepress_minimize_word( get_the_excerpt(), 150, '...' );  ?>
                                    </div>

                                <?php } ?>

                                <div class="post-search-info-wrap">

                                    <div class="single-post-author__name">
                                        <span class="property-icon-user-small"></span> <?php echo esc_html($author_name); ?>
                                    </div>

                                    <div class="single-post-info__current_time">
                                        <span class="property-icon-clock-small"></span> <?php echo human_time_diff( $posted, current_time( 'U' ) ) . ' ago'; ?>
                                    </div>

                                    <div class="single-post-info__comments">
                                        <span class="property-icon-comment-small"></span> <?php comments_number( '0', '1', '%' ); ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                    <?php

                    get_template_part('partials/global/pagination' );

                    ?>

                </div><!-- archive content -->

                <?php if ( $sidebar_position == 'right' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-post__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar right -->

                <?php } ?>

            </div><!-- row -->

        </div><!-- container -->

    </div><!-- archive post -->

<?php else: ?>

    <div class="archive-post-search-result">

    <div class="container">

        <div class="row">

            <?php if ( $sidebar_position == 'left' && is_active_sidebar( $sidebar_id )  ) { ?>

                <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-post__sidebar">
                    <?php dynamic_sidebar( $sidebar_id ); ?>
                </div><!-- sidebar left -->

            <?php } ?>

            <div class="<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>col-lg-9<?php else: ?>col-lg-12<?php endif; ?> col-md-12 col-sm-12 col-sm archive-search__content">

                <div class="search-result-form">

                    <div class="search-result-count">
                        <?php esc_html_e( 'Search for', 'homepress' ); ?>
                    </div>

                    <div class="search-result-field">

                        <?php get_search_form( 'homepress_search_form' ); ?>

                    </div>

                </div>

                <?php if ( !empty( $title ) && $title_box_style == 'style_1' ) { ?>

                    <h1 class="site-title">
                        <?php

                        $allsearch = new WP_Query( "s=$s&showposts=0" );
                        echo esc_attr( $allsearch ->found_posts );

                        ?>

                        <span><?php esc_html_e( 'results found', 'homepress' ); ?></span></h1>

                <?php } ?>

                <?php while ( have_posts() ): the_post();
                //Post data
                $author_name = get_the_author_meta( 'display_name' );
                $posted = get_the_time( 'U' );
                ?>

                <div class="archive-post_content">

                    <?php if( has_post_thumbnail() ) : ?>

                    <div class="post-thumbnail">
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'homepress-image-search-result' ); ?></a>
                    </div>

                    <div class="archive-post_content_info">

                        <?php else: ?>

                        <div class="archive-post_content_info no_image">

                            <?php endif; ?>

                            <?php
                            $post_category = get_the_category();

                            if( $post_category ) : ?>

                                <div class="search-category-list">

                                    <?php foreach( $post_category as $category ) {

                                        $category_link_array[] = '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a>';
                                    }

                                    echo implode( ', ', $category_link_array );

                                    ?>
                                </div>

                            <?php endif; ?>

                            <div class="post-title">

                                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <h5><?php echo homepress_minimize_word( get_the_title(), 38, '...' ); ?> </h5>
                                </a>

                            </div>

                            <?php if ( get_the_excerpt() ) { ?>

                                <div class="post-excerpt">
                                    <?php echo homepress_minimize_word( get_the_excerpt(), 150, '...' );  ?>
                                </div>

                            <?php } ?>

                            <div class="post-search-info-wrap">

                                <div class="single-post-author__name">
                                    <span class="property-icon-user-small"></span> <?php echo esc_html($author_name); ?>
                                </div>

                                <div class="single-post-info__current_time">
                                    <span class="property-icon-clock-small"></span> <?php echo human_time_diff( $posted, current_time( 'U' ) ) . ' ago'; ?>
                                </div>

                                <div class="single-post-info__comments">
                                    <span class="property-icon-comment-small"></span> <?php comments_number( '0', '1', '%' ); ?>
                                </div>

                            </div>

                        </div>

                    </div>

                    <?php endwhile; ?>

                    <?php

                    get_template_part('partials/global/pagination' );

                    ?>

                </div><!-- archive content -->

                <?php if ( $sidebar_position == 'right' && is_active_sidebar( $sidebar_id )  ) { ?>

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box archive-post__sidebar">
                        <?php dynamic_sidebar( $sidebar_id ); ?>
                    </div><!-- sidebar right -->

                <?php } ?>

            </div><!-- row -->

        </div><!-- container -->

    </div><!-- archive post -->

<?php endif;
