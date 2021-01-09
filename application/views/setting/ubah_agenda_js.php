<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $('[data-mask]').inputmask();

        $("#tambah_agenda").submit(function(event) {
            event.preventDefault();

            var form_data = new FormData($("#tambah_agenda")[0]);
            var check = [
                "judul",
                "isi",
                "waktu",
                "tg_mulai",
                "tg_selesai",
                "tempat",
            ];

            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Setting/ubah_agenda"); ?>",
                    type: "post",
                    data: form_data,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Agenda gagal diubah.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Agenda telah diubah.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Setting/agenda"); ?>";
                            });
                        }
                    }
                });
            } else {
                directView();
            }
        });
    });
</script>