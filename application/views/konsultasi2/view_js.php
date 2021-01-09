<script>
    $(document).ready(function() {
        $("#reply").click(function() {
            window.location.href = "<?php echo base_url("Konsultasi/balas?konsultasi=" . $konsultasi["id"]); ?>"
        });

        $("#delete").click(function() {
            var id = $(this).data("id");

            $.ajax({
                url: "<?php echo base_url("Konsultasi/hapus?konsultasi=". $konsultasi["id"]); ?>",
                type: "get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Pesan gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'Pesan telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Konsultasi"); ?>";
                        });
                    }
                }
            })
        });
    });
</script>