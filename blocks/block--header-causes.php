<?php
/**
 * Causes Post Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = get_the_ID();

$classes = '';
if( !empty( $block['className'] ) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}

$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/button' );

$template = array(
    array( 'core/group', array(), array(
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
    ))
);


$fundraising_goal = get_field('fundraising_goal', $id);
$total_funds_raised = get_field('total_funds_raised', $id);
$cause_ends = get_field('cause_ends', $id);
$category = get_the_terms( $id, 'cause_category' );

echo
'<header id="hero" class="hero-cause ' . esc_attr($classes) . '">';
    echo td_render_svg('cause-banner-icon-mobile', 'ui');
    echo '<div class="max-content-width">';
        if( !function_exists( 'bcn_display_list' ) ) { return; }
        echo '<div id="breadcrumb" class="max-content-width">';
        echo '<ul>'; bcn_display_list(); echo '</ul>';
        echo '</div>';
        echo '<div class="max-line-length">';
            echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" 
            template="' . esc_attr( wp_json_encode( $template ) ) . '" 
            templateLock="true" />';
            echo '<div class="wp-block-group fundraising-info">
                <div class="category"><p class="title h6">Category</p>
                    <p class="category-name h3">'
                        . $category[0]->name .
                    '</p>
                </div>';
                if($fundraising_goal){
                    echo '<div class="fundraising-goal">
                        <p class="title h6">Fundraising Goal</p>
                        <p class="goal h3">' . $fundraising_goal . '</p>
                    </div>';
                }

                if($total_funds_raised){
                    echo '<div class="fundraising-goal">
                        <p class="title h6">Money Raised to Date</p>
                        <p class="goal h3">' . $total_funds_raised . '</p>
                    </div>';
                }

                if($cause_ends){
                    echo '<div class="fundraising-goal">
                        <p class="title h6">Deadline</p>
                        <p class="goal h3">' . $cause_ends . '</p>
                    </div>';
                }

            echo '</div>';
        echo '</div>
    </div>
</header>';
