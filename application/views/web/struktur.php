<style>
    .mtop-30 {
        margin-top: 30px;
    }
</style>

<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Pejabat Struktural</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">JDIH</a></li>
                <li class="breadcrumb-item"><a href="#">Profil</a></li>
                <li class="breadcrumb-item active">Pejabat Struktural</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_event2_wrap" style="margin-bottom: 40px; padding-top: 40px;">
    <div class="container">

        <?php if (!empty($personil)) { ?>
            <div class="mayor_team">
                <div class="section_heading center mtop-30">
                    <h2>Kepala Bagian</h2>
                </div>

                <div class="col-md-4 col-sm-12"></div>
                <div class="col-md-4 col-sm-4">
                    <div class="city_team_fig">
                        <figure class="overlay">
                            <img src="<?php echo base_url("uploads/" . $kepala[0]["foto"]); ?>" alt="">
                            <div class="city_top_social">
                                <ul>
                                    <li>
                                        <h4 style="color: #ffffff;"><?php echo ucwords(strtolower($kepala[0]["jabatan"])); ?></h4>
                                    </li>
                                </ul>
                            </div>
                        </figure>
                        <div class="city_team_text">
                            <h4><a href="#"><?php echo ucwords(strtolower($kepala[0]["nama"])); ?></a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12"></div>

                <div class="section_heading center mtop-30">
                    <h2>Kepala Sub Bagian</h2>
                </div>

                <?php foreach ($sub as $key => $val) { ?>
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

                <div class="section_heading center mtop-30">
                    <h2>Staff</h2>
                </div>

                <?php foreach ($staff as $key => $val) { ?>
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
        <?php } ?>
    </div>
</div>