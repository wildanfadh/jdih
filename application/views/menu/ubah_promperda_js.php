<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $("#ganti_file").click(function() {
            $("#file_upload").attr("disabled", false);
            $("#file_upload").click();
        });

        $('#file_upload').change(function() {
            var i = $(this).prev('label').clone();

            if ($('#file_upload')[0].files.length != 0) {
                var file = $('#file_upload')[0].files[0].name;
                $(this).prev('label').text(file);
                $("#file_change").val("1");
            } else {
                $(this).prev('label').text("Pilih File");
                $("#file_change").val("0");
            }
        });

        $("#form_add").submit(function(event) {
            event.preventDefault();

            var form_data = new FormData($("#form_add")[0]);
            var check = ["tahun", "keterangan"];
            if ($('input#is_upload').is(':checked')) {
                check.push("file_upload");
            } else {
                check.push("file_select");
            }

            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Menu/ubah_promperda"); ?>",
                    type: "post",
                    data: form_data,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Promperda gagal diubah.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Promperda telah diubah.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Menu/promperda"); ?>";
                            });
                        }
                    }
                });
            }
        });
    });
</script>