<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Pelayanan</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">JDIH</a></li>
                <li class="breadcrumb-item active">Pelayanan</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_services2_wrap">
    <div class="container">
        <div class="row">

            <!-- <div class="col-md-4 col-sm-6">
                <div class="city_service2_fig">
                    <figure class="overlay">
                        <img src="<?php echo base_url("assets/"); ?>extra-images/service-fig.jpg" alt="">
                        <div class="city_service2_list">
                            <span><i class="fa icon-heart"></i></span>
                            <div class="city_service2_caption">
                                <h4><span>Login Admin</span>OPD</h4>
                            </div>
                        </div>
                    </figure>
                    <div class="city_service2_text">
                        <p> Layanan untuk OPD, pengajuan draft produk hukum secara elektronik.</p>
                        <a class="see_more_btn" href="<?php echo base_url("Login"); ?>">Masuk <i class="fa icon-next-1"></i></a>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-4 col-sm-6">
                <div class="city_service2_fig">
                    <figure class="overlay">
                        <img src="<?php echo base_url("assets/"); ?>extra-images/service-fig.jpg" alt="">
                        <div class="city_service2_list">
                            <span><i class="fa icon-pie-chart"></i></span>
                            <div class="city_service2_caption">
                                <h4><span>Konsultasi</span>Hukum</h4>
                            </div>
                        </div>
                    </figure>
                    <div class="city_service2_text">
                        <p> Layanan korespodensi via email untuk Bantuan dan Konsultasi Hukum.</p>
                        <a class="see_more_btn" href="#">Masuk <i class="fa icon-next-1"></i></a>
                    </div>
                </div>
            </div> -->

            <div class="col-md-12 col-sm-12">
                <div class="city_service2_fig">
                    <!-- <figure class="overlay">
                        <img src="<?php echo base_url("assets/"); ?>extra-images/service-fig.jpg" alt="">
                        <div class="city_service2_list">
                            <span><i class="fa icon-pie-chart"></i></span>
                            <div class="city_service2_caption">
                                <h4><span>Info</span>E-Promperda</h4>
                            </div>
                        </div>
                    </figure> -->
                    <div class="city_service2_text">
                        <!-- <p> Layanan untuk OPD, lacak proses Propemperda.</p> -->
                        <div class="row info mb-5 p-5">
                            <h3 class="text-center judul-ket" id="infoket">Keterangan Fitur</h3>

                            <div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <symbol viewBox="0 0 24 24" id="expand-more">
                                        <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z" />
                                        <path d="M0 0h24v24H0z" fill="none" />
                                    </symbol>
                                    <symbol viewBox="0 0 24 24" id="close">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                                        <path d="M0 0h24v24H0z" fill="none" />
                                    </symbol>
                                </svg>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <?php
                                $open = "";
                                if ($nav == 2) {
                                    $open = "open";
                                } ?>
                                <details <?php echo $open; ?> id="pengajuan_info">
                                    <summary>
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> <span> Pengajuan Produk Hukum</span>
                                        <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                                        <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
                                    </summary>
                                    <p>Pengajuan Produk Hukum adalah Fitur untuk mengajukan Produk/Peraturan Hukum kepada Walikota untuk di Acc terlebih dahulu kemudian akan diterbitkan.</p>
                                </details>

                                <?php
                                $open = "";
                                if ($nav == 1) {
                                    $open = "open";
                                } ?>
                                <details <?php echo $open; ?>>
                                    <summary>
                                        <i class="fa fa-commenting-o" aria-hidden="true"></i> <span> Konsultasi Hukum</span>
                                        <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                                        <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
                                    </summary>
                                    <p>Konsultasi Hukum adalah Fitur untuk mengajukan konsultasi terkait dengan Produk/Peraturan Hukum. </p>
                                </details>


                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <details id="penyusunan_info">
                                    <summary>
                                        <i class="fa fa-book" aria-hidden="true"></i> <span> Penyusunan Produk Hukum</span>
                                        <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                                        <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
                                    </summary>
                                    <p>Penyusunan Produk Hukum adalah Fitur untuk melihat daftar Produk Hukum yang sedang disusun.</p>
                                </details>

                                <details id="promperda">
                                    <summary class="view-pdf" href="#" data-file="<?php echo ("KEP. DPRD-2020-12- PROPEMPERDA_001234.pdf"); ?>">
                                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                        <sapn> Lihat E-Propemperda</sapn>
                                        <!-- <svg class="c-icon" width="24" height="24"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg> -->
                                        <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                                        <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                                    </summary>
                                </details>

                            </div>


                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</div>