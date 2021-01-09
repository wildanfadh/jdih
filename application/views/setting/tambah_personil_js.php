<script>
    $(document).ready(function() {
        uploadCrop = $("#upload_demo").croppie({
            enableExif: false,
            showZoomer: true,
            enforceBoundary: true,
            boundary: {
                width: 430,
                height: 430
            },
            viewport: {
                width: 391,
                height: 382,
            },
        });

        $("#posisi").change(function() {
            var val = $(this).val();

            $("#upload_demo").remove();
            uploadCrop = null;
            $("#upload_demo_div").append("<div id='upload_demo'></div>");

            if (val == "4") {
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
            } else {
                uploadCrop = $("#upload_demo").croppie({
                    enableExif: false,
                    showZoomer: true,
                    enforceBoundary: true,
                    boundary: {
                        width: 430,
                        height: 430
                    },
                    viewport: {
                        width: 391,
                        height: 382,
                    },
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
        });

        $("#tambah_personil").submit(function(event) {
            event.preventDefault();

            var check = ["nama", "posisi", "jabatan", "upload"];
            if (checkThis(check) == 0) {
                uploadCrop.croppie("result", "blob").then(function(blob) {
                    var form_data = new FormData($("#tambah_personil")[0]);
                    form_data.append("blob", blob);

                    $.ajax({
                        url: "<?php echo base_url("Setting/tambah_personil"); ?>",
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
                                    window.location.href = "<?php echo base_url("Setting/personil?id=" . $id_profil); ?>";
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