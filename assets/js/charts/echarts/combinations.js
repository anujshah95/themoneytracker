/* ------------------------------------------------------------------------------
 *
 *  # Echarts - chart combinations
 *
 *  Chart combination configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {

    $.ajax({
        type:'POST',
        data: {
            'resource': 'home_page',
        },
        url: baseURL+'category_analytics',
        success:function(html){
            var obj = jQuery.parseJSON(html);
            $.each(obj['category'], function(index,item){
                // console.log(item['cname']);
            });
            var cars = ["Saab", "Volvo", "BMW"];
            var person = [{firstName:"John",age:46}];
            // console.log(person);

            // alert(obj['cname']);
            // $('#support_name_error').html(obj['support_name']).addClass('form_validation_error');
            // $('#support_email_error').html(obj['support_email']).addClass('form_validation_error');
            // $('#support_message_error').html(obj['support_message']).addClass('form_validation_error');
            // $('#captcha_error').html(obj['invalid_captcha']).addClass('form_validation_error');
            // if(obj['success_message']){
            //     $('#support_success_message').html(obj['success_message']).addClass('alert alert-success').delay(10000).fadeOut();
            //     $('#support_name').val('');
            //     $('#support_email').val('');
            //     $('#support_message').val('');
            //     $('#captcha').val('');
            //     $('#type_support_captcha_code').html('Type this below "'+obj['new_captcha']+'"');
            //     $('#captcha_compare').val(obj['new_captcha']);
            // }
            // if(obj['error_message']){
            //     alert("Please try again.");
            //     location.reload();
            // }
        }
    });


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

        // Add necessary charts
        [
          'echarts',
          'echarts/theme/limitless',
          'echarts/chart/line',
          'echarts/chart/bar',
          'echarts/chart/pie',


          'echarts/chart/scatter',
          'echarts/chart/k',
          'echarts/chart/radar',
          'echarts/chart/gauge'
        ],


        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------
            var cars = ["Saab", "Volvo", "BMW"];
            var connect_pie = ec.init(document.getElementById('connect_pie'), limitless);
            var connect_column = ec.init(document.getElementById('connect_column'), limitless);
            // var cars = ec.init(cars, limitless);
            // console.log(cars);

            // Charts options
            // ------------------------------
            // Column and pie connection
            connect_pie_options = {

                // Add title
                title: {
                    text: 'Expenses',
                    subtext: 'Current month only',
                    x: 'center'
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['Internet Explorer','Opera','Safari','Firefox','Chrome']
                },

                // Enable drag recalculate
                calculable: false,

                // Add series
                series: [{
                    name: 'Browsers',
                    type: 'pie',
                    radius: '75%',
                    center: ['50%', '57.5%'],
                    data: [
                        {value: 335, name: 'Internet Explorer'},
                        {value: 310, name: 'Opera'},
                        {value: 234, name: 'Safari'},
                        {value: 135, name: 'Firefox'},
                        {value: 15, name: 'Chrome'}
                    ]
                }]
            };

            // Column options
            connect_column_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 47,
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
                    data: ['Internet Explorer','Opera','Safari','Firefox','Chrome']
                },

                // Add toolbox
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    x: 'right', 
                    y: 35,
                    feature: {
                        mark: {
                            show: true,
                            title: {
                                mark: 'Markline switch',
                                markUndo: 'Undo markline',
                                markClear: 'Clear markline'
                            }
                        },
                        magicType: {
                            show: true,
                            title: {
                                line: 'Switch to line chart',
                                bar: 'Switch to bar chart',
                                stack: 'Switch to stack',
                                tiled: 'Switch to tiled'
                            },
                            type: ['line', 'bar', 'stack', 'tiled']
                        },
                        restore: {
                            show: true,
                            title: 'Restore'
                        },
                        saveAsImage: {
                            show: true,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    splitArea: {show: true}
                }],

                // Add series
                series: [
                    {
                        name: 'Internet Explorer',
                        type: 'bar',
                        stack: 'Total',
                        data: [320, 332, 301, 334, 390, 330, 320]
                    },
                    {
                        name: 'Opera',
                        type: 'bar',
                        stack: 'Total',
                        data: [120, 132, 101, 134, 90, 230, 210]
                    },
                    {
                        name: 'Safari',
                        type: 'bar',
                        stack: 'Total',
                        data: [220, 182, 191, 234, 290, 330, 310]
                    },
                    {
                        name: 'Firefox',
                        type: 'bar',
                        stack: 'Total',
                        data: [150, 232, 201, 154, 190, 330, 410]
                    },
                    {
                        name: 'Chrome',
                        type: 'bar',
                        stack: 'Total',
                        data: [820, 932, 901, 934, 1290, 1330, 1320]
                    }
                ]
            };

            // Connect charts
            connect_pie.connect(connect_column);
            connect_column.connect(connect_pie);

            // Apply options
            // ------------------------------           
            connect_pie.setOption(connect_pie_options);
            connect_column.setOption(connect_column_options);
            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
                    connect_pie.resize();
                    connect_column.resize();
                }, 200);
            }
        }
    );
});
