<main id="main" class="no-banner">
    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content pt-5">
                            <h5 class="main-title">Video</h5>
<!--                            <p id="errorMes">Videos</p>-->



                            <div class="top_right_content mt-5 border-con">
                                <button type="button" class="btn btn-success btn-sm" id="closeBtn" onclick="closeModal(<?php echo $videoData->video_id;?>)" style="display: none; float: right; ">Get Balance</button>
<!--                                <spen id="countTime" style="float: right;">0</spen>-->
                                <h6 style="font-weight: bold;"><?php echo $videoData->title;?></h6>
                                <br>
                                <script src="https://www.youtube.com/player_api"></script>
                                <script>
                                    var player;
                                    function onYouTubePlayerAPIReady() {
                                        player = new YT.Player('player', {
                                            events: {
                                                'onReady': onPlayerReady,
                                                'onStateChange': onPlayerStateChange
                                            }
                                        });
                                    }
                                    function onPlayerReady(event) {
                                         // alert(event.target.getDuration());
                                        function secondsTimeSpanToHMS(second) {
                                            var hour = Math.floor(second/3600);
                                            second -= hour*3600;
                                            var minute = Math.floor(second/60);
                                            second -= minute*60;
                                            // alert( hour+":"+(minute < 10 ? '0'+minute : minute)+":"+(second < 10 ? '0'+second : second));

                                        }
                                        secondsTimeSpanToHMS(event.target.getDuration());
                                    }

                                    function onPlayerStateChange(event) {
                                        if (event.data == YT.PlayerState.ENDED) {
                                            document.getElementById("closeBtn").style.display = "block";
                                            // alert("Complete");
                                        }
                                    }

                                </script>
                                <iframe id="player" width="100%" height="415" src="https://www.youtube.com/embed/<?php echo $videoData->vi_url;?>?enablejsapi=1" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<div class="modal" id="myModal" style="background-color: #424242fc;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div id="viewVideo"></div>


        </div>
    </div>
</div>


