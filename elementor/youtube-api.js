/**
 * Créer une modale et inserer <div id="player"></div> dedans
 * Crer un bouton et passer en attribut l'url de la video : data-yt-src="lien de ma video yt" + une classe spécifique pour buttonsYT
 */
document.addEventListener('DOMContentLoaded',init)

function init(){
    console.log('init youtube')

    var nhPlayer;

    function loadYouTubeApi(event) {
        const iframeLink = event.currentTarget.dataset.ytSrc

        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        videoID = iframeLink.replace('https://www.youtube.com/watch?v=', '');
        jQuery(document).on('elementor/popup/show', function () {
            setTimeout(onYouTubeIframeAPIReady, 1000)
        })

    }

    function onYouTubeIframeAPIReady() {
        nhPlayer = new YT.Player('player', {
            height: '390',
            width: '640',
            videoId: videoID,
            playerVars: { 'autoplay': 1, 'controls': 0, 'autohide': 1, 'wmode': 'opaque', 'origin': 'https://domainName.com' },
            // events: {
            //     'onReady': onPlayerReady
            // }
        });
    }

    function onPlayerReady(event) {
        // nhPlayer.setPlaybackRate(1);
        // nhPlayer.playVideo();
    }

    jQuery(document).on('elementor/popup/hide', function () {
        console.log('gone')
    })


    const buttonsYT = document.querySelectorAll('.js_activite-modal-video');


    buttonsYT.forEach(buttonYT => {
        buttonYT.addEventListener('click', loadYouTubeApi)
    })


}
