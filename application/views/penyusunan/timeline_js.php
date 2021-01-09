<script>
    $(document).ready(function() {
        $(document).on("click", ".view-pdf", function() {
            var file = $(this).data("file");

            $("#modal_pdf").modal("show");
            var path = "<?php echo base_url("uploads/PENGAJUAN_PROKUM"); ?>";

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });

        $(document).on("click", ".view", function() {
            var urut = $(this).data("urut");
            var judul = $(this).data("judul");
            var status = $(this).data("status");
            var keterangan = $(this).data("keterangan");

            $("#view_header").html(urut);
            $("#view_judul").html(judul);
            $("#view_status").html(status);
            $("#view_keterangan").html(keterangan);
        });
    });
</script>