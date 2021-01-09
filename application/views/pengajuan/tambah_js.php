<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('[data-mask]').inputmask();

        $('#file_word').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_word')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $('#file_excel').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_excel')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $('#file_surat').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_surat')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $('#file_tambahan').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_tambahan')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $("#jenis").change(function() {
            var jenis = $(this).val();

            if (jenis == <?php echo JENP_PERWALI ?>) {
                $(".file-tambahan").removeClass("hide");
            } else {
                $(".file-tambahan").addClass("hide");
            }
        });

        $("#tambah_pengajuan").submit(function(event) {
            event.preventDefault();

            var form_data = new FormData($("#tambah_pengajuan")[0]);
            var check = [
                "judul",
                "nama",
                "jabatan",
                "nomor",
                "jumlah",
                "jenis",
                "file_word",
                "file_surat",
            ];

            if ($("#jenis").val() == <?php echo JENP_PERWALI ?>) {
                check.push("file_tambahan");
            }

            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Pengajuan/tambah"); ?>",
                    type: "post",
                    data: form_data,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 1) {
                            Swal.fire(
                                'Sukses!',
                                'Pengajuan Produk Hukum telah ditambahkan.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Pengajuan"); ?>";
                            });
                        } else if (data == 2) {
                            Swal.fire(
                                "Error!",
                                "Upload Pengajuan Produk gagal.",
                                "error"
                            );
                        } else if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Pengajuan Produk Hukum gagal ditambahkan.",
                                "error"
                            );
                        }
                    }
                });
            } else {
                directView();
            }
        });
    });
</script>