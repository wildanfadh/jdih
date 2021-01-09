<script>
    $(document).ready(function() {
        $('#group_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_group").click(function() {
            window.location.href = "<?php echo base_url("Group/tambah") ?>";
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Group/ubah?group="); ?>" + id;
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            $.ajax({
                url:"<?php echo base_url("Skpd/delete?skpd="); ?>" + id,
                type:"get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "SKPD gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'SKPD telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Skpd"); ?>";
                        });
                    }
                }
            })
        });
    });
</script>