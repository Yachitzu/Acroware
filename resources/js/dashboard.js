(function($) {
    'use strict';
    $(function() {
      if ($("#floor-managers-chart").length) {
        // Datos del gráfico, ejemplo con 3 encargados de áreas
        var areaData = {
          labels: ["Encargado 1", "Encargado 2", "Encargado 3"],
          datasets: [{
              data: [40, 35, 25], // Porcentajes de cada encargado
              backgroundColor: [
                 "#4B49AC", "#FFC100", "#248AFD",
              ],
              borderColor: "rgba(0,0,0,0)"
            }
          ]
        };
        var areaOptions = {
          responsive: true,
          maintainAspectRatio: true,
          segmentShowStroke: false,
          cutoutPercentage: 78,
          elements: {
            arc: {
                borderWidth: 4
            }
          },      
          legend: {
            display: false
          },
          tooltips: {
            enabled: true
          },
          legendCallback: function(chart) { 
            var text = [];
            var total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
            text.push('<div class="report-chart">');
            chart.data.labels.forEach((label, index) => {
              var value = chart.data.datasets[0].data[index];
              text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[index] + '"></div><p class="mb-0">' + label + '</p></div>');
              text.push('<p class="mb-0">' + value + '%</p>');
              text.push('</div>');
            });
            text.push('</div>');
            return text.join("");
          },
        }
        var floorManagersChartPlugins = {
          beforeDraw: function(chart) {
            var width = chart.chart.width,
                height = chart.chart.height,
                ctx = chart.chart.ctx;
        
            ctx.restore();
            var fontSize = 3.125;
            ctx.font = "500 " + fontSize + "em sans-serif";
            ctx.textBaseline = "middle";
            ctx.fillStyle = "#13381B";
        
            var text = chart.data.datasets[0].data.reduce((a, b) => a + b, 0),
                textX = Math.round((width - ctx.measureText(text).width) / 2),
                textY = height / 2;
        
            ctx.fillText(text, textX, textY);
            ctx.save();
          }
        }
        var floorManagersChartCanvas = $("#floor-managers-chart").get(0).getContext("2d");
        var floorManagersChart = new Chart(floorManagersChartCanvas, {
          type: 'doughnut',
          data: areaData,
          options: areaOptions,
          plugins: floorManagersChartPlugins
        });
        document.getElementById('floor-managers-legend').innerHTML = floorManagersChart.generateLegend();
      }
    });
})(jQuery);
