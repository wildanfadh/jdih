<style>
    .profil {
        font-size: 16px;
    }

    ul.profil li {
        line-height: 2;
    }

    h6.title {
        font-size: 20px;
        font-weight: 600;
    }

    h3.title,
    p.title {
        margin-bottom: 0px;
        color: green !important;
    }

    p.title {
        margin-bottom: 10px;
    }

    div.title {
        text-align: center;
    }
</style>

<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Profil Walikota</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">JDIH</a></li>
                <li class="breadcrumb-item active">Profil</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_event2_wrap" style="margin-bottom: 40px; padding-top: 40px;">
    <div class="container">
        <div class="city_mayor_row">
            <div class="city_mayor_fig">
                <figure>
                    <img src="<?php echo base_url("uploads/" . $profil["foto"]) ?>" alt="" style="margin-bottom: 10px;">
                    <div class="title">
                        <h3 class="title"><?php echo ucwords(strtolower($profil["walikota"])); ?></h3>
                        <p class="title">Walikota Mojokerto</p>
                    </div>
                </figure>

                <?php if (!empty($wakil)) { ?>
                    <figure style="float: right;">
                        <img src="<?php echo base_url("uploads/" . $wakil["foto"]) ?>" alt="" style="margin-bottom: 10px;">
                        <div class="title">
                            <h3 class="title"><?php echo ucwords(strtolower($wakil["nama"])); ?></h3>
                            <p class="title">Wakil Walikota Mojokerto</p>
                        </div>
                    </figure>
                <?php } else { ?>
                    <figure style="float: right;">
                        <img src="<?php echo base_url("assets/extra-images/anon.jpg"); ?>" alt="" style="margin-bottom: 10px;">
                        <div class="title">
                            <h3 class="title">-</h3>
                            <p class="title">Wakil Walikota Mojokerto</p>
                        </div>
                    </figure>
                <?php } ?>
            </div>

            <div class="city_mayor_text" style="text-align: center;">
                <!-- <h2><?php echo ucwords(strtolower($profil["walikota"])); ?></h2>
                <p>Walikota Mojokerto</p> -->

                <?php if (!empty($visi)) { ?>
                    <h6 class="title">Visi</h6>
                    <ul class="profil">
                        <?php foreach ($visi as $val) { ?>

                            <!-- <li><?php echo ucwords(strtolower($val["visi"])); ?></li> -->
                            <li><?php echo $val["visi"]; ?></li>

                        <?php } ?>
                    </ul>
                <?php } ?>
                <br>

                <?php if (!empty($misi)) { ?>
                    <h6 class="title">Misi</h6>
                    <ul class="profil">
                        <?php
                            $i = 1;
                            foreach ($misi as $val) { ?>

                            <!-- <li><?php echo $i . ". " . ucwords(strtolower($val["misi"])); ?></li> -->
                            <li><?php echo $i . ". " . $val["misi"]; ?></li>

                        <?php $i++;
                            } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>

        <!-- <?php if (!empty($personil)) { ?>
            <div class="mayor_team">
                <div class="section_heading center">
                    <h2>Personil</h2>
                </div>

                <?php foreach ($personil as $key => $val) { ?>
                    <div class="col-md-4 col-sm-4">
                        <div class="city_team_fig">
                            <figure class="overlay">
                                <img src="<?php echo base_url("uploads/" . $val["foto"]); ?>" alt="">
                                <div class="city_top_social">
                                    <ul>
                                        <li>
                                            <h4 style="color: #ffffff;"><?php echo ucwords(strtolower($val["jabatan"])); ?></h4>
                                        </li>
                                    </ul>
                                </div>
                            </figure>
                            <div class="city_team_text">
                                <h4><a href="#"><?php echo ucwords(strtolower($val["nama"])); ?></a></h4>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?> -->
    </div>
</div>