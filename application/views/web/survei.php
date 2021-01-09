<style>
    .header {
        margin-bottom: 65px;
    }

    /* The container */
    .containerr {
        display: block;
        position: relative;
        /* padding-left: 35px; */
        /* margin-bottom: 12px; */
        cursor: pointer;
        font-size: 15px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;

        margin-bottom: 0px;
        padding-left: 0px;
    }

    /* Hide the browser's default radio button */
    .containerr input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
        position: absolute;
        /* top: 0;
        left: 0; */
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;

        top: 5px;
        left: 0;
    }

    /* On mouse-over, add a grey background color */
    .containerr:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .containerr input:checked~.checkmark {
        background-color: #df193a;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .containerr input:checked~.checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .containerr .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }

    .error {
        border: 1px solid #df193a !important;
    }

    .chart-container {
        position: relative;
        margin: auto;
        height: 45vh;
        width: 60vw;
    }
</style>

<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Survei</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">JDIH</a></li>
                <li class="breadcrumb-item active">Survei</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_services2_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="city_business_fig">
                    <figure class="overlay">
                        <img src="<?php echo base_url("assets/") ?>extra-images/business_fig.jpg" alt="">
                        <div class="city_service2_list">
                            <span><i class="fa icon-classroom"></i></span>
                            <div class="city_service2_caption">
                                <h5>
                                    SUB BAGIAN <br>
                                    PRODUK HUKUM
                                </h5>
                            </div>
                        </div>
                    </figure>
                    <div class="city_business_list">
                        <a href="#" class="see_more_btn survey-btn" data-tipe="<?php echo TIPE_1; ?>" data-title="SUB BAGIAN, PRODUK HUKUM"><i class=" fa fa-star-o"></i>Survei</a>
                        <a class="see_more_btn hasil-btn" href="#" data-tipe="<?php echo TIPE_1; ?>" data-title="SUB BAGIAN, PRODUK HUKUM">
                            Lihat Hasil Survei <i class="fa icon-next-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="city_business_fig">
                    <figure class="overlay">
                        <img src="<?php echo base_url("assets/") ?>extra-images/business_fig.jpg" alt="">
                        <div class="city_service2_list">
                            <span><i class="fa icon-bag"></i></span>
                            <div class="city_service2_caption">
                                <h5>
                                    SUB BAGIAN <br>
                                    BAGIAN HUKUM DAN KONSULTASI
                                </h5>
                            </div>
                        </div>
                    </figure>
                    <div class="city_business_list">
                        <a href="#" class="see_more_btn survey-btn" data-tipe="<?php echo TIPE_2; ?>" data-title="SUB BAGIAN, BAGIAN HUKUM DAN KONSULTASI">
                            <i class=" fa fa-star-o"></i>Survei
                        </a>
                        <a class="see_more_btn hasil-btn" href="#" data-tipe="<?php echo TIPE_2; ?>" data-title="SUB BAGIAN, BAGIAN HUKUM DAN KONSULTASI">
                            Lihat Hasil Survei <i class="fa icon-next-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="city_business_fig">
                    <figure class="overlay">
                        <img src="<?php echo base_url("assets/") ?>extra-images/business_fig.jpg" alt="">
                        <div class="city_service2_list">
                            <span><i class="fa icon-home"></i></span>
                            <div class="city_service2_caption">
                                <h5>
                                    SUB BAGIAN <br>
                                    DOKUMENTASI HUKUM DAN PENYULUHAN HUKUM
                                </h5>
                            </div>
                        </div>
                    </figure>
                    <div class="city_business_list">
                        <a href="#" class="see_more_btn survey-btn" data-tipe="<?php echo TIPE_3; ?>" data-title="SUB BAGIAN, DOKUMENTASI HUKUM DAN PENYULUHAN HUKUM">
                            <i class=" fa fa-star-o"></i>Survei
                        </a>
                        <a class="see_more_btn hasil-btn" href="#" data-tipe="<?php echo TIPE_3; ?>" data-title="SUB BAGIAN, DOKUMENTASI HUKUM DAN PENYULUHAN HUKUM">
                            Lihat Hasil Survei <i class="fa icon-next-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_survey" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_survey" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="survei_form">
                    <input type="hidden" name="tipe" id="tipe">

                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <label class="containerr">Sangat Baik
                                        <input type="radio" name="nilai" checked="checked" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="containerr">Baik
                                        <input type="radio" name="nilai" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="containerr">Cukup
                                        <input type="radio" name="nilai" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="containerr">Buruk
                                        <input type="radio" name="nilai" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="containerr">Sangat Buruk
                                        <input type="radio" name="nilai" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 0px;">
                                    <div style="padding: 10px;">
                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Anda">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="theam_btn" id="survei_btn" style="display: block; width: 100%;">Survei</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hasil_prokum" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-prokum close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="chart-container">
                    <canvas id="chart_prokum" style="margin-left: auto; margin-right: auto;"></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="theam_btn" id="survei_btn" style="display: block; width: 100%;">Survei</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hasil_bagkum" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-bagkum close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="chart-container">
                    <canvas id="chart_bagkum" style="margin-left: auto; margin-right: auto;"></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="theam_btn" id="survei_btn" style="display: block; width: 100%;">Survei</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hasil_dokkum" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-dokkum close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="chart-container">
                    <canvas id="chart_dokkum" style="margin-left: auto; margin-right: auto;"></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="theam_btn" id="survei_btn" style="display: block; width: 100%;">Survei</button>
            </div>
        </div>
    </div>
</div>