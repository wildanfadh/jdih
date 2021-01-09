<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $('#file_upload').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_upload')[0].files[0].name;
            $(this).prev('label').text(file);
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
                    url: "<?php echo base_url("Menu/tambah_promperda"); ?>",
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
                                "Promperda gagal ditambahkan.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Promperda telah ditambahkan.',
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