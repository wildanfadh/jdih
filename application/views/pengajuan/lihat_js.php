<!--PDF Object-->
<script src="<?php echo base_url("assets") ?>/js/pdfobject.min.js"></script>

<script>
    $(document).ready(function() {
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
    });
</script>