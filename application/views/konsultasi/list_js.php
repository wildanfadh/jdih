<script>
    $(document).ready(function() {
        // $("body").tooltip({
        //     selector: "[data-toggle='tooltip']"
        // });

        // <?php if ($group != PERM_SKPD) { ?>
        var asc = 5;
        var target = 6;
        var sort = 'desc';
        // <?php } else { ?>
        //     var asc = 4;
        //     var target = 5;
        //     var sort = 'asc';
        // <?php } ?>
        // $(".row-aksi").removeClass("sorting");
        // $(".row-aksi").css("display", "none");

        $('#konsultasi_tab').DataTable({
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [
                [5, 'desc']
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 6,
            }, ],

            "ajax": {
                "url": "<?php echo $url; ?>",
                "type": "POST"
            },
            "deferRender": true,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "jabatan"
                },
                {
                    "data": "to"
                },
                {
                    "data": "subject"
                },
                {
                    "data": "status"
                },
                // <?php if ($group != PERM_SKPD) { ?>
                // <?php } ?> 
                {
                    "data": "aksi"
                },
            ],
        });

        // var tab_url = "<?php echo base_url("Konsultasi/index_chat_ajax"); ?>";


        $("#daftar_select").change(function() {
            var status = $(this).val();
            // var opd = $("#opd_select").val();

            $("#konsultasi_tab").DataTable().ajax.url("<?= base_url("Konsultasi/index_chat_ajax?to="); ?>" + status).load();
        });


        $(document).on("click", ".view", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Konsultasi/chat?konsultasi="); ?>" + id;
        });

        // $(document).on("click", ".end", function() {
        //     var id = $(this).data("id");
        //     window.location.href = "<?php echo base_url("Konsultasi/end_konsul?konsultasi="); ?>" + id;
        // });

        $(document).on("click", ".delete", function(event) {
            event.preventDefault();
            var id = $(this).data("id");

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda ingin hapus Konsultasi ini!",
                type: "warning",
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Konsultasi ini!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url("Konsultasi/hapusKonsul?konsultasi="); ?>" + id,
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
                                    'Berhasil!',
                                    'Anda telah menghapus Konsultasi ini.',
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



        // $(document).on("click", ".delete", function() {
        //     var id = $(this).data("id");

        //     $.ajax({
        //         url: "<?php echo base_url("Konsultasi/hapus?konsultasi="); ?>" + id,
        //         type: "get",
        //         beforeSend: function(x) {
        //             $(".loading").show();
        //         },
        //         success: function(data) {
        //             $(".loading").hide();

        //             if (data == 0) {
        //                 Swal.fire(
        //                     "Error!",
        //                     "Pesan gagal dihapus.",
        //                     "error"
        //                 );
        //             } else {
        //                 Swal.fire({
        //                     title: 'Apakah Anda Yakin?',
        //                     text: "Anda ingin menghapus Konsultasi ini!",
        //                     type: "warning",
        //                     showCancelButton: true,
        //                     confirmButtonColor: '#3085d6',
        //                     cancelButtonColor: '#d33',
        //                     confirmButtonText: 'Ya, Hapus Pesan ini!'
        //                 }).then((result) => {
        //                     if (result.isConfirmed) {
        //                         Swal.fire(
        //                             'Dihapus!',
        //                             'Anda telah menghapus Konsultasi ini.',
        //                             'success'
        //                         )
        //                     }
        //                 });
        //             }
        //         }
        //     })
        // });


    });
</script>