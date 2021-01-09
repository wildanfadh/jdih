<script>
    $(document).ready(function() {
        $('#text_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
        });

        $("#tambah_text").click(function() {
            window.location.href = "<?php echo base_url("Menu/tambah_text_jalan") ?>";
        });

        $(".edit").click(function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Menu/ubah_text_jalan?id="); ?>" + id;
        });
    });
</script>