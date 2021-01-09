<script type="text/javascript">
    $(document).ready(function() {
        $(".view-pdf").click(function() {
            var id = $(this).data("id");
            var file = $(this).data("file");
            var upload = $(this).data("status");

            $("#modal_pdf").show();
            var path = "";
            if (upload == "1") {
                path = "<?php echo base_url("uploads"); ?>";
            } else {
                path = "<?php echo base_url("backup/app/datapdf"); ?>";
            }

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });

        $(".close").click(function() {
            $("#modal_pdf").hide();
        });

        $("#search_prokum1").click(function() {
            var search = $("#search_text1").val();
            window.location.href = "<?php echo base_url("Daftar?search=") ?>" + search;
        });

        $("#search_prokum2").click(function() {
            var search = $("#search_text1").val();
            window.location.href = "<?php echo base_url("Daftar?search=") ?>" + search;
        });

        $("#search_prokum3").click(function() {
            var search = $("#search_text1").val();
            window.location.href = "<?php echo base_url("Daftar?search=") ?>" + search;
        });
    });
</script>