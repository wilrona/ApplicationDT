                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <div id="presentation" <?php if($intervention && ($etape->etape == 2 || $etape->etape == 3)): ?> class="hidden" <?php endif; ?>>
    <div class="inner cover">
        <h1 class="cover-heading"><img src="img/logo.png" />  </h1>
        <h1 class="cover-heading edition"><?= $edition_encours->titre; ?></h1>
        <p class="lead"></p>
        <p class="lead"></p>

        <h1 class="cover-heading clock" id="clock">HEURE ACTUELLE</h1>
        <p class="lead date" id="date">DATE DU JOUR</p>
    </div>
    <div class="col-md-12 chrono" > <span class="lead date" style="font-size: 35px;">Un Concept Accent Com</span> </div>
</div>

<div id="speaker" <?php if(!$intervention || $etape->etape <= 1): ?> class="hidden" <?php endif; ?>>

    <div class="col-md-2 col-md-offset-7 ville <?php if($etape->etape == 3): ?> hidden <?php endif; ?>" id="ville">
        <div class="ville-planet" ><img src="/img/planet.png" alt="" class="planet"/>Douala <i class="caret"></i></div>
        <div id="speaker-categorie" style="text-transform: uppercase;"  data-categorie="
        <?php
        if($intervention && $intervention->categorie == "speaker"): echo 1;
        elseif($intervention && $intervention->categorie == "startup"): echo 2;
        elseif($intervention && $intervention->categorie == 'partenaire'): echo 3;
        elseif($intervention && $intervention->categorie == 'partenaire gold'): echo 4;
        endif;
        ?>
        " data-startup="<?php if($intervention): echo $intervention->number; else: echo "0"; endif; ?>" ><?php if($intervention): echo $intervention->categorie; endif; ?></div>
    </div>


    <div class="inner cover <?php if($etape->etape == 3): ?> hidden <?php endif; ?>" id="speaking">

        <h1 class="cover-heading" id="note-chrono">
                <?php if($intervention):
                    echo $this->Html->image($intervention->speaker->avatar, ['class' => 'img-circle', 'id ' => 'speaker-photo', 'style' => 'width:177px;']);

                else:
                ?>

                <?= $this->Html->image('uploads/event_image.jpg', ['class' => 'img-circle', 'id ' => 'speaker-photo', 'style' => 'width:177px;']); ?>

                <?php
                 endif;
                ?>
                <span id="canvas">
                    <span
                        class="canvas"
                        data-value="0.0"
                        data-size="220"
                        ></span>
                </span>

        </h1>
        <h1 class="cover-heading note-view hidden" id="note-view">
            <span id="canvas-notes">
                    <span class="text" id="text-note">0.0 / 5</span>
                    <span
                        class="canvas-notes"
                        data-value="0.0"
                        data-size="220"
                        >
                        </span>
                </span>

        </h1>
        <h1 class="cover-heading speaker" id="speaker-nom"><?php if($intervention): echo $intervention->speaker->nom; endif; ?></h1>
        <p class="lead date" id="speaker-fonction"><?php if($intervention): echo $intervention->speaker->fonction; endif; ?></p>
        <p class="lead"></p>

        <h1 class="cover-heading clock1 hidden blink_me" id="speaking-ico">Speaking <img src="img/digital-clock-2.png"/></h1>
        <h1 class="cover-heading clock1 hidden blink_me" id="question-ico">Question <img src="img/digital-question.png"/></h1>


    </div>

    <div class="inner cover <?php if($etape->etape == 2): ?> hidden <?php endif; ?>" id="end">

        <h1 class="cover-heading clock1" style="font-size: 45px;">Merci à vous !</h1>

        <h1 class="cover-heading"><img src="img/icon-Clap.png" /> </h1>

        <p class="lead date"></p>
        <p class="lead"></p>

        <h1 class="cover-heading clock1"> Avec la participation de : </h1>


        <h1 class="cover-heading clock1"><img src="img/Logo-Castel.png" /> <img src="img/Logo-Media-Plus.png" /> <img src="img/Logo-Kaymu.png" /></h1>


    </div>

    <div class="col-sm-12 chrono2" >
        <div class="col-sm-4 pull-right" >  <span class="lead date" style="font-size: 35px;" ><img src="img/digital-clock.png"/>  </span></div>
        <div class="col-sm-4 pull-left" >  <span class="lead date" style="font-size: 35px;"><img src="img/icon-Twitter+.png"  /></span></div>
    </div>


    <div class="col-sm-12 chrono" >
        <div class="col-sm-4 pull-right" >  <span class="lead date" id="horloge" style="font-size: 35px;">00:00:0</span></div>
        <div class="col-sm-4 pull-left" >  <span class="lead date" id="speaker-twitter" style="font-size: 35px;">
                <?php if($etape->etape == 3): ?>
                    @DgitalThursday
                <?php else: ?>
                <?php if($intervention): echo $intervention->speaker->twitter; endif; ?>

                <?php endif; ?>
            </span></div>
    </div>
</div>

<?php

$this->start('moment');
?>
<nav class="navbar navbar-masthead navbar-default navbar-fixed-bottom moment <?php if($etape->etape == 0 || $etape->etape == 3): ?> hidden <?php endif; ?>" role="navigation" data-etape="<?= $etape->etape; ?>">
    <div class="">
        <div class="row">

            <div class="col-sm-6 col-sm-offset-3 theme">
                <p class="cover-heading edition2 hidden" id="MomentSpeaker1">Marcel EBOA </p>
                <p class="lead date2 hidden" id="MomentSpeaker2">Les logiciels libres pour les startups et les entreprises</p>
                <?php if($etape->etape == 1): ?> <br/> <?php endif; ?>
                <?php if($etape->etape == 2 && $intervention && strlen($intervention->titre) < 50): ?> <br/> <?php endif; ?>
                <p class="lead date2 <?php if($etape->etape == 0): ?> hidden <?php endif; ?>" id="TextMoment">
                    <?php if($intervention && $etape->etape == 2): echo $intervention->titre ?>
                    <?php else: ?>
                    Bienvenue aux Digital Thursday
                    <?php endif; ?>
                </p>
            </div>

            <div class="col-sm-2 col-sm-offset-0">
                <p class="lead hash">#DigitalThursday</p>
            </div>

        </div>

    </div>

    </div>
</nav>

<?php
$this->end();

?>
<?php

$this->start('script2');
?>
<script src="/js/event.js"></script>
<?php
$this->end();

?>