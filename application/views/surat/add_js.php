<script>
    $(document).ready(function() {
        $('[data-mask]').inputmask();

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

            var check = ["no_surat", "tentang", "surat_pengajuan", "draft_prokum"];
            if (checkThis(check) == 0) {
                if (!$('#err_surat_pengajuan').is(':visible') && !$('#err_draft_prokum').is(':visible')) {
                    $.ajax({
                        url: "<?php echo base_url("Surat/tambah"); ?>",
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