<script>
    $(document).ready(function() {
        $("#tambah_jenis").submit(function(event) {
            event.preventDefault();

            var check = ["tipe", "nama", "singkatan"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Setting/tambah_jenis"); ?>",
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
                                "Jenis Produk Hukum gagal ditambahkan.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Jenis Produk Hukum telah ditambahkan.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Setting/jenis"); ?>";
                            });
                        }
                    }
                });
            }
        });
    });
</script>