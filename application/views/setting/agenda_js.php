<script>
    $(document).ready(function() {
        $('#agenda_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_agenda").click(function() {
            window.location.href = "<?php echo base_url("Setting/tambah_agenda") ?>";
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/ubah_agenda?id="); ?>" + id;
        });

        // $(".delete").click(function() {
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "<?php echo base_url("Setting/hapus_agenda?id="); ?>" + id,
                type: "get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "agenda Arsip gagal dihapus.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'agenda Arsip telah dihapus.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Setting/agenda"); ?>";
                        });
                    }
                }
            })
        });
    });
</script>