<script type="text/javascript">
    $(document).ready(function() {
        var path = "<?php echo base_url("uploads"); ?>";
        var file = "<?php echo $tupoksi["file"]; ?>"
        PDFObject.embed(path + "/" + file, "#view_pdf");
    });
</script>