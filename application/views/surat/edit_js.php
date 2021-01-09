<script>
    $(document).ready(function() {
        $('[data-mask]').inputmask();

        $("#label_surat").click(function() {
            window.open("<?php echo base_url("uploads/" . TIPE_4 . "/" . $surat["surat_pengajuan"]) ?>", '_blank');
        });

        $("#is_change_surat").click(function() {
            if ($(this).is(":checked")) {
                $("#up_surat").show();
                $("#cur_surat").hide();
            } else {
                $("#up_surat").hide();
                $("#cur_surat").show();
            }
        });

        $("#is_change_draft").click(function() {
            if ($(this).is(":checked")) {
                $("#up_draft").show();
                $("#cur_draft").hide();
            } else {
                $("#up_draft").hide();
                $("#cur_draft").show();
            }
        });

        $('#surat_pengajuan').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#surat_pengajuan')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $('#draft_prokum').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#draft_prokum')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $("#tambah_surat").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#tambah_surat")[0]);

            var check = ["no_surat", "tentang"];
            if ($("#is_change_surat").is(":checked")) {
                check.push("surat_pengajuan");
            }

            if ($("#is_change_draft").is(":checked")) {
                check.push("draft_prokum");
            }

            if (checkThis(check) == 0) {
                if (!$('#err_surat_pengajuan').is(':visible') && !$('#err_draft_prokum').is(':visible')) {
                    $.ajax({
                        url: "<?php echo base_url("Surat/ubah?surat=" . $surat["id"]); ?>",
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
                                    "Surat Pengajuan gagal ditambahkan.",
                                    "error"
                                );
                            } else {
                                Swal.fire(
                                    'Sukses!',
                                    'Surat Pengajuan telah ditambahkan.',
                                    'success'
                                ).then((result) => {
                                    window.location.href = "<?php echo base_url("Surat"); ?>";
                                });
                            }
                        }
                    });
                }
            } else {
                directView();
            }
        });
    });
</script>