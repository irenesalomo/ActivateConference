<?php
/**
 * Catch Kathmandu Custom meta box
 *
 * @package Catch Themes
 * @subpackage Catch Kathmandu
 * @since Catch Kathmandu 1.0
 */
 
 // Add the Meta Box  
function catchkathmandu_add_custom_box() {
	add_meta_box(
		'catchkathmandu-options',							  	//Unique ID
       __( 'Catch Kathmandu Options', 'catch-kathmandu' ),   	//Title
        'catchkathmandu_meta_options',                   	//Callback function
        'page'                                          	//show metabox in page
    ); 
	add_meta_box(
		'catchkathmandu-options',							  	//Unique ID
       __( 'Catch Kathmandu Options', 'catch-kathmandu' ),   	//Title
        'catchkathmandu_meta_options',                   	//Callback function
        'post'                                          	//show metabox in post
    ); 	
}
add_action( 'add_meta_boxes', 'catchkathmandu_add_custom_box' );


//Header Featured Image Options
global $header_image_options;
$header_image_options = array(
	'default' => array(
		'id'		=> 'catchkathmandu-header-image',
		'value' 	=> 'default',
		'label' 	=> __( 'Default', 'catch-kathmandu' ),
	),
	'enable' => array(
		'id'		=> 'catchkathmandu-header-image',
		'value' 	=> 'enable',
		'label' 	=> __( 'Enable', 'catch-kathmandu' ),
	),	
	'disable' => array(
		'id'		=> 'catchkathmandu-header-image',
		'value' 	=> 'disable',
		'label' 	=> __( 'Disable', 'catch-kathmandu' )
	)
);


//Sidebar Layout Options
global $sidebar_layout;
$sidebar_layout = array(
		 'default-sidebar' => array(
            			'id'		=> 'catchkathmandu-sidebarlayout',
						'value' 	=> 'default',
						'label' 	=> __( 'Default Layout Set in', 'catch-kathmandu' ).' <a href="' . admin_url('themes.php?page=theme_options') . '" target="_blank">'. __( 'Theme Options', 'catch-kathmandu' ).'</a>',
						'thumbnail' => ' '
        			),
       'right-sidebar' => array(
						'id' => 'catchkathmandu-sidebarlayout',
						'value' => 'right-sidebar',
						'label' => __( 'Right sidebar', 'catch-kathmandu' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/right-sidebar.png'
       				),
        'left-sidebar' => array(
            			'id'		=> 'catchkathmandu-sidebarlayout',
						'value' 	=> 'left-sidebar',
						'label' 	=> __( 'Left sidebar', 'catch-kathmandu' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/left-sidebar.png'
       				),	 
        'no-sidebar' => array(
            			'id'		=> 'catchkathmandu-sidebarlayout',
						'value' 	=> 'no-sidebar',
						'label' 	=> __( 'No sidebar', 'catch-kathmandu' ),
						'thumbnail' => get_template_directory_uri() . '/inc/panel/images/no-sidebar.png'
        			)	

    );

//Featured Image Options
global $featuredimage_options;
$featuredimage_options = array(
	'default' => array(
		'id'		=> 'catchkathmandu-featured-image',
		'value' 	=> 'default',
		'label' 	=> __( 'Default Layout Set in', 'catch-kathmandu' ).' <a href="' . admin_url('themes.php?page=theme_options') . '" target="_blank">'. __( 'Theme Options', 'catch-kathmandu' ).'</a>',
	),							   
	'featured' => array(
		'id'		=> 'catchkathmandu-featured-image',
		'value' 	=> 'featured',
		'label' 	=> __( 'Featured Image', 'catch-kathmandu' )
	),
	'full' => array(
		'id' => 'catchkathmandu-featured-image',
		'value' => 'full',
		'label' => __( 'Full Image', 'catch-kathmandu' )
	),
	'slider' => array(
		'id' => 'catchkathmandu-featured-image',
		'value' => 'slider',
		'label' => __( 'Slider Image', 'catch-kathmandu' )
	),
	'disable' => array(
		'id' => 'catchkathmandu-featured-image',
		'value' => 'disable',
		'label' => __( 'Disable Image', 'catch-kathmandu' )
	)
);

	
/**
 * @renders metabox to for sidebar layout
 */
function catchkathmandu_meta_options() {  
    global $header_image_options, $sidebar_layout, $featuredimage_options, $post;  
	
	
    // Use nonce for verification  
    wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

    // Begin the field table and loop  ?>  
    <div class="catchkathmandu-meta" style="border-bottom: 2px solid #dfdfdf; margin-bottom: 10px; padding-bottom: 10px;">
    	<h4 class="title"><?php _e('Sidebar Layout', 'catch-kathmandu'); ?></h4>
        <table id="sidebar-layout" class="form-table" width="100%">
            <tbody> 
                <tr>
                    <?php  
                    foreach ($sidebar_layout as $field) {  
                        $metalayout = get_post_meta( $post->ID, $field['id'], true );
                        if(empty( $metalayout ) ){
                            $metalayout='default';
                        }
                        if( $field['thumbnail']==' ' ): ?>
                                <label class="description">
                                    <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metalayout ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                                </label>
                        <?php else: ?>
                            <td>
                                <label class="description">
                                    <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" width="136" height="122" alt="" /></span></br>
                                    <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metalayout ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                                </label>
                            </td>
                        <?php endif;
                    } // end foreach 
                    ?>
                </tr>
            </tbody>
        </table>
   	</div><!-- .catchkathmandu-meta -->      
    
    <div class="catchkathmandu-meta" style="border-bottom: 2px solid #dfdfdf; margin-bottom: 10px; padding-bottom: 10px;">
    	<h4 class="title"><?php _e('Header Featured Image Options', 'catch-kathmandu'); ?></h4>  
        <table id="featuedimage-metabox" class="form-table" width="100%">
            <tbody> 
                <tr>                
                    <?php  
                    foreach ($header_image_options as $field) { 
					
					 	$metaheader = get_post_meta( $post->ID, $field['id'], true );
                        
                        if (empty( $metaheader ) ){
                            $metaheader='default';
                        } ?>
                        
                        <td style="width: 100px;">
                            <label class="description">
                                <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metaheader ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                            </label>
                        </td>
                        
                        <?php
                    } // end foreach 
                    ?>
                </tr>
            </tbody>
        </table>          
	</div><!-- .catchkathmandu-meta -->  
        
    <div class="catchkathmandu-meta">
    	<h4 class="title"><?php _e('Content Featured Image Options', 'catch-kathmandu'); ?></h4>  
        <table id="featuedimage-metabox" class="form-table" width="100%">
            <tbody> 
                <tr>
                    <?php  
                    foreach ($featuredimage_options as $field) { 
					
					 	$metaimage = get_post_meta( $post->ID, $field['id'], true );
                        
                        if (empty( $metaimage ) ){
                            $metaimage='default';
                        } ?>
                        
                        <td style="width: 100px;">
                            <label class="description">
                                <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metaimage ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
                            </label>
                        </td>
                        
                        <?php
                    } // end foreach 
                    ?>
                </tr>
            </tbody>
        </table>          
	</div><!-- .catchkathmandu-meta -->   
                       
<?php 
}


/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function catchkathmandu_save_custom_meta( $post_id ) { 
	global $header_image_options, $sidebar_layout, $featuredimage_options, $post; 
	
	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
        return;
		
	// Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
		
	if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
	

	foreach ( $header_image_options as $field ) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	 } // end foreach 

	
	foreach ($sidebar_layout as $field) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	 } // end foreach   
	 
	foreach ( $featuredimage_options as $field ) {  
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true); 
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {  
			update_post_meta($post_id, $field['id'], $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id, $field['id'], $old);  
		} 
	 } // end foreach 
	 
}
add_action('save_post', 'catchkathmandu_save_custom_meta'); 