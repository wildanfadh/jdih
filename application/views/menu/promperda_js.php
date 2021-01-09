<script>
    $(document).ready(function() {
        $('#tab_data').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#btn_tambah").click(function() {
            window.location.href = "<?php echo base_url("Menu/tambah_promperda") ?>";
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");

            window.location.href = "<?php echo base_url("Menu/ubah_promperda?id="); ?>" + id;
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            $.ajax({
                url: "<?php echo base_url("Menu/delete_promperda?id="); ?>" + id,
                type: "get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Promperda gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'Promperda telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Menu/promperda"); ?>";
                        });
                    }
                }
            });
        });
    });
</script>