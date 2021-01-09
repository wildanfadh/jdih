<script>
    $(document).ready(function() {
        $("#tambah_text").submit(function(event) {
            event.preventDefault();

            var check = ["urut", "text"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Menu/tambah_text_jalan"); ?>",
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