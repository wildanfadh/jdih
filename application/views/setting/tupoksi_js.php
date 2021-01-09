<script>
    $(document).ready(function() {
        $('#tupoksi_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_tupoksi").click(function() {
            window.location.href = "<?php echo base_url("Setting/tambah_tupoksi") ?>";
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/ubah_tupoksi?id="); ?>" + id;
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "<?php echo base_url("Setting/hapus_tupoksi?id="); ?>" + id,
                type: "get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Profil gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'Profil telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Setting/tupoksi"); ?>";
                        });
                    }
                }
            })
        });

        $(".organ").click(function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/personil?id="); ?>" + id;
        });
    });
</script>