<nav class="navbar navbar-masthead navbar-default navbar-fixed-top" role="navigation" style="background: #fff;">
    <div class="row text-center">
        <h1 class="header" style="margin-top: 10px;">#DigitalThursday</h1>
    </div>
</nav>
<div class="inner cover" id="live-content">
    <?php foreach($twitter as $tweet): ?>
    <div class="panel panel-default" id="tweet">
        <div class="panel-body">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <?= $this->Html->image($tweet->user->profile_image_url, ['class' => 'media-object', 'style' => 'width: 50px; height: 50px;']) ?>
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">@<?= $tweet->user->screen_name; ?></h4>
                    <?= $autolink->autolink($tweet->text); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>

<?php
$this->end();

?>
<?php

$this->start('script2');
?>
<script>
    var last_tweet = "<?= $twitter[0]->id ?>";
    $(document).ready(function(){
        v = 0;
        setInterval(function tweet(){
            var url = "/evenement/live.json?last="+last_tweet;
            console.log(v++)
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    console.log('Rien');
                    if(data.twitter.length != 0){
                        for (var i = 0; i < data.twitter.length; i++){

                            console.log(data.twitter[i]);
                            $html = '<div class="panel panel-default" id="tweet">';
                            $html += '<div class="panel-body">';
                            $html += '<div class="media">';
                            $html += '<div class="media-left">';
                            $html += '<a href="#">';
                            $html += '<img src="'+data.twitter[i].user.profile_image_url+'" class="media-object" style="width: 50px; height: 50px;">'
                            $html += '</a>';
                            $html += '</div>';
                            $html += '<div class="media-body">';
                            $html += '<h4 class="media-heading">';
                            $html += '@'+data.twitter[i].user.screen_name;
                            $html += '</h4>';
                            $html += data.twitter[i].text;
                            $html += '</div>';
                            $html += '</div>';
                            $html += "</div>";
                            $html += "</div>";

                            if(i==0){
                                last_tweet = data.twitter[i].id;
                            }

                            $('#live-content').prepend($html);
                            $('#tweet:last-child').remove();
                            console.log('passe '+i);
                        }


                    }
                }
            });

        }, 10000);

    });
</script>
<?php
$this->end();

?>