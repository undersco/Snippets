# Pseudo Dynamic modal

Create an URL ACF Field

Create a modal and add code below as html

```
<div id="player"></div>
```

Add this to your functions.php or plugin file

```
/**
 * getVideoField :
 * 
 * Loop ECS
 * 
 * @return le champs acf video de l'activité en tant qu'attribut (pour les boutons) * 
 */
 
add_shortcode( 'setVideoField', 'get_video_field');
function get_video_field(){

  $page_id = $post->ID;
  $video = get_field('YOUR_ACF_URL_FIELD', $post->ID,true);
  $full_link = 'data-yt-src="';
  return $full_link.'|'.$video;
}
```
Enqueue the JS file

```
wp_enqueue_script( 'youtube-api', plugin_dir_url( __FILE__ ) . 'assets/js/youtube-api.js', '', '1.0.0', true );
```

Edit the domaine name to match yours in playerVars

In your loop create a button and add this class js_activite-modal-video and add [setVideoField] as dynamic shortcode attribute
