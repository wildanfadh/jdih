<script type="text/javascript">
    $(document).ready(function() {
        $(".close_survey").click(function() {
            $("#modal_survey").modal("toggle");
        });

        $(".close-prokum").click(function() {
            $("#hasil_prokum").modal("toggle");
        });

        $(".close-bagkum").click(function() {
            $("hasil_bagkum").modal("toggle");
        });

        $(".close-dokkum").click(function() {
            $("hasil_dokkum").modal("toggle");
        });

        $(".survey-btn").click(function() {
            var title = $(this).data("title");
            var tipe = $(this).data("tipe");

            $(".modal-title").html(title);
            $("#tipe").val(tipe);

            $("#modal_survey").modal("toggle");
            $("#nama").val();
        });

        $(".hasil-btn").click(function() {
            var tipe = $(this).data("tipe").toLowerCase();
            var title = $(this).data("title");

            $("#hasil_" + tipe).modal("toggle");
            $(".modal-title").html(title);
        });

        $("#survei_btn").click(function() {
            var nama = $("#nama");
            if (nama.val() == "") {
                nama.attr("placeholder", "Kolom Nama harus diisi");
                nama.addClass("error");
            } else {
                $("#survei_form").submit();
            }
        });

        $("#nama").keyup(function() {
            $(this).removeClass("error");

            if ($(this).val() == "") {
                $(this).attr("placeholder", "Kolom Nama harus diisi");
                $(this).addClass("error");
            }
        });

        $("#survei_form").submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url("Web/save_survei") ?>",
                type: "post",
                data: $(this).serialize(),
                beforeSend: function(x) {
                    // $(".loading").show();
                },
                success: function(data) {
                    // $(".loading").hide();
                    $("#modal_survey").modal("toggle");

                    if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Mohon Maaf, sistem sedang dalam perbaikan.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            "Sukses!",
                            "Terima Kasih atas survei yang Anda berikan.",
                            "success"
                        ).then((result) => {
                            if (result.value) {
                                window.location.href = "<?php echo base_url(); ?>";
                            }
                        })
                    }
                }
            });
        });

        var prokum = document.getElementById("chart_prokum").getContext('2d');
        var myChart = new Chart(prokum, {
            type: 'bar',
            data: {
                datasets: [
                    <?php foreach ($prokum as $val) {
                        ?> {
                            label: "<?php echo $val["label"]; ?>",
                            backgroundColor: "<?php echo $val["backgroundColor"]; ?>",
                            borderColor: "<?php echo $val["borderColor"]; ?>",
                            borderWidth: 1,
                            data: "<?php echo $val["data"]; ?>",
                        },
                    <?php } ?>
                ]
            },
            options: {
                showAllTooltips: true,
                tooltips: {
                    custom: function(tooltip) {
                        if (!tooltip) return;
                        // disable displaying the color box;
                        // tooltip.displayColors = false;
                    },
                    callbacks: {
                        // use label callback to return the desired label
                        label: function(tooltipItem, data) {
                            var label = "";
                            $.each(data.datasets, function(key, value) {
                                if (value.data == tooltipItem.yLabel) {
                                    label = value.label;
                                    return false;
                                }
                            });

                            return label + ": " + tooltipItem.yLabel;
                        },
                        // remove title
                        title: function(tooltipItem, data) {
                            return;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                    },
                    onClick: () => {}, // disable legend onClick functionality that filters datasets
                },
                responsive: true,
                elements: {
                    point: {
                        radius: 0,
                        hitRadius: 5,
                        hoverRadius: 3,
                    },
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }],
                }
            }
        });

        var bagkum = document.getElementById("chart_bagkum").getContext('2d');
        var myChart = new Chart(bagkum, {
            type: 'bar',
            data: {
                datasets: [
                    <?php foreach ($bagkum as $val) {
                        ?> {
                            label: "<?php echo $val["label"]; ?>",
                            backgroundColor: "<?php echo $val["backgroundColor"]; ?>",
                            borderColor: "<?php echo $val["borderColor"]; ?>",
                            borderWidth: 1,
                            data: "<?php echo $val["data"]; ?>",
                        },
                    <?php } ?>
                ]
            },
            options: {
                showAllTooltips: true,
                tooltips: {
                    custom: function(tooltip) {
                        if (!tooltip) return;
                        // disable displaying the color box;
                        // tooltip.displayColors = false;
                    },
                    callbacks: {
                        // use label callback to return the desired label
                        label: function(tooltipItem, data) {
                            var label = "";
                            $.each(data.datasets, function(key, value) {
                                if (value.data == tooltipItem.yLabel) {
                                    label = value.label;
                                    return false;
                                }
                            });

                            return label + ": " + tooltipItem.yLabel;
                        },
                        // remove title
                        title: function(tooltipItem, data) {
                            return;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                    },
                    onClick: () => {}, // disable legend onClick functionality that filters datasets
                },
                responsive: true,
                elements: {
                    point: {
                        radius: 0,
                        hitRadius: 5,
                        hoverRadius: 3,
                    },
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }],
                }
            }
        });

        var dokkum = document.getElementById("chart_dokkum").getContext('2d');
        var myChart = new Chart(dokkum, {
            type: 'bar',
            data: {
                datasets: [
                    <?php foreach ($dokkum as $val) {
                        ?> {
                            label: "<?php echo $val["label"]; ?>",
                            backgroundColor: "<?php echo $val["backgroundColor"]; ?>",
                            borderColor: "<?php echo $val["borderColor"]; ?>",
                            borderWidth: 1,
                            data: "<?php echo $val["data"]; ?>",
                        },
                    <?php } ?>
                ]
            },
            options: {
                showAllTooltips: true,
                tooltips: {
                    custom: function(tooltip) {
                        if (!tooltip) return;
                        // disable displaying the color box;
                        // tooltip.displayColors = false;
                    },
                    callbacks: {
                        // use label callback to return the desired label
                        label: function(tooltipItem, data) {
                            var label = "";
                            $.each(data.datasets, function(key, value) {
                                if (value.data == tooltipItem.yLabel) {
                                    label = value.label;
                                    return false;
                                }
                            });

                            return label + ": " + tooltipItem.yLabel;
                        },
                        // remove title
                        title: function(tooltipItem, data) {
                            return;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                    },
                    onClick: () => {}, // disable legend onClick functionality that filters datasets
                },
                responsive: true,
                elements: {
                    point: {
                        radius: 0,
                        hitRadius: 5,
                        hoverRadius: 3,
                    },
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }],
                }
            }
        });
    });
</script>