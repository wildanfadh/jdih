<script>
    $(document).ready(function() {
        $("#tambah_skpd").submit(function(event) {
            event.preventDefault();

            var check = ["nama"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Skpd/tambah"); ?>",
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
                                "SKPD gagal ditambahkan.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'SKPD telah ditambahkan.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Skpd"); ?>";
                            });
                        }
                    }
                });
            }
        });
    });
</script>