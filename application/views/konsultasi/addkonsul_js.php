<script>
    $(document).ready(function() {
        $(".text-summer").summernote({
            height: 300,
            toolbar: [
                // ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                // ['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                // ['color', ['color']],
                // ['para', ['ol', 'ul', 'paragraph', 'height']],
                // ['table', ['table']],
                // ['insert', ['link']],
                // ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        });

        $("#kirim").click(function() {
            $("#tambah_konsultasi").submit();
        });

        $("#tambah_konsultasi").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#tambah_konsultasi")[0]);

            var check = ["user", "nama", "subject", "jabatan", "message"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Konsultasi/addkonsul"); ?>",
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
                                "Konsultasi gagal dikirim.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Konsultasi telah dikirim.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Konsultasi/konsultasi_list"); ?>";
                            });
                        }
                    }
                });
            } else {
                directView();
            }
        });

        $("#user").change(function() {
            var sasaran = $(this).find(':selected').data("group");

            $("#idtogroup").val(sasaran);
        });


    });
</script>