<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><?= $title; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="timeline timeline-chat">
                        <div class="time-label mb-5" style="margin-top: 0px;">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <span class="bg-info judul-chat">
                                        <h4><i class="far fa-comment"></i> Persoalan :
                                            <?php echo $konsultasi["subject"] ?>
                                        </h4>
                                    </span>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <span class="bg-info user-chat float-right mr-5">
                                        <h4><i class="far fa-user"></i> Dari :
                                            SKPD (
                                            <?php echo $konsultasi["nama"] ?> )
                                        </h4>
                                        <h4><i class="far fa-user"></i> Kepada :
                                            <?php if ($konsultasi["id_to_group"] == PERM_KABAG) { ?>
                                                Kepala Bagian
                                            <?php } elseif ($konsultasi["id_to_group"] == PERM_PERUNDANGAN) { ?>
                                                Sub Perundang Undangan
                                            <?php } elseif ($konsultasi["id_to_group"] == PERM_DOKUM) { ?>
                                                Sub Dokumen Hukum
                                            <?php } elseif ($konsultasi["id_to_group"] == PERM_BANKUM) { ?>
                                                Sub Bantuan Hukum
                                            <?php } ?>
                                        </h4>
                                    </span>
                                </div>
                            </div>


                        </div>

                        <?php
                        $usr = $konsultasi["created_by"];
                        if ($this->session->userdata("user_id") == $usr) { ?>

                            <!-- Pesan Kanan -->
                            <div class="row">
                                <div class="col-md-11 col-sm-11 col-xs-11">
                                    <div class="card card-msg float-right">
                                        <div class="card-header card-header-msg">
                                            <span class="float-left time-chat"><i class="fas fa-clock"></i>
                                                <?php echo $konsultasi["created_date"] ?> </span>
                                            <h6 class="float-right">
                                                <a href="">
                                                    SKPD (
                                                    <?php echo $konsultasi["nama"] ?> ) </a>
                                            </h6>
                                        </div>
                                        <div class="card-body" id="body-message">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <strong class="float-right">
                                                        <?php echo $konsultasi["message"] ?></strong>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    <button type="button" class="btn btn-primary btn-user">
                                        <i class="far fa-user"></i>
                                    </button>
                                </div>
                            </div>

                        <?php } else { ?>


                            <!-- Pesan Kiri -->
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    <button type="button" class="btn btn-primary float-right btn-user">
                                        <i class="far fa-user"></i>
                                    </button>
                                </div>
                                <div class="col-md-11 col-sm-11 col-xs-11">
                                    <div class="card card-msg">
                                        <div class="card-header card-header-msg">
                                            <span class="float-right time-chat"><i class="fas fa-clock"></i>
                                                <?php echo $konsultasi["created_date"] ?> </span>
                                            <h6>
                                                <a href="">
                                                    SKPD (
                                                    <?php echo $konsultasi["nama"] ?> ) </a>
                                            </h6>
                                        </div>
                                        <div class="card-body" id="body-message">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <strong>
                                                        <?php echo $konsultasi["message"] ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>



                        <!-- Load semua pesan disini -->

                        <?php foreach ($chat as $ch) { ?>


                            <?php
                            $group = $ch["id_group"];
                            $usr = $ch["id_from"];
                            if ($this->session->userdata("user_id") == $usr) { ?>



                                <!-- Pesan Kanan -->
                                <div class="row">
                                    <div class="col-md-11 col-sm-11 col-xs-11">

                                        <?php if ($ch["status"] == 1) { ?>
                                            <div class="card card-msg float-right">
                                            <?php } elseif ($ch["status"] == 2) { ?>

                                                <?php if ($this->session->userdata("group") == PERM_SKPD) { ?>
                                                    <div class="card card-msg float-right hide" id="confir-message">
                                                    <?php } else { ?>
                                                        <div class="card card-msg float-right" id="confir-message">
                                                        <?php } ?>

                                                    <?php } else { ?>

                                                        <?php if ($this->session->userdata("group") == PERM_SKPD) { ?>
                                                            <div class="card card-msg float-right hide" id="confir-message">
                                                            <?php } else { ?>
                                                                <div class="card card-msg float-right" id="confir-message">
                                                                <?php } ?>

                                                            <?php } ?>

                                                            <div class="card-header card-header-msg">
                                                                <span class="float-left time-chat"><i class="fas fa-clock"></i>
                                                                    <?php echo $ch["created_date"] ?> </span>
                                                                <h6 class="float-right">
                                                                    <?php if ($group == PERM_SKPD) { ?>
                                                                        <a href="">
                                                                            SKPD (
                                                                            <?php echo $ch["nama"] ?> ) </a>
                                                                    <?php } else { ?>
                                                                        <a href="">
                                                                            <?php echo $ch["nama"] ?> </a>
                                                                    <?php } ?>
                                                                </h6>
                                                            </div>
                                                            <div class="card-body" id="body-message">
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <?php $grp = $this->session->userdata("group"); ?>
                                                                        <?php if (!in_array($grp, array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                            <div class="corfirmation">
                                                                                <?php if ($ch["status"] == 1) { ?>

                                                                                    <?php if (in_array($grp, array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                                        <button type="button" class="btn btn-xs btn-success hide"><i class="fas fa-check"></i></button>
                                                                                    <?php } else { ?>
                                                                                        <button type="button" class="btn btn-xs btn-success"><i class="fas fa-check"></i></button>
                                                                                    <?php } ?>

                                                                                <?php } elseif ($ch["status"] == 2) { ?>

                                                                                    <?php if (in_array($grp, array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                                        <button type="button" class="btn btn-xs btn-danger hide"><i class="fas fa-exclamation-circle"></i></button>
                                                                                    <?php } else { ?>
                                                                                        <button type="button" class="btn btn-xs btn-danger"><i class="fas fa-exclamation-circle"></i></button>
                                                                                    <?php } ?>

                                                                                <?php } else { ?>

                                                                                    <?php if ($grp == PERM_KABAG) { ?>
                                                                                        <button type="button" class="btn btn-xs btn-success" id="accepted" data-id='<? echo $ch["id"] ?>' data-konsul='<? echo $konsultasi["id"] ?>'><i class="fas fa-check"></i></button>
                                                                                        <button type="button" class="btn btn-xs btn-danger" id="rejected" data-id='<? echo $ch["id"] ?>' data-konsul='<? echo $konsultasi["id"] ?>'><i class="fas fa-exclamation-circle"></i></button>
                                                                                    <?php } else { ?>
                                                                                        <button type="button" class="btn btn-xs btn-warning"><i class="fas fa-exclamation-circle"></i></button>
                                                                                    <?php } ?>

                                                                                <?php } ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <strong class="float-right" id="text-message">
                                                                            <?php echo $ch["message"] ?></strong>
                                                                    </div>
                                                                </div>



                                                            </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1 col-sm-1 col-xs-1">

                                                                <!-- untuk menentukan warna icon user -->
                                                                <?php
                                                                if ($group == PERM_KABAG) {
                                                                    $bg = "btn-success";
                                                                } elseif ($group == PERM_PERUNDANGAN) {
                                                                    $bg = "btn-danger";
                                                                } elseif ($group == PERM_DOKUM) {
                                                                    $bg = "bg-purple";
                                                                } elseif ($group == PERM_BANKUM) {
                                                                    $bg = "btn-warning";
                                                                } else {
                                                                    $bg = "btn-primary";
                                                                }
                                                                ?>

                                                                <?php if ($ch["status"] == 1) { ?>
                                                                    <button type="button" class="btn <?php echo $bg ?> btn-user">
                                                                        <i class="far fa-user"></i>
                                                                    </button>
                                                                <?php } elseif ($ch["status"] == 2) { ?>

                                                                    <?php if (in_array($this->session->userdata("group"), array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                        <button type="button" class="btn btn-secondary hide btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-secondary btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } ?>

                                                                <?php } else { ?>

                                                                    <?php if (in_array($this->session->userdata("group"), array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                        <button type="button" class="btn btn-secondary hide btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-secondary btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } ?>

                                                                <?php } ?>

                                                            </div>
                                                        </div>


                                                    <?php } else { ?>


                                                        <!-- Pesan Kiri -->
                                                        <div class="row">
                                                            <div class="col-md-1 col-sm-1 col-xs-1">

                                                                <!-- untuk menentukan warna icon user -->
                                                                <?php
                                                                if ($group == PERM_KABAG) {
                                                                    $bg = "btn-success";
                                                                } elseif ($group == PERM_PERUNDANGAN) {
                                                                    $bg = "btn-danger";
                                                                } elseif ($group == PERM_DOKUM) {
                                                                    $bg = "bg-purple";
                                                                } elseif ($group == PERM_BANKUM) {
                                                                    $bg = "btn-warning";
                                                                } else {
                                                                    $bg = "btn-primary";
                                                                }
                                                                ?>

                                                                <?php if ($ch["status"] == 1) { ?>
                                                                    <button type="button" class="btn <?php echo $bg ?> float-right btn-user">
                                                                        <i class="far fa-user"></i>
                                                                    </button>
                                                                <?php } elseif ($ch["status"] == 2) { ?>

                                                                    <?php if (in_array($this->session->userdata("group"), array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                        <button type="button" class="btn btn-secondary hide float-right btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-secondary float-right btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } ?>

                                                                <?php } else { ?>

                                                                    <?php if (in_array($this->session->userdata("group"), array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                        <button type="button" class="btn btn-secondary hide float-right btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-secondary float-right btn-user">
                                                                            <i class="far fa-user"></i>
                                                                        </button>
                                                                    <?php } ?>

                                                                <?php } ?>

                                                            </div>
                                                            <div class="col-md-11 col-sm-11 col-xs-11">
                                                                <!-- <div class="card card-msg"> -->

                                                                <?php if ($ch["status"] == 1) { ?>
                                                                    <div class="card card-msg">
                                                                    <?php } elseif ($ch["status"] == 2) { ?>

                                                                        <?php if (in_array($this->session->userdata("group"), array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                            <div class="card card-msg hide" id="confir-message">
                                                                            <?php } else { ?>
                                                                                <div class="card card-msg " id="confir-message">
                                                                                <?php } ?>

                                                                            <?php } else { ?>

                                                                                <?php if (in_array($this->session->userdata("group"), array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                                    <div class="card card-msg hide" id="confir-message">
                                                                                    <?php } else { ?>
                                                                                        <div class="card card-msg " id="confir-message">
                                                                                        <?php } ?>

                                                                                    <?php } ?>

                                                                                    <div class="card-header card-header-msg">
                                                                                        <span class="float-right time-chat"><i class="fas fa-clock"></i>
                                                                                            <?php echo $ch["created_date"] ?> </span>
                                                                                        <h6>
                                                                                            <?php if ($group == PERM_SKPD) { ?>
                                                                                                <a href="">
                                                                                                    SKPD (
                                                                                                    <?php echo $ch["nama"] ?> ) </a>
                                                                                            <?php } else { ?>
                                                                                                <a href="">
                                                                                                    <?php echo $ch["nama"] ?> </a>
                                                                                            <?php } ?>
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="card-body" id="body-message">
                                                                                        <div class="row">
                                                                                            <div class="col-md-8 col-sm-8">
                                                                                                <strong id="text-message">
                                                                                                    <?php echo $ch["message"] ?></strong>
                                                                                            </div>
                                                                                            <div class="col-md-4 col-sm-4">
                                                                                                <?php $grp = $this->session->userdata("group"); ?>
                                                                                                <?php if (!in_array($grp, array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                                                    <div class="corfirmation float-right">
                                                                                                        <?php if ($ch["status"] == 1) { ?>

                                                                                                            <?php if (in_array($grp, array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                                                                <button type="button" class="btn btn-xs btn-success hide"><i class="fas fa-check"></i></button>
                                                                                                            <?php } else { ?>
                                                                                                                <button type="button" class="btn btn-xs btn-success"><i class="fas fa-check"></i></button>
                                                                                                            <?php } ?>

                                                                                                        <?php } elseif ($ch["status"] == 2) { ?>
                                                                                                            <?php if (in_array($grp, array(PERM_SKPD, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                                                                                                                <button type="button" class="btn btn-xs btn-danger hide"><i class="fas fa-exclamation-circle"></i></button>
                                                                                                            <?php } else { ?>
                                                                                                                <button type="button" class="btn btn-xs btn-danger"><i class="fas fa-exclamation-circle"></i></button>
                                                                                                            <?php } ?>

                                                                                                        <?php } else { ?>

                                                                                                            <?php if ($grp == PERM_KABAG) { ?>
                                                                                                                <button type="button" class="btn btn-xs btn-success" id="accepted" data-id='<?php echo $ch["id"] ?>' data-konsul='<?php echo $konsultasi["id"] ?>'><i class="fas fa-check"></i></button>
                                                                                                                <button type="button" class="btn btn-xs btn-danger" id="rejected" data-id='<?php echo $ch["id"] ?>' data-konsul='<?php echo $konsultasi["id"] ?>'><i class="fas fa-exclamation-circle"></i></button>
                                                                                                            <?php } else { ?>
                                                                                                                <button type="button" class="btn btn-xs btn-warning"><i class="fas fa-exclamation-circle"></i></button>
                                                                                                            <?php } ?>

                                                                                                        <?php } ?>
                                                                                                    </div>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            <?php } ?>

                                                                        <?php } ?>


                                                                        <!-- Message for Live -->






                                                                            </div>

                                                                            <div class="content-input-message">
                                                                                <?php $_usr = $this->session->userdata("user_id"); ?>
                                                                                <?php $group = $this->session->userdata("group"); ?>
                                                                                <?php if ($konsultasi["is_end"] == 0) { ?>
                                                                                    <?php if ($konsultasi["id_from"] == $_usr || $konsultasi["id_to"] == $_usr) { ?>
                                                                                        <form class="input-message">
                                                                                            <input type="hidden" name="konsultasi" id="konsultasi" value='<?php echo $konsultasi["id"] ?>'>
                                                                                            <input type="hidden" name="from" id="from" value="<?php echo $_usr ?>">
                                                                                            <input type="hidden" name="group" id="group" value="<?php echo $group ?>">
                                                                                            <input type="hidden" name="nama" id="nama" value="<?php echo $group ?>">
                                                                                            <input type="hidden" name="created" id="created" value="<?php echo $_usr ?>">
                                                                                            <!-- <div class="input-group mb-3">
                                                                                                <label for="message"> <small id="err_subject" class="em-error">(Pesan harus diisi jika ingin mengirim)</small></label>
                                                                                                <input type="text" class="form-control" name="message" id="message" placeholder="Pesan disini" aria-label="Pesan disini" aria-describedby="button-addon2" onkeyup="validateThis(this);" onchange="validateThis(this);" autofocus>
                                                                                                <div class="input-group-append">
                                                                                                    <button class="btn btn-outline-primary kirim" type="button" id="button-addon2"> Kirim <i class="far fa-paper-plane"></i></button>
                                                                                                </div>
                                                                                            </div> -->
                                                                                            <div class="form-group input-group">
                                                                                                <label for="message"><small id="err_message" class="em-error">(Pesan harus diisi)</small></label>
                                                                                                <textarea id="message" name="message" class="form-control text-summer" onkeyup="validateThis(this);" onchange="validateThis(this);" placeholder="Pesan disini..." autofocus style="width: 100%;">
                                                                                                </textarea>
                                                                                            </div>
                                                                                            <button type="button" class="btn btn-primary kirim" id="kirim-chat"><i class="far fa-envelope"></i> Kirim</button>
                                                                                        </form>
                                                                                    <?php } else { ?>
                                                                                        <!-- <?php if ($konsultasi["id_to_group"] == PERM_RESEPSIONIS) { ?>
                                                                                            <form class="update-chat">
                                                                                                <input type="hidden" name="konsultasi" id="konsultasi" value='<?php echo $konsultasi["id"] ?>'>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-3">
                                                                                                        <button type="submit" class="btn btn-outline-primary mb-1" id="update-chat-submit">Teruskan ke Kabag</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                            <p class="bg-warning text-center mb-1">Anda tidak diizinkan memberi pesan kecuali yang bersangkutan</p>

                                                                                        <?php } else { ?> -->
                                                                                        <p class="bg-warning text-center">Anda tidak diizinkan memberi pesan kecuali yang bersangkutan</p>
                                                                                        <!-- <?php } ?> -->
                                                                                    <?php } ?>
                                                                                <?php } else { ?>
                                                                                    <p class="bg-success text-center">Konsultasi ini sudah Berakhir</p>
                                                                                <?php } ?>
                                                                            </div>

                                                                    </div>
                                                            </div>




                                                        </div>
    </section>
</div>