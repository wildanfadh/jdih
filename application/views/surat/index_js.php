<script>
    $(document).ready(function() {
        $('#skpd_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_surat").click(function() {
            window.location.href = "<?php echo base_url("Surat/tambah") ?>";
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Surat/ubah?surat="); ?>" + id;
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            $.ajax({
                url:"<?php echo base_url("Surat/hapus?surat="); ?>" + id,
                type:"get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Surat gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'Surat telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Surat"); ?>";
                        });
                    }
                }
            })
        });
    });
</script>