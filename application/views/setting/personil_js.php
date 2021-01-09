<script>
    $(document).ready(function() {
        $('#personal_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_personil").click(function() {
            window.location.href = "<?php echo base_url("Setting/tambah_personil?id=" . $id_profil) ?>";
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/ubah_personil?id="); ?>" + id;
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "<?php echo base_url("Setting/hapus_personil?id="); ?>" + id,
                type: "get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Personil gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'Personil telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Setting/personil?id=" . $_GET["id"]); ?>";
                        });
                    }
                }
            })
        });
    });
</script>