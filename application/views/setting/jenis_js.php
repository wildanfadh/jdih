<script>
    $(document).ready(function() {
        $('#jenis_tab').DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            "columnDefs": [{
                "visible": false, // hide the main grouping head rows trigger
                "targets": 1
            }, ],
            "drawCallback": function(settings) {
                // this function using for grouping rows
                var api = this.api();
                var last = null;
                var rows = api.rows({
                    page: 'current'
                }).nodes();

                api.column(1, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group bg-info"><td colspan="3" style="padding-left: 10px !important;">' + group + '</td></tr>'
                        );

                        last = group;
                    }
                });
            }
        });

        $("#tambah_jenis").click(function() {
            window.location.href = "<?php echo base_url("Setting/tambah_jenis") ?>";
        });

        $(".edit").click(function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/ubah_jenis?id="); ?>" + id;
        });

        $(".delete").click(function() {
            var id = $(this).data("id");
            window.location.href = "<?php echo base_url("Setting/hapus_jenis?id="); ?>" + id;
        });
    });
</script>