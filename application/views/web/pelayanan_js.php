<script type="text/javascript">
    /* Custom filtering function which will search data in column four between two values */
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = parseInt($('#min').val(), 10);
            var max = parseInt($('#max').val(), 10);
            var age = parseFloat(data[3]) || 0; // use data for the age column

            if ((isNaN(min) && isNaN(max)) || (isNaN(min) && age <= max) ||
                (min <= age && isNaN(max)) || (min <= age && age <= max)) {
                return true;
            }
            return false;
        }
    );

    $(".view-pdf").click(function() {
        var file = $(this).data("file");

        $("#modal_pdf").show();
        var path = "<?php echo base_url("uploads/PROPEMPERDA"); ?>";

        PDFObject.embed(path + "/" + file, "#view_pdf");
    });

    $(".close").click(function() {
        $("#modal_pdf").hide();
    });

    $(document).ready(function() {
        var table = $("#daftar").DataTable({
            "bFilter": false,
        });

       

        // Event listener to the two range filtering inputs to redraw on input
        $('#min, #max').keyup(function() {
            table.draw();
        });
    });
</script>