/* ------------------------------------------------------------------------------
 *
 *  # Echarts - bars and tornados
 *
 *  Bars and tornados chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {

    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: 'assets/js/plugins/visualization/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------

            var basic_bars = ec.init(document.getElementById('basic_bars'), limitless);

            // Charts setup
            // ------------------------------

            //
            // Basic bars options
            //

            basic_bars_options = {

                // Setup grid
                grid: {
                    x: 75,
                    x2: 35,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },

                // Add legend
                legend: {
                    data: ['Year 2013', 'Year 2014']
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'value',
                    boundaryGap: [0, 0.01]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'category',
                    data: ['Germany','France','Spain','Netherlands','Belgium']
                }],

                // Add series
                series: [
                    {
                        name: 'Year 2013',
                        type: 'bar',
                        itemStyle: {
                            normal: {
                                color: '#EF5350'
                            }
                        },
                        data: [38203, 73489, 129034, 204970, 331744]
                    },
                    {
                        name: 'Year 2014',
                        type: 'bar',
                        itemStyle: {
                            normal: {
                                color: '#66BB6A'
                            }
                        },
                        data: [39325, 83438, 131000, 221594, 334141]
                    }
                ]
            };

            // Apply options
            // ------------------------------

            basic_bars.setOption(basic_bars_options);

            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
                    basic_bars.resize();
                }, 200);
            }
        }
    );
});
