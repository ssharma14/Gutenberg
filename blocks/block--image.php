<?php
/**
 * Image Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = $block['id'];
$classes = '';
if( !empty( $block['className'] ) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}

$image_block = get_field('image_block', $id);
$is_extending = get_field('is_extending', $id);

if($is_extending){
    $classes .= ' alignfull';
}

if(!empty($image_block)){
    if($image_block['subtype'] != 'svg+xml'){
        $classes .= ' img-picture ';
    }
    
    switch( $image_block['subtype'] ) {
        case 'svg+xml' :
            echo "<figure class='lazyload img-icon'><img src='" . $image_block['url'] . "'>";
            echo "</figure>";
            break;
        default :
            echo td_acf_render_picture( $image_block, '2048x2048', $classes);
    }
} ?>