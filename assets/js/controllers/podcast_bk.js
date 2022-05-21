Vue.component('modal',{ //modal
    template:`
        <transition enter-active-class="animated bounceInUp" leave-active-class="animated bounceOutUp">
            <div class="modal is-active">
                <div class="modal-card border border border-secondary">
                    <div class="modal-card-head text-center bg-dark">
                        <div class="modal-card-title text-white">
                            <slot name="head"></slot>
                        </div>
                        <button class="delete" @click="$emit('close')"></button>
                    </div>
                    <div class="modal-card-body">
                        <slot name="body"></slot>
                    </div>
                    <div class="modal-card-foot" >
                        <slot name="foot"></slot>
                    </div>                </div>
            </div>
        </transition>`
    })

var num = 0;
var hiddenPlayer = document.getElementById("hidden-player");
var player = document.getElementById("player");
var title = document.getElementById('title');
var artist = document.getElementById('artist');
var cover = document.getElementById('coverr');
var timefinal = document.getElementById("time-finish");
var timenow = document.getElementById("time-now");
songs = [{
    src: "../latl/assets/media/podcast_1.mp3",
    title: "Podcast 1'",
    artist: "Podcaster",
    coverart: "http://static.djbooth.net/pics-features/oddisee-art-thumb.jpg"
}];
var items = songs.length - 1;

var v = new Vue({
    el:'#podcast',
    data:{
        url:'http://192.168.1.73/latl/',
        podcastModal : false,
    },
    methods:{
        activateModal() {
            v.podcastModal = true; 
            //v.loadDataFromList; 
            //v.loadDataModal; 
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
            
            var dur = hiddenPlayer.duration;
            var songLength = v.secondsTimeSpanToHMS(dur)
            var songLengthParse = songLength.split(".")[0];
            timefinal.innerHTML = songLengthParse;
        },
        secondsTimeSpanToHMS(s) {
            var h = Math.floor(s / 3600); //Get whole hours
            s -= h * 3600;
            var m = Math.floor(s / 60); //Get remaining minutes
            s -= m * 60;
            return h + ":" + (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s : s); //zero padding on minutes and seconds
        },
        loadDataFromList() {
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
        },
        loadDataModal() {
            var dur = hiddenPlayer.duration;
            var songLength = v.secondsTimeSpanToHMS(dur)
            var songLengthParse = songLength.split(".")[0];
            timefinal.innerHTML = songLengthParse;
        },
        next_sound() {
            //var songOrder = hiddenPlayer.attr('order');
            var songOrder = hiddenPlayer.setAttribute('order');

            if (items == songOrder) {
                num = 0;
                var songSrc = songs[0].src;
                var songTitle = songs[0].title;
                var songArtist = songs[0].artist;
                var songCover = songs[0].coverart;

                //hiddenPlayer.attr('order', '0');
                hiddenPlayer.setAttribute('order', '0');
                //hiddenPlayer.attr('src', songSrc).trigger('play');
                hiddenPlayer.setAttribute('src', songSrc);
                hiddenPlayer.play();
                /*title.html(songTitle);
                artist.html(songArtist);
                cover.attr('src', songCover);*/
                title.innerHTML = songTitle;
                artist.innerHTML = songArtist;
                cover.setAttribute('src', songCover);

            } else {
                console.log(songOrder);
                num += 1;
                var songSrc = songs[num].src;
                var songTitle = songs[num].title;
                var songArtist = songs[num].artist;
                var songCover = songs[num].coverart;

                //hiddenPlayer.attr('src', songSrc).trigger('play');
                hiddenPlayer.setAttribute('src', songSrc);
                hiddenPlayer.play();

                /*title.html(songTitle);
                artist.html(songArtist);
                cover.attr('src', songCover);*/

                title.innerHTML = songTitle;
                artist.innerHTML = songArtist;
                cover.setAttribute('src', songCover);
                hiddenPlayer.setAttribute('order', num);
                //hiddenPlayer.attr('order', num);
            }

        },
        prev_sound() {
            //var songOrder = hiddenPlayer.attr('order');
            var songOrder = hiddenPlayer.setAttribute('order');
            if (songOrder == 0) {
                num = items;
                var songSrc = songs[items].src;
                var songTitle = songs[items].title;
                var songArtist = songs[items].artist;

                //hiddenPlayer.attr('order', items);
                hiddenPlayer.setAttribute('order', items);
                hiddenPlayer.setAttribute('src', songSrc);
                hiddenPlayer.play();
                //hiddenPlayer.attr('src', songSrc).trigger('play');
                /*title.html(songTitle);
                artist.html(songArtist);*/
                title.innerHTML = songTitle;
                artist.innerHTML = songArtist;
            } else {
                num -= 1;
                var songSrc = songs[num].src;
                var songTitle = songs[num].title;
                var songArtist = songs[num].artist;

                //hiddenPlayer.attr('src', songSrc).trigger('play');
                hiddenPlayer.setAttribute('src', songSrc);
                hiddenPlayer.play();

                /*title.html(songTitle);
                artist.html(songArtist);*/

                title.innerHTML = songTitle;
                artist.innerHTML = songArtist;

                //hiddenPlayer.attr('order', num);
                hiddenPlayer.setAttribute('order', num);
            }

        },
        play_sound() {
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
        },
        time_update(){

            var dur = hiddenPlayer.duration;
            var songLength = v.secondsTimeSpanToHMS(dur)
            var songLengthParse = songLength.split(".")[0];
            timefinal.innerHTML = songLengthParse;

            var songCurrent = v.secondsTimeSpanToHMS(dur)
            var songCurrentParse = songCurrent.split(".")[0];
            timenow.innerHTML = songCurrentParse;
            hiddenPlayer.setAttribute('value', hiddenPlayer.currentTime / hiddenPlayer.duration);
            //$('progress').attr("value", this.currentTime / this.duration);
            /*if (!hiddenPlayer[0].paused) {
                $(".play-button").removeClass('paused');
                $('progress').css('cursor', 'pointer');
                
                
                $('progress').on('click', function(e) {
                    var parentOffset = $(this).parent().offset(); 
                    var relX = e.pageX - parentOffset.left;
                    var percPos = relX * 100 / 355;
                    var second = hiddenPlayer[0].duration * parseInt(percPos) / 100;
                    console.log(second);
                    hiddenPlayer[0].currentTime = second;
                })
            }/*/
            if(!hiddenPlayer.pause){
                var element = document.getElementById("play-btn");
                element.classList.remove("paused");
                document.getElementById("progress-element").style.cursor = pointer;
            }
            
            if (hiddenPlayer.currentTime == hiddenPlayer.duration) {
                $('.next').trigger('click');
            }


        }
    }
})