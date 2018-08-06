<?php
// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Primary Button',  
			'block' => 'a',  
			'classes' => 'button button-primary',
			'wrapper' => true,
			
    ),
    array(  
			'title' => 'Secondary Button',  
			'block' => 'a',  
			'classes' => 'button button-secondary',
			'wrapper' => true,
		),
    array(  
			'title' => 'Tertiary Button',  
			'block' => 'a',  
			'classes' => 'button button-tertiary',
			'wrapper' => true,
		),
    array(  
			'title' => 'Heading 1 styles',  
			'selector' => 'h1,h2,h3,h4,h5,h6',
			'classes' => 'h1',
			'wrapper' => false,
		),
    array(  
			'title' => 'Heading 2 styles',  
			'selector' => 'h1,h2,h3,h4,h5,h6',
			'classes' => 'h2',
			'wrapper' => false,
		),
    array(  
			'title' => 'Heading 3 styles',  
			'selector' => 'h1,h2,h3,h4,h5,h6',
			'classes' => 'h3',
			'wrapper' => false,
		),
    array(  
			'title' => 'Heading 4 styles',  
			'selector' => 'h1,h2,h3,h4,h5,h6',
			'classes' => 'h4',
			'wrapper' => false,
		),
    array(  
			'title' => 'Heading 5 styles',  
			'selector' => 'h1,h2,h3,h4,h5,h6',
			'classes' => 'h5',
			'wrapper' => false,
		),
    array(  
			'title' => 'Heading 6 styles',  
			'selector' => 'h1,h2,h3,h4,h5,h6',
			'classes' => 'h6',
			'wrapper' => false,
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 