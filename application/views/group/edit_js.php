<script>
    $(document).ready(function() {
        $("#tambah_group").submit(function(event) {
            event.preventDefault();

            var check = ["name","description"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Group/ubah?group=".$group["id"]); ?>",
                    type: "post",
                    data: $(this).serialize(),
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Group gagal diubah.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Group telah diubah.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Group"); ?>";
                            });
                        }
                    }
                });
            }
        });
    });
</script>