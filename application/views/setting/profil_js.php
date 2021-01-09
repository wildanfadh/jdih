<script>
    $(document).ready(function() {
        $('#profil_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_profil").click(function() {
            window.location.href = "<?php echo base_url("Setting/tambah_profil") ?>";
        });

        $(".edit").click(function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/ubah_profil?id="); ?>" + id;
        });

        $(".delete").click(function() {
            var id = $(this).data("id");
            $.ajax({
                url: "<?php echo base_url("Setting/hapus_profil?id="); ?>" + id,
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
                            window.location.href = "<?php echo base_url("Setting/profil"); ?>";
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