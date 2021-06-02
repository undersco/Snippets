function client_scripts() {
	if(!is_admin() || is_page(751)){ //pour ne pas appliquer les styles et charger inutilement du style dans le BO
	//Ajout des JS (appelés dans le footer)
		wp_enqueue_script('myJS1', get_stylesheet_directory_uri() . '/js/timeline.js', array( 'jquery' ),  NULL, true);
		
	}
	if(!is_admin()){
		wp_enqueue_script('myJS2', get_stylesheet_directory_uri() . '/js/sliderMenu.js', array( 'jquery' ),  NULL, true);
	}
	
  //Ajoute le type Module aux JS
	add_filter('script_loader_tag',
    function ($tag, $handle, $src) {
        if (('myJS1' === $handle) || ('myJS2' === $handle)){
            $tag = '<script type="module" src="' . $src . '"></script>';
        }

        return $tag;
    }
    , 10, 3);

}
add_action('wp_enqueue_scripts', 'client_scripts', 101);
