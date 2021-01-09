<script>
    $(document).ready(function() {
        $('#file_upload').change(function() {
            var i = $(this).prev('label').clone();
            // var file = $('#file_upload')[0].files[0].name;
            // $(this).prev('label').text(file);

            if ($('#file_upload')[0].files.length != 0) {
                var file = $('#file_upload')[0].files[0].name;
                $(this).prev('label').text(file);
                $("#file_change").val("1");
            } else {
                $(this).prev('label').text("Pilih File");
                $("#file_change").val("0");
            }
        });

        $("#ganti_file").click(function() {
            $("#file_upload").attr("disabled", false);
            $("#file_upload").click();
        });

        $("#is_upload").change(function() {
            $("#upload_file").hide();
            $("#select_file").hide();

            if ($('input#is_upload').is(':checked')) {
                $("#upload_file").show();
            } else {
                $("#select_file").show();
            }
        });

        $("#tambah_tupoksi").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#tambah_tupoksi")[0]);

            var check = ["tahun"];
            if ($("#file_change").val() != "2") {
                check.push("file_upload");
            }

            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Setting/ubah_tupoksi"); ?>",
                    type: "post",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Tupoksi gagal diubah.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Tupoksi telah diubah.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Setting/tupoksi"); ?>";
                            });
                        }
                    }
                });
            }
        });
    });
</script>