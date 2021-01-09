<script>
    $(document).ready(function() {
        // $('[data-toggle="tooltip"]').tooltip();
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
            ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax": {
                "url": "<?php echo $url; ?>", // URL file untuk proses select datanya
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

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda ingin mengizinkan Pesan ini!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, izinkan Pesan ini!'
            }).then((result) => {
                if (result) {
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
                                    "Proses gagal dilakukan.",
                                    "error"
                                );
                            } else if (data == "1") {
                                Swal.fire(
                                    'Diizinkan!',
                                    'Anda telah mengizinkan Pesan ini.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            });
        });

        $(document).on("click", ".reject", function() {
            var id = $(this).data("id");

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda ingin menolak Pesan ini!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tolak Pesan ini!'
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: "<?php echo base_url("Konsultasi/permite_reject?konsultasi="); ?>" + id,
                        type: "get",
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == 0) {
                                Swal.fire(
                                    "Error!",
                                    "Proses gagal dilakukan.",
                                    "error"
                                );
                            } else if (data == "1") {
                                Swal.fire(
                                    'Diizinkan!',
                                    'Anda telah menolak Pesan ini.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            });
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
                            // window.location.href = "<?php echo base_url("Konsultasi"); ?>";
                            location.reload();
                        });
                    }
                }
            })
        });
    });
</script>