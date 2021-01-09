<script>
    $(document).ready(function() {

        $(".text-summer").summernote({
            width: 1500,
            height: 300,
            // airMode: true,
            disableDragAndDrop: true,
            placeholder: 'Tulis Pesan Disini...',
            toolbar: [
                // ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                // ['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                // ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                // ['table', ['table']],
                // ['insert', ['link']],
                // ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        });

        // Summernote Modal
        $(".text-summer-modal").summernote({
            width: 1500,
            height: 300,
            disableDragAndDrop: true,
            toolbar: [
                // ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                // ['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                // ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                // ['table', ['table']],
                // ['insert', ['link']],
                // ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        });

        $(".kirim").click(function() {
            $(".input-message").submit();
        });

        $(document).scrollTop($(document).height());

        // $(".input-message").submit(function(event) {
        //     event.preventDefault();
        //     var id = $("#konsultasi").val();
        //     var form_data = new FormData($(".input-message")[0]);
        //     // console.log(form_data);
        //     var check = ["message_chat"];
        //     if (checkThis(check) == 0) {
        //         $.ajax({
        //             url: "<?php echo base_url("Konsultasi/addchat?konsultasi="); ?>" + id,
        //             type: "post",
        //             data: form_data,
        //             processData: false,
        //             contentType: false,
        //             // beforeSend: function(x) {
        //             //     $(".loading").show();
        //             // },
        //             success: function() {
        //                 location.reload();
        //             }
        //         });
        //     } else {
        //         directView();
        //     }
        // });


        $(".input-message").submit(function(event) {
            event.preventDefault();
            var id = $("#konsultasi").val();
            var form_data = new FormData($(".input-message")[0]);

            var check = ["message_chat"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Konsultasi/addchat?konsultasi="); ?>" + id,
                    type: "post",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0 || $("#user").val() == "") {
                            Swal.fire(
                                "Error!",
                                "Pesan gagal dikirim.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Pesan telah dikirim.',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                directView();
            }
        });


        $(".note-editable").on('click', function() {
            $(".note-btn-bold").removeClass("active");
        });

        $(".note-editable").on('change', 'input', function() {
            $(".note-btn-bold").removeClass("active");
        });


        // $("#button-addon2").on('click', function(event) {
        //     event.preventDefault();
        //     var el = $(this);
        //     el.prop('disabled', true);
        //     setTimeout(function() {
        //         el.prop('disabled', false);
        //     }, 3000);
        // });

        $("#kirim-chat").on('click', function(event) {
            event.preventDefault();
            var el = $(this);
            el.prop('disabled', true);
            setTimeout(function() {
                el.prop('disabled', false);
            }, 3000);
        });

        var parent = $('#body-message'),
            child = parent.children('#text-message');

        if (child.height() > parent.height()) {
            parent.height(child.height());
            // can also use parent.height('auto');
        }



        $(document).on("click", "#accepted", function(event) {
            event.preventDefault();
            var id = $(this).data("id");
            var konsultasi = $(this).data("konsul");
            // var konsultasi = $("#konsultasi").val();

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda ingin mengizinkan Pesan ini!",
                type: "warning",
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, izinkan Pesan ini!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url("Konsultasi/confir_chat?chat="); ?>" + id + "&konsultasi=" + konsultasi,
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


        $(document).on("click", "#edit", function() {
            $(".em-error").hide();
            // $(".form-control").removeClass("is-invalid");

            var id = $(this).data("id");
            var pesan = $(this).data("pesan");

            $("#mod_id").val(id);
            // $("#mod-message").val(pesan);
            $("#mod_message").summernote('code', pesan);

        });


        $("#kirim-chat-modal").click(function() {
            $(".update-chat").submit();
        });

        $(".update-chat").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($(".update-chat")[0]);

            var check = ["mod_message"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Konsultasi/updatechat"); ?>",
                    type: "post",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0 || $("#user").val() == "") {
                            Swal.fire(
                                "Error!",
                                "Pesan gagal di ubah.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Pesan telah di ubah.',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                directView();
            }
        });


        $(document).on("click", "#rejected", function(event) {
            event.preventDefault();
            var id = $(this).data("id");
            var konsultasi = $(this).data("konsul");
            // var konsultasi = $("#konsultasi").val();

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda ingin menolak Pesan ini!",
                type: "warning",
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tolak Pesan ini!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url("Konsultasi/reject_chat?chat="); ?>" + id + "&konsultasi=" + konsultasi,
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


        $(document).on("click", ".end", function(event) {
            event.preventDefault();
            var id = $(this).data("id");

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda ingin mengakhiri Konsultasi ini!",
                type: "warning",
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Akhiri Konsultasi ini!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url("Konsultasi/end_konsul?konsultasi="); ?>" + id,
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
                                    'Anda telah mengakhiri Konsultasi ini.',
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




    });
</script>