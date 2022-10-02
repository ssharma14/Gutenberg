<?php
/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$classes = '';
if( !empty( $block['className'] ) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}

if(is_front_page()){
    $classes .= 'hero-home';
}
$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/button' );

$template = array(
    array( 'core/columns', array(), array(
        array( 'acf/column', array(), array(
            array( 'core/paragraph', array(
                'placeholder' => 'Tagline Goes Here',
                'className' => 'tagline'
            ) ),
            array('core/heading', array(
                'level' => 1,
                'placeholder' => 'Title Goes Here',
                'className' => 'heading'
            )),
            array('core/paragraph', array(
                'placeholder' => 'Add banner description',
                'className' => 'description'
            )),
            array('core/button', array(
                'className' => 'button'
            ))
        )),
        array( 'acf/column', array(), array(
            array('acf/image', array(
                'className' => 'banner-image'
            ))
        )),
    ))
);

echo
'<header id="hero" class="' . esc_attr($classes) . '">';
    if(is_front_page()){
        echo td_render_svg('home-banner-icon-mobile', 'ui');
    }
    echo '<div class="max-content-width">';
        if(!is_front_page()){
            if( !function_exists( 'bcn_display_list' ) ) { return; }
            echo '<div id="breadcrumb" class="max-content-width">';
            echo '<ul>'; bcn_display_list(); echo '</ul>';
            echo '</div>';
        }
        echo '<div class="max-line-length">';
            echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" 
            template="' . esc_attr( wp_json_encode( $template ) ) . '" 
            templateLock="true" />';
        echo '</div>
    </div>
</header>';
