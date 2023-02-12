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
                            <h5 class="main-title">Videos</h5>
                            <p id="errorMes"></p>
                            <div class="top_right_content mt-5 border-con">
                                <h6 style="font-weight: bold;">All Video</h6>
                                <table class="table-hover table pt-2" id="tabRelode">
                                    <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i=0;
                                        foreach ($query as $key => $itme) {
                                        $shown = already_shown($itme->video_id);
                                        if (empty($shown)){
                                    ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $itme->title; ?></td>
                                            <td>
<!--                                                <a href="#" class="btn btn-primary" title="View" style="padding: 0px 10px;font-size: 18px;" onclick="viewVideo(<?php //echo $itme->video_id ?>)"><i class="bi bi-eye-fill"></i></a>-->
                                                <a href="<?php echo base_url('Member/Video/view_video/'.$itme->video_id)?>" class="btn btn-primary" title="View" style="padding: 0px 10px;font-size: 18px;" ><i class="bi bi-eye-fill"></i></a>
                                            </td>
                                        </tr>
                                    <?php  $i++; } } if (empty($i)){ print '<tr class="text-center"><td colspan="3">পরবর্তী অ্যাড রাত ১২ টার পর আসবে</td> </tr>';} ?>

<!--                                    <script src="http://www.youtube.com/player_api"></script>-->
<!--                                    <script>-->
<!--                                        var player;-->
<!--                                        function onYouTubePlayerAPIReady() {-->
<!--                                            player = new YT.Player('player', {-->
<!--                                                events: {-->
<!--                                                    'onReady': onPlayerReady,-->
<!--                                                    'onStateChange': onPlayerStateChange-->
<!--                                                }-->
<!--                                            });-->
<!--                                        }-->
<!--                                        function onPlayerReady(event) {-->
<!--                                            alert(event.target.getDuration());-->
<!--                                            function secondsTimeSpanToHMS(second) {-->
<!--                                                var hour = Math.floor(second/3600);-->
<!--                                                second -= hour*3600;-->
<!--                                                var minute = Math.floor(second/60);-->
<!--                                                second -= minute*60;-->
<!--                                                alert( hour+":"+(minute < 10 ? '0'+minute : minute)+":"+(second < 10 ? '0'+second : second));-->
<!--                                            }-->
<!--                                            secondsTimeSpanToHMS(event.target.getDuration());-->
<!--                                        }-->
<!---->
<!--                                        function onPlayerStateChange(event) {-->
<!--                                            if (event.data == YT.PlayerState.ENDED) {-->
<!--                                                // ('#closeBtn').show();-->
<!--                                                alert("Complete");-->
<!--                                            }-->
<!--                                        }-->
<!--                                    </script>-->

<!--                                    <iframe id="player" width="560" height="315" src="https://www.youtube.com/embed/xU-cPw7Dl8I?enablejsapi=1" frameborder="0" allowfullscreen></iframe>-->
                                    </tbody>
                                </table>
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


