var hiddenPlayer = document.getElementById("hidden-player");
var player = document.getElementById("player");
var title = document.getElementById('title');
var artist = document.getElementById('artist');
var cover = document.getElementById('portada');
songs = [
    {
        src: "../assets/media/podcast/1_El_Poder_de_la_Poesia.wav",
        title: "El poder de la poesía",
        artist: "Podcaster1",
        coverart: "assets/img/main/podcast_poesia.jpg"
    },
    {
        src: "../assets/media/podcast/2_El_podcast_en_tiempos_de_la_virtualidad.wav",
        title: "El podcast en tiempos de la virtualidad",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_virtualidad.jpg"
    },
    {
        src: "../assets/media/podcast/3_Loqueleo_con_los_mas_peques.wav",
        title: "Loqueleo con los más peques",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_peques.jpg"
    },
    {
        src: "../assets/media/podcast/4_Intencion_de_voz.wav",
        title: "Intenciones de voz. Sonidos y experiencias lectoras",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_voz.jpg"
    },
    {
        src: "../assets/media/podcast/5_Lecturas_para_encender_la_imaginacion.wav",
        title: "¡Para leerte mejor! Lecturas para prender la imaginación",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_imaginacion.jpg"
    },
    {
        src: "../assets/media/podcast/6_LoqueleoParaElCorazon_0.1.wav",
        title: "Loqueleo para el corazón",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_loqueleoparaelcorazon.png"
    },
    {
        src: "../assets/media/podcast/7_AbrazarconlasPalabras_0.1.wav",
        title: "Abrazar con las palabras",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_abrazarconlaspalabras.png"
    },
    {
        src: "../assets/media/podcast/8_LoqueleoconLosMasGrandes_0.1.wav",
        title: "Loqueleo con los mas grandes",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_loqueleoconlosmasgrandes.png"
    },
    {
        src: "../assets/media/podcast/9_LoqueleoenelMundo_0.1.wav",
        title: "Loqueleo en el mundo",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_loqueleoenelmundo.png"
    },
    {
        src: "../assets/media/podcast/10_LoqueleoenFamilia_0.1.wav",
        title: "Loqueleo en familia",
        artist: "Podcaster2",
        coverart: "assets/img/main/podcast_loqueleoenfamilia.png"
    }

];
var items = songs.length - 1;
function activatePodcastModal(id_podcast) {
    var initSongSrc = songs[id_podcast].src;
    var initSongTitle = songs[id_podcast].title;
    //var initSongArtist = songs[id_podcast].artist;
    var initSongCover = songs[id_podcast].coverart;
    //Carga de datos desde la lista Songs
    hiddenPlayer.setAttribute('src', initSongSrc);
    title.innerHTML = initSongTitle;
    //artist.innerHTML = initSongArtist;
    cover.setAttribute('src', initSongCover);
    hiddenPlayer.play();
}

function stop_audio() {
    hiddenPlayer.pause();
}



function loadDataFromList() {
            var initSongSrc = songs[0].src;
            var initSongTitle = songs[0].title;
            var initSongArtist = songs[0].artist;
            var initSongCover = songs[0].coverart;
            //Carga de datos desde la lista Songs
            hiddenPlayer.setAttribute('src', initSongSrc);
            title.innerHTML = initSongTitle;
            artist.innerHTML = initSongArtist;
            cover.setAttribute('src', initSongCover);
            hiddenPlayer.setAttribute('order', '0');
}
function loadDataModal() {
            var dur = hiddenPlayer.duration;
            var songLength = v.secondsTimeSpanToHMS(dur)
            var songLengthParse = songLength.split(".")[0];
            timefinal.innerHTML = songLengthParse;
}
function play_sound() {
            if(hiddenPlayer.paused && hiddenPlayer.currentTime > 0 && !hiddenPlayer.ended) {
                hiddenPlayer.play();
             } else {
                hiddenPlayer.pause();
             }
            /*$(this).toggleClass("paused");
            if ($(this).hasClass("paused")) {
                hiddenPlayer.pause();
            } else {
                hiddenPlayer.play();
            }*/
}
    
