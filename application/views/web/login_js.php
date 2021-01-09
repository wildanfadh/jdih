<script type="text/javascript">
    $(document).ready(function() {
        $("#form_login").submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url("Login/login_proc") ?>",
                type: "post",
                data: $("#form_login").serialize(),
                beforeSend: function(x) {
                    // $(".loading").show();
                },
                success: function(data) {
                    // $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Cek lagi username dan password Anda.",
                            "error"
                        );
                    } else {
                        window.location.href = "<?php echo base_url("Dashboard") ?>";
                    }
                }
            });
        });
    });
</script>