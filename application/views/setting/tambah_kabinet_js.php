<script>
    $(document).ready(function() {
        $("#tambah_jenis").submit(function(event) {
            event.preventDefault();

            var check = ["macam", "keterangan", "posisi"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Setting/tambah_lemari"); ?>",
                    type: "post",
                    data: $(this).serialize(),
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Lemari Arsip gagal ditambahkan.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Lemari Arsip telah ditambahkan.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Setting/lemari"); ?>";
                            });
                        }
                    }
                });
            }
        });
    });
</script>