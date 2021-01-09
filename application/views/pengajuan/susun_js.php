<script>
    $(document).ready(function() {
        var count = 1;
        var prokum = 0;

        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $(document).on("click", ".view-pdf", function() {
            var file = $(this).data("file");

            $("#modal_pdf").modal("show");
            var path = "<?php echo base_url("uploads/PENGAJUAN_PROKUM"); ?>";

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });

        $(".close").click(function() {
            $("#modal_pdf").hide();
        });

        $(".download").click(function(event) {
            event.preventDefault();
            var file = $(this).data("file");

            url = "<?php echo base_url("uploads/PENGAJUAN_PROKUM/"); ?>" + file;
            window.open(url, "_blank");
        });

        $(document).on("change", ".input-keterangan", function() {
            var i = $(this).prev('label').clone();
            var id = $(this).data("id");

            var file = $("#file_keterangan_" + id)[0].files[0].name;

            $(this).prev('label').text(file);
        });

        $("#jumlah_change").click(function() {
            var jumlah = parseInt($("#jumlah").val());
            var output = "";
            var input = jumlah;

            jumlah += count;
            prokum = prokum + input;

            $("#err_jumlah").hide();
            // if (prokum <= <?= $pengajuan["jumlah_prokum"]; ?>) {

            // } else {
            //     $("#err_jumlah").show();
            // }

            for (var i = count; i < jumlah; i++) {
                output += '<div class="card card-save card-' + i + '" data-urut="' + i + '">';
                output += '<div class="card-header">';
                // output += '<label class="card-title" for="susun_"' + i + '>Detail Penyusunan Produk Hukum</label>';

                // TITLE
                output += '<div class="row">';
                output += '<div class="col-md-11">';
                // output += '<label for="susun_"' + i + '>Detail Penyusunan Produk Hukum <span class="">' + i + '</span></label>';
                output += '<label for="susun_' + i + '" style="margin-bottom: 0px;">Detail Penyusunan Produk Hukum</label>';
                output += '</div>';
                output += '<div class="col-md-1 text-right">';
                output += '<button class="btn btn-danger btn-xs delete" data-jumlah="' + i + '"><i class="fas fa-times"></i></button>';
                output += '</div>';
                output += '</div>';
                output += '</div>';

                output += '<div class="card-body">';

                // output += '<div class="row">';
                // output += '<div class="col-md-11">';
                // // output += '<label for="susun_"' + i + '>Detail Penyusunan Produk Hukum <span class="">' + i + '</span></label>';
                // output += '<label for="susun_"' + i + '>Detail Penyusunan Produk Hukum</label>';
                // output += '</div>';
                // output += '<div class="col-md-1 text-right">';
                // output += '<button class="btn btn-danger btn-xs delete" data-jumlah="' + i + '"><i class="fas fa-times"></i></button>';
                // output += '</div>';
                // output += '</div>';
                // output += '<hr>';

                // ROW
                output += '<div class="row">';
                // INPUT JUDUL
                output += '<div class="col-md-6">';
                output += '<div class="form-group">';
                output += '<label for="judul_"' + i + '>Judul <small id="err_judul_' + i + '" class="em-error">(Judul harus diisi)</small></label>';
                output += '<input type="text" class="form-control" id="judul_' + i + '" name="judul[]" placeholder="Judul" onkeyup="validateThis(this);" onchange="validateThis(this);">';
                output += '</div>';
                output += '</div>';

                // SELECT STATUS
                output += '<div class="col-md-6">';
                output += '<div class="form-group">';

                output += '<label for="status_' + i + '">Status Penyusunan <small id="err_status_' + i + '" class="em-error">(Status Penyusunan harus dipilih)</small></label>';
                output += '<select class="custom-select input-status" id="status_' + i + '" data-urut="' + i + '" name="status[]" onchange="validateThis(this);">';
                output += '<option value="">-- Pilih Status Penyusunan</option>';
                output += '<option value="<?php echo PENYUSUNAN_DRAFT; ?>">Diproses</option>';
                output += '<option value="<?php echo PENYUSUNAN_KEMBALI; ?>">Dikembalikan</option>';
                output += '</select>';
                output += '</div>';
                output += '</div>';

                output += '</div>';
                // ROW

                // ROW
                output += '<div class="row">';

                // INPUT KETERANGAN
                output += '<div class="col-md-6">';
                output += '<div class="form-group">';
                output += '<label for="keterangan_"' + i + '>Keterangan <small id="err_keterangan_' + i + '" class="em-error">(Keterangan harus diisi)</small></label>';
                output += '<textarea class="form-control" id="keterangan_' + i + '" name="keterangan[]" placeholder="Keterangan" onkeyup="validateThis(this);" onchange="validateThis(this);" style="resize: vertical;"></textarea>';
                output += '</div>';
                output += '</div>';

                output += '<div class="col-md-6 hide" id="div_file_keterangan_' + i + '">';
                output += '<div class="form-group">';
                output += '<label for="file_keterangan_' + i + '">File Keterangan <small id="err_file_keterangan_' + i + '" class="em-error">(File Keterangan harus dipilih)</small></label>';

                output += '<div class="custom-file">';
                output += '<label class="custom-file-label" for="file_keterangan_' + i + '">Pilih File Keterangan Pengembalian</label>';
                output += '<input type="file" class="custom-file-input input-keterangan" data-id="' + i + '" id="file_keterangan_' + i + '" name="file[]" accept=".pdf" onchange="validateThis(this);">';
                output += '</div>';
                output += '</div>';
                output += '</div>';


                output += '</div>';
                // ROW

                output += '</div>';
                output += '</div>';

                count++;
            }

            $(".append-here").append(output);
            $("#jumlah").val("");

            prokum = $(".card-save").length;
            console.log(prokum);
        });

        $(document).on("change", ".input-status", function() {
            var urut = $(this).data("urut");
            if ($(this).val() == <?= PENYUSUNAN_KEMBALI ?>) {
                $("#div_file_keterangan_" + urut).show();
            } else {
                $("#div_file_keterangan_" + urut).hide();
            }
        });

        $(document).on("click", ".delete", function() {
            var jumlah = $(this).data("jumlah");
            prokum--;

            $(".card-" + jumlah).remove()
        });

        $("#btn_simpan").click(function() {
            var check = [];
            $(".card-save").each(function(index) {
                var urut = $(this).data("urut");
                check.push("judul_" + urut);
                check.push("status_" + urut);
                check.push("keterangan_" + urut);
            });

            if (checkThis(check) == 0) {
                $("#form_save").submit();
            } else {
                directView();
            }
        });

        $("#form_save").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#form_save")[0]);

            $.ajax({
                url: "<?php echo base_url("Pengajuan/penyusunan?pengajuan=" . $pengajuan["id"]); ?>",
                type: "post",
                data: form_data,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                processData: false,
                contentType: false,
                success: function(data) {
                    $(".loading").hide();

                    if (data == 1) {
                        Swal.fire(
                            'Sukses!',
                            'Penyusunan Produk Hukum telah berhasil.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Pengajuan/penyusunan_list?pengajuan=" . $pengajuan["id"]); ?>";
                        });
                    } else {
                        Swal.fire(
                            "Error!",
                            "Penyusunan Produk Hukum gagal dilakukan.",
                            "error"
                        );
                    }
                }
            });
        });
    });
</script>