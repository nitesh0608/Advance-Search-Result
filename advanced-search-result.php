<?php


// Get data from URL into variables
$_name = $_GET['name'] != '' ? $_GET['name'] : '';
$_model = $_GET['model'] != '' ? $_GET['model'] : '';

// Start the Query
$v_args = array(
        'post_type'     =>  'vehicle', // your CPT
        's'             =>  $_name, // looks into everything with the keyword from your 'name field'
        'meta_query'    =>  array(
                                array(
                                    'key'     => 'car_model', // assumed your meta_key is 'car_model'
                                    'value'   => $_model,
                                    'compare' => 'LIKE', // finds models that matches 'model' from the select field
                                ),
                            )
    );
$vehicleSearchQuery = new WP_Query( $v_args );

// Open this line to Debug what's query WP has just run
// var_dump($vehicleSearchQuery->request);

// Show the results
if( $vehicleSearchQuery->have_posts() ) :
    while( $vehicleSearchQuery->have_posts() ) : $vehicleSearchQuery->the_post();
        the_title(); // Assumed your cars' names are stored as a CPT post title
    endwhile;
else :
    _e( 'Sorry, nothing matched your search criteria', 'textdomain' );
endif;
wp_reset_postdata();
?>