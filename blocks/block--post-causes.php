<?php
/**
 * Causes Post Causes Block.
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

if(is_page('causes')){
    $args = array(
        'post_type' => 'causes',
        'posts_per_page' => -1
    );
} else{
    $args = array(
        'post_type' => 'causes',
        'posts_per_page' => 4
    );
}
$items = get_posts( $args );
if( (empty( $items )) ) return; 

echo '<div class="post-block post-causes all-posts">';
    echo '<div class="posts">';
        $c = 1; foreach($items as $item):
        $item_id = $item->ID;
        $fundraising_goal = get_field('fundraising_goal', $item_id);
        $total_funds_raised = get_field('total_funds_raised', $item_id);
        $featured_cause = get_field('featured_cause', $item_id);
        $category = get_the_terms( $item_id, 'cause_category' );
        $item_title = $item->post_title;
            if(is_page('causes')){
                if(!$featured_cause){
                    echo '<div class="post">';
                        if (has_post_thumbnail($item_id)) {
                            echo get_the_post_thumbnail( $item_id );
                        }
                        echo '<div class="post-info">';
                            echo '<p class="category h6">' . $category[0]->name . '</p>
                            <h3 class="title">' . $item_title . '</h3>';
                            if($fundraising_goal){
                                echo '<p class="goal h5"><span>Goal: </span>' . $fundraising_goal . '</p>';
                            }
                            echo '<p class="excerpt">' . get_the_excerpt($item_id) . '</p>
                            <div class="wp-block-button is-style-outline"><a class="wp-block-button__link permalink" href="' . get_permalink( $item_id ) . '">About this Cause</a></div>';
                        echo '</div>';
                    echo '</div>';
                }
            } else{
                echo '<div class="post">';
                    if (has_post_thumbnail($item_id)) {
                        echo get_the_post_thumbnail( $item_id );
                    }
                    echo '<div class="post-info">';
                        echo '<p class="category h6">' . $category[0]->name . '</p>
                        <h3 class="title">' . $item_title . '</h3>';
                        if($fundraising_goal){
                            echo '<p class="goal h5"><span>Goal: </span>' . $fundraising_goal . '</p>';
                        }
                        echo '<p class="excerpt">' . get_the_excerpt($item_id) . '</p>
                        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link permalink" href="' . get_permalink( $item_id ) . '">About this Cause</a></div>';
                    echo '</div>';
                echo '</div>';
            }
        endforeach;
    echo '</div>';
echo '</div>';