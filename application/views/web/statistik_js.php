<script type="text/javascript">
    $(document).ready(function() {
        var table = $("#jenis").DataTable({
            "bInfo": false,
            "bFilter": false,
            "bLengthChange": false,
            "bPaginate": false,
            "bSort": false,
        });

        var table = $("#status").DataTable({
            "bInfo": false,
            "bFilter": false,
            "bLengthChange": false,
            "bPaginate": false,
            "bSort": false,
        });

        $(".view-pdf").click(function() {
            var id = $(this).data("id");
            var file = $(this).data("file");
            var upload = $(this).data("status");

            $("#modal_pdf").show();
            if (upload == "1") {
                var path = "<?php echo base_url("uploads"); ?>";
            } else {
                var path = "<?php echo base_url("backup/app/datapdf"); ?>";
            }

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });

        $(".close").click(function() {
            $("#modal_pdf").hide();
        });
    });
</script>