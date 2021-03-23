Loop with custom taxonomy as param -> based on
https://wordpress.stackexchange.com/questions/232873/create-a-shortcode-to-display-custom-post-types-with-a-specific-taxonomy

/**
 * Register all shortcodes
 *
 * @return null
 */
function register_shortcodes() {
    add_shortcode( 'lwct', 'loop_with_tax' );
}
add_action( 'init', 'register_shortcodes' );

function loop_with_tax( $atts ) {
    ob_start();
    global $wp_query,
        $post;

    $atts = shortcode_atts( array(
        'my_taxonomy' => ''
    ), $atts );

    $loop = new WP_Query( array(
        'posts_per_page'    => -1,
        'post_type'         => 'MY_CUSTOM_POST_TYPE',
        'orderby'           => 'menu_order title',
        'order'             => 'ASC',
        'tax_query'         => array( array(
            'taxonomy'  => 'MY_CUSTOM_POST_TYPE_TAXONOMY',
            'field'     => 'slug',
            'terms'     => array( sanitize_title( $atts['my_taxonomy'] ) )
        ) )
    ) );

    if( ! $loop->have_posts() ) {
        return false;
    }

    while( $loop->have_posts() ) {
        $loop->the_post();
        ?>
        <div>
            <a class="content" href="<?php echo get_permalink( $post->ID ); ?>">
                <div class="image">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="text">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
            </a>
        </div>
        <?php
    }
    return ob_get_clean();
    wp_reset_postdata();
}

USAGE [lwct my_taxonomy="something"]


**************************************
dead simple loop

    function dead_simple_loop() {
        ob_start(); ?>

        <div class="row">
        <?php
            $args = array( 'post_type' => 'MY_CUSTOM_POST_TYPE', 'posts_per_page' => 6 );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
        ?>

        <div class="col-sm-4">
            <a class="content" href="<?php echo get_permalink( $post->ID ); ?>">
                <div class="image">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="text">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
            </a>
        </div>

        <?php endwhile; ?>
        </div>
    <?php
    
        return ob_get_clean();
    }

    add_shortcode('dsl', 'dead_simple_loop');
