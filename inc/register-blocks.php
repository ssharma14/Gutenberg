<?php
/* Block registry and fields
------------------------------------------------------- */


//Create your own color palate and remove pre defined color settings using theme.json
add_theme_support( 'editor-color-palette', array(
    array(
        'name'  => esc_attr__( 'White', 'ccf' ),
        'slug'  => 'white',
        'color' => '#fff',
    ),
) );


//Create Custom Categories to organize custom blocks
add_filter( 'block_categories_all' , function( $categories ) {

    // Category to add hero block.
	$categories[] = array(
		'slug'  => 'custom-banner',
		'title' => 'Banner'
	);

	// Category to add section block.
	$categories[] = array(
		'slug'  => 'custom-section',
		'title' => 'Section'
	);

	$categories[] = array(
		'slug'  => 'custom-posts',
		'title' => 'Posts'
	);

	return $categories;
} );

/**
 * ACF Init: Register Blocks
 */
add_action('acf/init', function ()
{
	// Hero
	acf_register_block_type( [
		'name'         => 'hero',
		'title'        => 'Hero',
		'mode'         => 'preview',
		'icon'         => 'cover-image',
		'category'     => 'custom-banner',
		'description'  => 'A Block to add banner image along with page heading, page description and button.',
        'supports' => array(
            'align' => ['full', 'wide'],
            'jsx' => true,
			'mode' => true,
			'multiple' => false,
			'lock' => false
        ),
		'render_template' => 'blocks/block--hero.php'
	] );

	// Sections
	acf_register_block_type( [
		'name'           => 'section',
		'title'          => 'Section',
		'mode'           => 'preview',
		'icon'           => 'layout',
		'category'       => 'custom-section',
		'description'    => 'A section content block.',
        'supports' => array(
			'anchor'       => false,
			'mode'         => true,
			'jsx'          => true,
			'reusable'     => false,
			'multiple'     => true,
			'align'        => false
        ),
		'render_template' => 'blocks/block--section.php'
	] );

	acf_register_block_type(array(
		'name'                => 'column',
		'title'               => 'Column',
		'description'         => 'A column content block.',
		'mode'                => 'preview',
		'icon'                => 'columns',
		'parent'              => array('core/columns'),
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'reusable'          => false,
			'color'          	=> true,
			'className'         => true,
			'align'             => false
		),
		'render_template' => 'blocks/block--column.php'
	));

	//Image Block. Created custom to use picture function
	// and also to not give width and height edit option to user
	acf_register_block_type(array(
		'name'                => 'image',
		'title'               => 'Image',
		'category'            => 'media',
		'icon'                => 'format-image',
		'mode'                => 'preview',
		'description'         => 'Insert an image',
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'className'         => true,
			'align'             => false,
		),
		'render_template' => 'blocks/block--image.php'
	));

	acf_register_block_type(array(
		'name'                => 'icon-content',
		'title'               => 'Icon Content',
		'description'         => 'A icon content block',
		'mode'                => 'preview',
		'icon'                => 'embed-photo',
		'parent'              => array('acf/column'),
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'align'          	=> false,
			'className'         => true
		),
		'render_template' => 'blocks/block--icon-content.php'
	));

	acf_register_block_type(array(
		'name'                => 'causes-header',
		'title'               => 'Header - Causes',
		'description'         => 'Header for Causes Post',
		'mode'                => 'preview',
		'icon'                => 'cover-image',
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'align'          	=> false,
			'className'         => true
		),
		'render_template' => 'blocks/block--header-causes.php'
	));

	acf_register_block_type(array(
		'name'                => 'post-causes',
		'title'               => 'Post - Causes',
		'description'         => 'Display causes post with extract and other information.',
		'category'            => 'custom-posts',
		'icon'                => 'embed-post',
		'mode'                => 'preview',
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'align'          	=> false,
			'className'         => true
		),
		'render_template' => 'blocks/block--post-causes.php'
	));

	acf_register_block_type(array(
		'name'                => 'featured-post-causes',
		'title'               => 'Featured Post - Causes',
		'description'         => 'Display featured causes post with extract and other information.',
		'category'            => 'custom-posts',
		'icon'                => 'embed-post',
		'mode'                => 'preview',
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'align'          	=> false,
			'className'         => true
		),
		'render_template' => 'blocks/block--featured-post-causes.php'
	));

	acf_register_block_type(array(
		'name'                => 'contact-form',
		'title'               => 'Contact Form',
		'description'         => 'Display the selected form',
		'category'            => 'acf/column',
		'icon'                => 'forms',
		'mode'                => 'preview',
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'align'          	=> false,
	 		'className'         => true
	 	),
	 	'render_template' => 'blocks/block--contact-form.php'
	));

	acf_register_block_type(array(
		'name'                => 'contact-information',
		'title'               => 'Contact Information',
		'description'         => 'Display the address and other contact info',
		'category'            => 'acf/column',
		'icon'                => 'info',
		'mode'                => 'preview',
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'align'          	=> false,
	 		'className'         => true
	 	),
	 	'render_template' => 'blocks/block--contact-information.php'
	));

	acf_register_block_type(array(
		'name'                => 'heading-button',
		'title'               => 'Heading Button',
		'description'         => 'Use to display heading and button side by side',
		'category'            => 'acf/column',
		'icon'                => 'text',
		'mode'                => 'preview',
		'supports'            => array(
			'anchor'            => false,
			'mode'              => true,
			'jsx'               => true,
			'align'          	=> false,
	 		'className'         => true
	 	),
	 	'render_template' => 'blocks/block--heading-button.php'
	));
});

/**
 * Use this to set allowed blocks. If you want only some blocks to 
 * appear on a particular post or page use the if/else statement 
 * else set default blocks without the if/else
 */
add_filter( 'allowed_block_types_all', 'ccf_allowed_blocks' );
function ccf_allowed_blocks( $allowed_block_types )
{
	if (is_admin()) {
		global $pagenow;
		$typenow = '';
		if ( 'post-new.php' === $pagenow ) {
			if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
				$typenow = $_REQUEST['post_type'];
			};
		} elseif ( 'post.php' === $pagenow ) {
			if ( isset( $_GET['post'] ) && isset( $_POST['post_ID'] ) && (int) $_GET['post'] !== (int) $_POST['post_ID'] ) {
				// Do nothing
			} elseif ( isset( $_GET['post'] ) ) {
				$post_id = (int) $_GET['post'];
			} elseif ( isset( $_POST['post_ID'] ) ) {
				$post_id = (int) $_POST['post_ID'];
			}
			if ( $post_id ) {
				$post = get_post( $post_id );
				$typenow = $post->post_type;
			}
		}

		//Used to show only necessary blocks for causes post type
		if ($typenow === 'causes') {
			$allowed_block_types = [
				'core/image',
				'core/columns',
				'core/heading',
				'core/paragraph',
				'core/buttons',
				'acf/section',
				'acf/image',
				'core/list',
				'acf/causes-header'
			];
		} elseif($typenow === 'post'){
			$allowed_block_types = [
				'core/block',
				'core/buttons',
				'core/columns',
				'core/group',
				'core/file',
				'core/gallery',
				'core/heading',
				'core/image',
				'core/list',
				'core/paragraph',
				'core/table',
				'core/video',
				'acf/contact-form'
			];
		} else{
			// Set defaults blocks for the whole site
			$allowed_block_types = [
				'core/block',
				'core/buttons',
				'core/file',
				'core/gallery',
				'core/columns',
				'core/heading',
				'core/html',
				'acf/image',
				'core/list',
				'core/paragraph',
				'core/group',
				'core/shortcode',
				'core/table',
				'core/video',
				'acf/contact-form',
				'acf/hero',
				'acf/contact-information',
				'acf/section',
				'acf/icon-content',
				'acf/heading-button',
				'acf/post-causes',
				'tribe/events-list',
				'acf/featured-post-causes',
			];
		}
	}
	
	return $allowed_block_types;
}