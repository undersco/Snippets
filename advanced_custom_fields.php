<?php
// Get Field value in CPT_2 linked via a relationship field in CPT_1 single.

function get_field_in_CPT_2(){
	//Name of the relationship field in CPT_1
    $relationship_fields = get_field('relationship_fields');

    //Loop through
	foreach( $relationship_fields as $relationship_field){
		$CPT_2_Field = get_field('CPT_2_Field', $relationship_field->ID);
		return $CPT_2_Field;
	}
}
add_shortcode('get_field_in_CPT_2', 'get_field_in_CPT_2');


// Get repeater Field value in CPT_2 linked via a relationship field in CPT_1 single.
function repeater_field_values(){

	//Name of the relationship field in CPT_1
	$relationship_fields = get_field('relationship_fields');


	//Loop through
	foreach( $relationship_fields as $relationship_field){
		
		//Loop in repeater
		if( have_rows('my_repeater_field', $relationship_field->ID) ):

			// Loop through rows.
			while( have_rows('my_repeater_field', $relationship_field->ID) ) : the_row();
		
				// Load sub field value.
				$sub_value = get_sub_field('repeated_field');
				echo $sub_value;
				// Do something...
		
			// End loop.
			endwhile;
		
		// No value.
		else :
			// Do something...
		endif;
		
	}
}
add_shortcode('repeater_field_values', 'repeater_field_values');

// Formatage des champs nombres
add_filter('acf/format_value/name=prix', 'fix_number', 20, 3);
add_filter('acf/format_value/name=prix_minimum', 'fix_number', 20, 3);
add_filter('acf/format_value/name=prix_maximum', 'fix_number', 20, 3);
add_filter('acf/format_value/name=prix_depart', 'fix_number', 20, 3);

function fix_number($value, $post_id, $field) {
  $value = number_format($value, 0, ',', ' ');
  return $value;
}


//Récupérer l'image d'une taxo
function image_from_taxonomy(){
	ob_start();
	$terms = get_the_terms( get_the_ID(), 'tax_slug');
	
	if( !empty($terms) ) {
		$term = array_pop($terms);
		$custom_field = get_field('image_de_la_taxonomie', $term );
	?>
		<img src="<?php echo $custom_field; ?>" />
	<?php
	}
	return ob_get_clean();

}
add_shortcode('image_from_taxonomy','image_from_taxonomy');


//Récupérer la couleur de la taxo
function color_from_taxonomy(){
	ob_start();
	$terms = get_the_terms( get_the_ID(), 'tax_slug');
	
	if( !empty($terms) ) {
		$term = array_pop($terms);
		$custom_field = get_field('main_color_recettes_produits', $term );
		echo $custom_field; 
	}
	return ob_get_clean();

}
add_shortcode('color_from_taxonomy','color_from_taxonomy');

//Add inline style based on a custom taxonomy name with an acf color picker 
function retrieveTaxAndColor(){

	$terms = get_terms( array(
		'taxonomy' => 'tax_name',
		'hide_empty' => false,
	) );

	echo '<style>';
	foreach ($terms as $term) {
		$myTax = $term->slug;
		$color_field = get_field('acf_color_picker', $term );
		?>
		.<?php echo $myTax;?>{background:<?php echo $color_field;?>}
		<?php
	}
	echo '</style>';


}
add_action( 'wp_head', 'retrieveTaxAndColor', 0 );

?>
