<script>
    $(document).ready(function() {
        $('#kabinet_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_lemari").click(function() {
            window.location.href = "<?php echo base_url("Setting/tambah_lemari") ?>";
        });

        $(".edit").click(function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/ubah_lemari?id="); ?>" + id;
        });

        $(".delete").click(function() {
            var id = $(this).data("id");
            $.ajax({
                url: "<?php echo base_url("Setting/hapus_lemari?id="); ?>" + id,
                type: "get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Lemari Arsip gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'Lemari Arsip telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Setting/lemari"); ?>";
                        });
                    }
                }
            })
        });
    });
</script>