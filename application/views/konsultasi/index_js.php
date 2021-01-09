<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: "[data-toggle='tooltip']"
        });

        $('#konsultasi_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [
                [0, 'asc']
            ],
            "ajax": {
                "url": "<?php echo $url; ?>",
                "type": "POST"
            },
            "deferRender": true,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "subject"
                },
                {
                    "data": "aksi"
                },
            ],
        });

        $("#tambah_surat").click(function() {
            window.location.href = "<?php echo base_url("Surat/tambah") ?>";
        });

        $(document).on("click", ".view", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Konsultasi/lihat?konsultasi="); ?>" + id;
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Konsultasi/edit?konsultasi="); ?>" + id;
        });

        $(document).on("click", ".reply", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Konsultasi/balas?konsultasi="); ?>" + id;
        });

        $(document).on("click", ".permite", function() {
            var id = $(this).data("id");

            $.ajax({
                url: "<?php echo base_url("Konsultasi/permite_sent?konsultasi="); ?>" + id,
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

                        Swal.fire({
                            title: 'Apakah Anda Yakin?',
                            text: "Anda ingin mengizinkan Pesan ini!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, izinkan Pesan ini!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Diizinkan!',
                                    'Anda telah mengizinkan Pesan ini.',
                                    'success'
                                )
                            }
                        });

                        $("#checklist").attr({
                            "checked": "true",
                            "disabled": ""
                        });
                    }
                }
            })
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            $.ajax({
                url: "<?php echo base_url("Konsultasi/hapus?konsultasi="); ?>" + id,
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
                            location.reload();
                        });
                    }
                }
            })
        });
    });
</script>