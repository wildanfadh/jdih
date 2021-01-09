<div class="city_main_banner">
    <div class="main-banner-slider">
        <div>
            <figure class="overlay">
                <img src="<?php echo base_url("assets") ?>/extra-images/foto1.jpg" alt="">
                <div class="banner_text">
                    <div class="small_text animated">Jaringan Dokumentasi dan Informasi Hukum</div>
                    <div class="medium_text animated">Kota</div>
                    <div class="large_text animated"><span id='text'></span>
                        <div class='console-underscore' id='console'>&#95;</div>
                    </div>
                    <div class="banner_search_form">
                        <label>Cari Produk Hukum</label>
                        <div class="banner_search_field animated">
                            <input type="text" id="search_text1" placeholder="di sini" style="color: #ffffff;">
                            <a id="search_prokum1"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </figure>
        </div>
        <div>
            <figure class="overlay">
                <img src="<?php echo base_url("assets") ?>/extra-images/foto2.jpg" alt="">
                <div class="banner_text">
                    <div class="small_text animated">Jaringan Dokumentasi dan Informasi Hukum</div>
                    <div class="medium_text animated">Kota</div>
                    <div class="large_text animated">mojokerto</div>
                    <div class="banner_search_form">
                        <label>Cari Produk Hukum</label>
                        <div class="banner_search_field animated">
                            <input type="text" id="search_text2" placeholder="di sini" style="color: #ffffff;">
                            <a id="search_prokum2"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </figure>
        </div>
        <div>
            <figure class="overlay">
                <img src="<?php echo base_url("assets") ?>/extra-images/foto3.jpg" alt="">
                <div class="banner_text">
                    <div class="small_text animated">Jaringan Dokumentasi dan Informasi Hukum</div>
                    <div class="medium_text animated">Kota</div>
                    <div class="large_text animated">mojokerto</div>
                    <div class="banner_search_form">
                        <label>Cari Produk Hukum</label>
                        <div class="banner_search_field animated">
                            <input type="text" id="search_text3" placeholder="di sini" style="color: #ffffff;">
                            <a id="search_prokum3"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </figure>
        </div>
    </div>
</div>

<div class="city_about_wrap" style="padding: 26px;">
    <div class="container">
        <div class="row">&nbsp;</div>
    </div>
</div>

<div class="city_department_wrap overlay">
    <!-- <div class="bg_white" style="padding: 50px 35px 20px;"> -->
    <div class="bg_white">
        <div class="container-fluid">
            <!--SECTION HEADING START-->
            <div class="section_heading margin-bottom">
                <span>Update</span>
                <h2>Peraturan Terbaru</h2>
            </div>
            <!--SECTION HEADING END-->

            <style>
                .city_department_fig {
                    min-height: 143px;
                }
            </style>
            <div class="city-department-slider">
                <div>
                    <?php foreach ($prokum1 as $val) { ?>
                        <div class="width_control">
                            <div class="city_department_fig">
                                <figure class="box">
                                    <div class="box-layer layer-1"></div>
                                    <div class="box-layer layer-2"></div>
                                    <div class="box-layer layer-3"></div>
                                    <img src="<?php echo base_url("assets") ?>/extra-images/department-fig.jpg" alt="">
                                    <a class="paly_btn" data-rel="prettyPhoto" href="<?php echo base_url("assets") ?>/extra-images/department-fig.jpg"><i class="fa fa-plus"></i></a>
                                </figure>
                                <div class="city_department_text">
                                    <h5><?php echo substr($val["tipe_texted"], 0, 20); ?></h5>
                                    <p><?php echo substr($val["subjek_singkat"], 0, 30); ?>...</p>
                                    <a href="#" class="view-pdf" data-id="<?php echo $val["id"]; ?>" data-status="<?php echo $val["is_upload"]; ?>" data-file="<?php echo $val["file"]; ?>">Lihat Prokum<i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if (!empty($prokum2)) { ?>
                    <div>
                        <?php foreach ($prokum2 as $val) { ?>
                            <div class="width_control">
                                <div class="city_department_fig">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="<?php echo base_url("assets") ?>/extra-images/department-fig.jpg" alt="">
                                        <a class="paly_btn" data-rel="prettyPhoto" href="<?php echo base_url("assets") ?>/extra-images/department-fig.jpg"><i class="fa fa-plus"></i></a>
                                    </figure>
                                    <div class="city_department_text">
                                        <h5><?php echo substr($val["tipe_texted"], 0, 20); ?></h5>
                                        <p><?php echo substr($val["subjek_singkat"], 0, 30); ?>...</p>
                                        <a href="#" class="view-pdf" data-id="<?php echo $val["id"]; ?>" data-status="<?php echo $val["is_upload"]; ?>" data-file="<?php echo $val["file"]; ?>">Lihat Prokum<i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!--Pretty Photo JavaScript-->
<script src="<?php echo base_url("assets") ?>/js/index.js"></script>