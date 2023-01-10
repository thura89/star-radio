
        {{-- {{ Helper::Radio()->audio_playlist_file_path() }} --}}
        {{-- Local Play --}}
        <div id="audio-player-radio" class="jp-radioPlayer" data-radio-url="https://www.radioking.com/play/star3" data-title="Star FM Radio">
            <div class="container">
                <div id="player-instance-radio" class="jp-jplayer"></div>
                <div class="controls jp-controls-holder">
                    <div class="play-pause jp-play pc-play"></div>
                    <div class="play-pause jp-pause fa pc-pause" style=" display:none"></div>
                </div>
                @if (Agent::isMobile())
                <div class="text-right">
                    <h5 class="jp-title" style="padding: 5px 5px 0!important;
                    margin: 0;
                    text-align: right !important;"></h5>
                </div>
                    
                @else
                    <h5 class="jp-title"></h5>
                @endif
                <div class="jp-volume-controls">
                    <button class="sound-control pc-volume jp-mute"></button>
                    <button class="sound-control pc-mute jp-unmute"></button>
                    <div class="jp-volume-bar" style="display: none;">
                        <div class="jp-volume-bar-value" style="width: 1.4737%;"></div>
                    </div>
                </div>
                
            
                <div class="music_pseudo_bars">
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                  <div class="music_pseudo_bar"></div>
                </div>
            </div>
        </div>
        