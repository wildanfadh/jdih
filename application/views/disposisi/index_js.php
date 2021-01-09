<script>
    $(document).ready(function() {
        $("#tab_disposisi").DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [0, 'asc']
            ],
            "ajax": {
                "url": "<?php echo base_url("Pengajuan/disposisi_ajax?id_penyusunan=" . $penyusunan); ?>",
                "type": "POST"
            },
            "deferRender": true,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "id_to"
                },
                {
                    "data": "is_kordinasikan"
                },
                {
                    "data": "is_selesaikan"
                },
                {
                    "data": "is_tindak_lanjuti"
                },
                {
                    "data": "is_proses_ketentuan"
                },
                {
                    "data": "is_laporan"
                },
                {
                    "data": "is_bicarakan"
                },
                {
                    "data": "status"
                },
                {
                    "data": "perihal"
                },
                {
                    "data": "keterangan"
                },
                {
                    "data": "aksi"
                },
            ],
        });


        $(document).on("click", ".disposisi", function() {
            // $(".em-error").hide();
            // $(".form-control").removeClass("is-invalid");

            var id = $(this).data("id");
            var idTo = $(this).data("to");
            var penyusunan = $(this).data("penyusunan");

            $("#id").val(id);
            $("#idTo").val(idTo);
            $("#penyusunan").val(penyusunan);
        });

         
        $("input#keterangan").click(function(){
            if($(this).prop("checked") == true){
							$(".txtKeterangan").removeClass("hide");
							var keterangan = 1;
            }
            else if($(this).prop("checked") == false){
							$(".txtKeterangan").addClass("hide");
							var keterangan = 0;
            }
        });

        $("#status").change(function() {
            var getStatus = $(this).val();

            if (getStatus == 1) {
                $("#id_to").removeClass("hide");
                var idTo = $("#idTo").val();
                var asisten = $(".asisten");
                var sekda = $(".sekda");
                var walikota = $(".walikota");
                var kabag = $(".kabag");

                if (idTo == <?php echo DUM_ASISTEN ?>) {
                    $
                }

            } else {
                $("#id_to").addClass("hide");
            }
        });

        $(".form-disposisi").submit(function(data) {
                    data.preventDefault();
             

				var form_data = new FormData($("#form-disposisi")[0]);
                var id = $("#id").val();

                

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("Pengajuan/save_disposisi"); ?>",
                    // data: 
                    //     "status=" + status+ 
					// 	"&id=" + id+ 
					// 	"&penyusunan=" + penyusunan+ 
					// 	"&kordinasikan=" + kordinasikan+ 
					// 	"&selesaikan=" + selesaikan+ 
					// 	"&tindak=" + tindak+ 
					// 	"&proses=" + proses+ 
					// 	"&laporan=" + laporan+ 
					// 	"&bicarakan=" + bicarakan+ 
					// 	"&ket=" + keterangan+ 
					// 	"&perihal=" + perihal+ 
					// 	"&BoxKeterangan=" + keterangan,
					data: form_data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                       alert("sucess");
                    }
                });

                window.location.href = "<?php echo base_url("Pengajuan/disposisi_list?id_penyusunan=" . $penyusunan) ?>";
            });   

     

    });
</script>