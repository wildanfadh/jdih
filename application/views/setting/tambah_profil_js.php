<script>
    $(document).ready(function() {
        $('[data-mask]').inputmask();
        uploadCrop = $("#upload_demo").croppie({
            enableExif: false,
            showZoomer: true,
            enforceBoundary: true,
            boundary: {
                width: 400,
                height: 430
            },
            viewport: {
                width: 331,
                height: 407,
            },
        });

        $("#crop-image").click(function() {
            if ($("#upload").val() != "") {
                uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: {
                        width: 331,
                        height: 407,
                    }
                }).then(function(croppedImage) {
                    $("#upload_demo_res").attr('src', croppedImage);

                    // $("#upload_demo_div").hide();
                    // $("#upload_demo_res_div").show();
                });
            }
        });

        $(document).on("change", "[type=file]", function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                    $(input).replaceWith($(input).clone())
                }

                reader.readAsDataURL(input.files[0]);
            }

            var filename = this.files[0].name;
            $("#label_upload").html(filename);

            // $("#upload_demo_res_div").hide();
            // $("#upload_demo_div").show();
        });

        function checkVisiMisi() {
            var visi = $(".visi");
            var misi = $(".misi");

            $("#err_visi").hide();
            $("#err_misi").hide();

            var error = 0;
            if (visi.length == 0) {
                $("#err_visi").show();
                error++;
            } else {
                visi.each(function(key, elem) {
                    if ($(elem).val() == "") {
                        $("#err_visi").show();
                        error++;
                    }
                });
            }

            if (misi.length == 0) {
                $("#err_misi").show();
                error++;
            } else {
                misi.each(function(key, elem) {
                    if ($(elem).val() == "") {
                        $("#err_misi").show();
                        error++;
                    }
                });
            }

            if (error > 0) {
                return false;
            } else {
                return true;
            }
        }

        // VISI
        $("#add_visi").click(function() {
            var jumlah = $("#num_visi").val();
            var temp_count = $("#count_visi").val();

            if (jumlah != "") {
                jumlah = parseInt(jumlah) + parseInt(temp_count);
                var tr = "";
                for (var i = temp_count; i < jumlah; i++) {
                    tr += "<tr id='visi_" + i + "'>";
                    tr += "<td>";
                    tr += "<input class='form-control visi' name='visi[]' data-tipe='visi' onkeyup='validateThisTipe(this);' onchange='validateThisTipe(this);'>";
                    tr += "</td>";
                    tr += "<td>";
                    tr += "<button type='button' class='btn btn-sm btn-danger delete-visi' data-id='" + i + "'><i class='fa fa-minus'></i></buton>";
                    tr += "</td>";
                    tr += "</tr>";
                }

                $("#tbody_visi").append(tr);
                $("#count_visi").val(jumlah);
            }
        });

        $(document).on("click", "button.delete-visi", function() {
            var id = $(this).attr("data-id");
            $("#visi_" + id).remove();
        });
        // VISI

        // MISI
        $("#add_misi").click(function() {
            var jumlah = $("#num_misi").val();
            var temp_count = $("#count_misi").val();

            if (jumlah != "") {
                jumlah = parseInt(jumlah) + parseInt(temp_count);
                var tr = "";
                for (var i = temp_count; i < jumlah; i++) {
                    tr += "<tr id='misi_" + i + "'>";
                    tr += "<td>";
                    tr += "<input class='form-control misi' name='misi[]' data-tipe='misi' onkeyup='validateThisTipe(this);' onchange='validateThisTipe(this);'>";
                    tr += "</td>";
                    tr += "<td>";
                    tr += "<button type='button' class='btn btn-sm btn-danger delete-misi' data-id='" + i + "'><i class='fa fa-minus'></i></buton>";
                    tr += "</td>";
                    tr += "</tr>";
                }

                $("#tbody_misi").append(tr);
                $("#count_misi").val(jumlah);
            }
        });

        $(document).on("click", "button.delete-misi", function() {
            var id = $(this).attr("data-id");
            $("#misi_" + id).remove();
        });
        // MISI

        $("#tambah_profil").submit(function(event) {
            event.preventDefault();
            var check = ["walikota", "periode_awal", "upload"];
            var check2 = checkVisiMisi();
            if (checkThis(check) == 0 && check2) {
                uploadCrop.croppie("result", "blob").then(function(blob) {
                    var form_data = new FormData($("#tambah_profil")[0]);
                    form_data.append("blob", blob);

                    $.ajax({
                        url: "<?php echo base_url("Setting/tambah_profil"); ?>",
                        type: "post",
                        data: form_data,
                        processData: false,
                        contentType: false,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == 0) {
                                Swal.fire(
                                    "Error!",
                                    "Profil gagal ditambahkan.",
                                    "error"
                                );
                            } else {
                                Swal.fire(
                                    'Sukses!',
                                    'Profil telah ditambahkan.',
                                    'success'
                                ).then((result) => {
                                    window.location.href = "<?php echo base_url("Setting/profil"); ?>";
                                });
                            }
                        }
                    });
                });
            } else {
                directView();
            }
        });
    });
</script>