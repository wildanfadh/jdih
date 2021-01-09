<script type="text/javascript">
    $(document).ready(function() {
        var table = $("#daftar").DataTable({
            "bInfo": false,
            "bFilter": false,
            "bLengthChange": false,
            "sDom": '<"top"ip><"clear">'
        });

        var cari = $("#cari").DataTable({
            "bInfo": false,
            "bFilter": false,
            "bLengthChange": false,
            "bPaginate": false,
            "bSort": false,
        });

        $("#btn_cari").click(function() {
            var nomor = $("#nomor").val();
            var tahun = $("#tahun").val();
            var tentang = $("#tentang").val();
            var filter = "&nomor=" + nomor + "&tahun=" + tahun + "&tentang=" + tentang;

            <?php if (isset($_GET["jenis"])) { ?>
                window.location.href = "<?php echo base_url("Daftar?search2=1&jenis=" . $_GET["jenis"]); ?>" + filter;
            <?php } else { ?>
                window.location.href = "<?php echo base_url("Daftar?search2=1&jenis=all"); ?>" + filter;
            <?php } ?>
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