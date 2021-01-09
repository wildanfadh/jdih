<script type="text/javascript">
    $(document).ready(function() {
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                // label: "asd",
                // labels: ["Perda", "Perwali", "Kepwali", "Instruksi Walikota", "Peraturan Bersama Walikota", "Peraturan DPRD"],
                // labels: [
                //     <?php foreach ($chart as $val) { ?> "<?php echo $val["label"]; ?>", <?php } ?>
                // ],
                datasets: [
                    <?php foreach ($chart as $val) {
                    ?> {
                            label: "<?php echo $val["label"]; ?>",
                            backgroundColor: "<?php echo $val["backgroundColor"]; ?>",
                            borderColor: "<?php echo $val["borderColor"]; ?>",
                            borderWidth: 1,
                            data: [parseInt(<?php echo json_encode($val["data"]); ?>)],
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
                        // label: function(tooltipItem, data) {
                        //     var label = "";
                        //     $.each(data.datasets, function(key, value) {
                        //         if (value.data == tooltipItem.yLabel) {
                        //             label = value.label;
                        //             return false;
                        //         }
                        //     });

                        //     return label + ": " + tooltipItem.yLabel;
                        // },
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
                title: {
                    display: false,
                    text: "Grafik Produk Hukum Pemerintah Kota Mojokerto"
                },
                // elements: {
                //     point: {
                //         radius: 0,
                //         hitRadius: 5,
                //         hoverRadius: 3,
                //     },
                // },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        },
                        ticks: {
                            // display: false,
                            beginAtZero: true,
                            userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                            stepSize: 1,
                        }
                        // ticks: {
                        //     beginAtZero: true,
                        //     // callback: function(value) {
                        //     //     // if (Number.isInteger(value)) {
                        //     //     //     return value;
                        //     //     // }

                        //     //     return parseInt(value);
                        //     // },
                        //     callback: function(value) {
                        //         if (value % 1 === 0) {
                        //             return value;
                        //         }
                        //     },
                        //     stepSize: 1,
                        // },
                    }],
                    xAxes: [{
                        ticks: {
                            display: false,
                            showLabelBackdrop: false,
                        },
                    }],
                },
            }
        });
    });
</script>