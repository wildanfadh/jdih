<script>
    $(document).ready(function() {
        $('#jenis_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            "iDisplayLength": -1
        });

        $("#tambah_prokum").click(function() {
            window.location.href = "<?php echo base_url("Prokum/tambah?tipe=" . $tipe["full"]) ?>";
        });

        // $(".edit").click(function() {
        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Prokum/ubah?tipe=" . $tipe["full"] . "&id="); ?>" + id;
        });

        // $(".delete").click(function() {
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Prokum/hapus?tipe=" . $tipe["full"] . "&id="); ?>" + id;
        });
    });
</script>