$(function () {

    /* Ajax loaded data, clickable points */
    $('#ajax-loaded-data').highcharts({
        title: {
            text: 'Monthly Average Temperature',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: WorldClimate.com',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'New York',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Berlin',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });

    /* With data labels */
    $('#with-data-labels').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Average Temperature'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            }
        },
        tooltip: {
            enabled: false,
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.x + ': ' + this.y + '°C';
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });

    /* Time series, zoomable */
    $('#time-series-zoomable').highcharts({
        chart: {
            zoomType: 'x',
            spacingRight: 20
        },
        title: {
            text: '美元兑欧元汇率走势图'
        },
        subtitle: {
            text: document.ontouchstart === undefined ?
                '鼠标拖动可以进行缩放' : '手势操作进行缩放'
        },
        xAxis: {
            type: 'datetime',
            maxZoom: 14 * 24 * 3600000, // fourteen days
            title: {
                text: null
            }
        },
        yAxis: {
            title: {
                text: '汇率'
            }
        },
        tooltip: {
            shared: true
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillOpacity: 0.4,
                lineWidth: 1,
                marker: {
                    enabled: true,
                    radius: 1.5
                },
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: '美元兑欧元',
            pointInterval: 24 * 3600 * 1000,
            pointStart: Date.UTC(2006, 0, 01),
            data: [
                0.8446, 0.8445, 0.8444, 0.8451, 0.8418, 0.8264, 0.8258, 0.8232, 0.8233, 0.8258,
                0.8283, 0.8278, 0.8256, 0.8292, 0.8239, 0.8239, 0.8245, 0.8265, 0.8261, 0.8269,
                0.8273, 0.8244, 0.8244, 0.8172, 0.8139, 0.8146, 0.8164, 0.82, 0.8269, 0.8269,
                0.8269, 0.8258, 0.8247, 0.8286, 0.8289, 0.8316, 0.832, 0.8333, 0.8352, 0.8357,
                0.8355, 0.8354, 0.8403, 0.8403, 0.8406, 0.8403, 0.8396, 0.8418, 0.8409, 0.8384,
                0.8386, 0.8372, 0.839, 0.84, 0.8389, 0.84, 0.8423, 0.8423, 0.8435, 0.8422,
                0.838, 0.8373, 0.8316, 0.8303, 0.8303, 0.8302, 0.8369, 0.84, 0.8385, 0.84,
                0.8401, 0.8402, 0.8381, 0.8351, 0.8314, 0.8273, 0.8213, 0.8207, 0.8207, 0.8215,
            ],
        }, {
            type: 'area',
            name: '美元兑日元',
            // color: '#3e526d',
            pointInterval: 24 * 3600 * 1000,
            pointStart: Date.UTC(2006, 0, 01),
            data: [
                0.9, 0.7, 0.54, 0.614, 0.352, 0.5142, 0.6525, 0.3512, 0.5362, 0.741,
                0.524, 0.321, 0.412, 0.254, 0.2541, 0.92151, 0.954, 0.7526, 0.9875, 0.8269,
                0.8273, 0.8244, 0.8244, 0.8172, 0.8139, 0.8146, 0.8164, 0.82, 0.8269, 0.8269,
                0.8269, 0.8258, 0.8247, 0.8286, 0.8289, 0.8316, 0.832, 0.8333, 0.8352, 0.8357,
                0.8355, 0.8354, 0.8403, 0.8403, 0.8406, 0.8403, 0.8396, 0.8418, 0.8409, 0.8384,
                0.8386, 0.8372, 0.839, 0.84, 0.8389, 0.84, 0.8423, 0.8423, 0.8435, 0.8422,
                0.838, 0.8373, 0.8316, 0.8303, 0.8303, 0.8302, 0.8369, 0.84, 0.8385, 0.84,
                0.8401, 0.8402, 0.8381, 0.8351, 0.8314, 0.8273, 0.8213, 0.8207, 0.8207, 0.8215
            ],
        }]
    });

    /* Time series, zoomable */
    $('#time-series-zoomable_2').highcharts({
        chart: {
            zoomType: 'x',
            spacingRight: 20
        },
        title: {
            text: '美元兑欧元汇率走势图'
        },
        subtitle: {
            text: document.ontouchstart === undefined ?
                '鼠标拖动可以进行缩放' : '手势操作进行缩放'
        },
        xAxis: {
            type: 'datetime',
            maxZoom: 14 * 24 * 3600000, // fourteen days
            title: {
                text: null
            }
        },
        yAxis: {
            title: {
                text: '汇率'
            }
        },
        tooltip: {
            shared: true
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillOpacity: 0.4,
                lineWidth: 1,
                marker: {
                    enabled: false
                },
                shadow: false,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: '美元兑欧元',
            pointInterval: 24 * 3600 * 1000,
            pointStart: Date.UTC(2006, 0, 01),
            data: [
                0.8446, 0.8445, 0.8444, 0.8451, 0.8418, 0.8264, 0.8258, 0.8232, 0.8233, 0.8258,
                0.8283, 0.8278, 0.8256, 0.8292, 0.8239, 0.8239, 0.8245, 0.8265, 0.8261, 0.8269,
                0.8273, 0.8244, 0.8244, 0.8172, 0.8139, 0.8146, 0.8164, 0.82, 0.8269, 0.8269,
                0.8269, 0.8258, 0.8247, 0.8286, 0.8289, 0.8316, 0.832, 0.8333, 0.8352, 0.8357,
                0.8355, 0.8354, 0.8403, 0.8403, 0.8406, 0.8403, 0.8396, 0.8418, 0.8409, 0.8384,
                0.8386, 0.8372, 0.839, 0.84, 0.8389, 0.84, 0.8423, 0.8423, 0.8435, 0.8422,
                0.838, 0.8373, 0.8316, 0.8303, 0.8303, 0.8302, 0.8369, 0.84, 0.8385, 0.84,
                0.8401, 0.8402, 0.8381, 0.8351, 0.8314, 0.8273, 0.8213, 0.8207, 0.8207, 0.8215,
                0.8242, 0.8273, 0.8301, 0.8346, 0.8312, 0.8312, 0.8312, 0.8306, 0.8327, 0.8282,
                0.824, 0.8255, 0.8256, 0.8273, 0.8209, 0.8151, 0.8149, 0.8213, 0.8273, 0.8273
            ],
        }, {
            type: 'area',
            name: '美元兑日元',
            // color: '#3e526d',
            pointInterval: 24 * 3600 * 1000,
            pointStart: Date.UTC(2006, 0, 01),
            data: [
                0.9, 0.7, 0.54, 0.614, 0.352, 0.5142, 0.6525, 0.3512, 0.5362, 0.741,
                0.524, 0.321, 0.412, 0.254, 0.2541, 0.92151, 0.954, 0.7526, 0.9875, 0.8269,
                0.8273, 0.8244, 0.8244, 0.8172, 0.8139, 0.8146, 0.8164, 0.82, 0.8269, 0.8269,
                0.8269, 0.8258, 0.8247, 0.8286, 0.8289, 0.8316, 0.832, 0.8333, 0.8352, 0.8357,
                0.8355, 0.8354, 0.8403, 0.8403, 0.8406, 0.8403, 0.8396, 0.8418, 0.8409, 0.8384,
                0.8386, 0.8372, 0.839, 0.84, 0.8389, 0.84, 0.8423, 0.8423, 0.8435, 0.8422,
                0.838, 0.8373, 0.8316, 0.8303, 0.8303, 0.8302, 0.8369, 0.84, 0.8385, 0.84,
                0.8401, 0.8402, 0.8381, 0.8351, 0.8314, 0.8273, 0.8213, 0.8207, 0.8207, 0.8215,
                0.8242, 0.8273, 0.8301, 0.8346, 0.8312, 0.8312, 0.8312, 0.8306, 0.8327, 0.8282,
                0.824, 0.8255, 0.8256, 0.8273, 0.8209, 0.8151, 0.8149, 0.8213, 0.8273, 0.8273
            ],
        }]
    });

    /* Spline with inverted axes */
    $('#spline-with-inverted-axes').highcharts({
        chart: {
            type: 'spline',
            inverted: true
        },
        title: {
            text: 'Atmosphere Temperature by Altitude'
        },
        subtitle: {
            text: 'According to the Standard Atmosphere Model'
        },
        xAxis: {
            reversed: false,
            title: {
                enabled: true,
                text: 'Altitude'
            },
            labels: {
                formatter: function () {
                    return this.value + 'km';
                }
            },
            maxPadding: 0.05,
            showLastLabel: true
        },
        yAxis: {
            title: {
                text: 'Temperature'
            },
            labels: {
                formatter: function () {
                    return this.value + '°';
                }
            },
            lineWidth: 2
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br/>',
            pointFormat: '{point.x} km: {point.y}°C'
        },
        plotOptions: {
            spline: {
                marker: {
                    enable: false
                }
            }
        },
        series: [{
            name: 'Temperature',
            data: [[0, 15], [10, -50], [20, -56.5], [30, -46.5], [40, -22.1],
                [50, -2.5], [60, -27.7], [70, -55.7], [80, -76.5]]
        }]
    });

    /* Spline with symbols */
    $('#spline-with-symbols').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Monthly Average Temperature'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature'
            },
            labels: {
                formatter: function () {
                    return this.value + '°'
                }
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Tokyo',
            marker: {
                symbol: 'square'
            },
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, {
                y: 26.5,
                marker: {
                    symbol: 'url(http://www.highcharts.com/demo/gfx/sun.png)'
                }
            }, 23.3, 18.3, 13.9, 9.6]

        }, {
            name: 'London',
            marker: {
                symbol: 'diamond'
            },
            data: [{
                y: 3.9,
                marker: {
                    symbol: 'url(http://www.highcharts.com/demo/gfx/snow.png)'
                }
            }, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });

    /* Spline with plot bands */
    $('#spline-with-plot-bands').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Wind speed during two days'
        },
        subtitle: {
            text: 'October 6th and 7th 2009 at two locations in Vik i Sogn, Norway'
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
            title: {
                text: 'Wind speed (m/s)'
            },
            min: 0,
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
            plotBands: [{ // Light air
                from: 0.3,
                to: 1.5,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Light air',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Light breeze
                from: 1.5,
                to: 3.3,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Light breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Gentle breeze
                from: 3.3,
                to: 5.5,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Gentle breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Moderate breeze
                from: 5.5,
                to: 8,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Moderate breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Fresh breeze
                from: 8,
                to: 11,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Fresh breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Strong breeze
                from: 11,
                to: 14,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Strong breeze',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // High wind
                from: 14,
                to: 15,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'High wind',
                    style: {
                        color: '#606060'
                    }
                }
            }]
        },
        tooltip: {
            valueSuffix: ' m/s'
        },
        plotOptions: {
            spline: {
                lineWidth: 4,
                states: {
                    hover: {
                        lineWidth: 5
                    }
                },
                marker: {
                    enabled: false
                },
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(2009, 9, 6, 0, 0, 0)
            }
        },
        series: [{
            name: 'Hestavollane',
            data: [4.3, 5.1, 4.3, 5.2, 5.4, 4.7, 3.5, 4.1, 5.6, 7.4, 6.9, 7.1,
                7.9, 7.9, 7.5, 6.7, 7.7, 7.7, 7.4, 7.0, 7.1, 5.8, 5.9, 7.4,
                8.2, 8.5, 9.4, 8.1, 10.9, 10.4, 10.9, 12.4, 12.1, 9.5, 7.5,
                7.1, 7.5, 8.1, 6.8, 3.4, 2.1, 1.9, 2.8, 2.9, 1.3, 4.4, 4.2,
                3.0, 3.0]

        }, {
            name: 'Voll',
            data: [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.1, 0.0, 0.3, 0.0,
                0.0, 0.4, 0.0, 0.1, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0,
                0.0, 0.6, 1.2, 1.7, 0.7, 2.9, 4.1, 2.6, 3.7, 3.9, 1.7, 2.3,
                3.0, 3.3, 4.8, 5.0, 4.8, 5.0, 3.2, 2.0, 0.9, 0.4, 0.3, 0.5, 0.4]
        }]
        ,
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });

    /*  Time data with irregular intervals */
    $('#time-data-with-irregular-intervals').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Snow depth at Vikjafjellet, Norway'
        },
        subtitle: {
            text: 'Irregular time data in Highcharts JS'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            }
        },
        yAxis: {
            title: {
                text: 'Snow depth (m)'
            },
            min: 0
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    Highcharts.dateFormat('%e. %b', this.x) + ': ' + this.y + ' m';
            }
        },

        series: [{
            name: 'Winter 2007-2008',
            // Define the data points. All series have a dummy year
            // of 1970/71 in order to be compared on the same x axis. Note
            // that in JavaScript, months start at 0 for January, 1 for February etc.
            data: [
                [Date.UTC(1970, 9, 27), 0],
                [Date.UTC(1970, 10, 10), 0.6],
                [Date.UTC(1970, 10, 18), 0.7],
                [Date.UTC(1970, 11, 2), 0.8],
                [Date.UTC(1970, 11, 9), 0.6],
                [Date.UTC(1970, 11, 16), 0.6],
                [Date.UTC(1970, 11, 28), 0.67],
                [Date.UTC(1971, 0, 1), 0.81],
                [Date.UTC(1971, 0, 8), 0.78],
                [Date.UTC(1971, 0, 12), 0.98],
                [Date.UTC(1971, 0, 27), 1.84],
                [Date.UTC(1971, 1, 10), 1.80],
                [Date.UTC(1971, 1, 18), 1.80],
                [Date.UTC(1971, 1, 24), 1.92],
                [Date.UTC(1971, 2, 4), 2.49],
                [Date.UTC(1971, 2, 11), 2.79],
                [Date.UTC(1971, 2, 15), 2.73],
                [Date.UTC(1971, 2, 25), 2.61],
                [Date.UTC(1971, 3, 2), 2.76],
                [Date.UTC(1971, 3, 6), 2.82],
                [Date.UTC(1971, 3, 13), 2.8],
                [Date.UTC(1971, 4, 3), 2.1],
                [Date.UTC(1971, 4, 26), 1.1],
                [Date.UTC(1971, 5, 9), 0.25],
                [Date.UTC(1971, 5, 12), 0]
            ]
        }, {
            name: 'Winter 2008-2009',
            data: [
                [Date.UTC(1970, 9, 18), 0],
                [Date.UTC(1970, 9, 26), 0.2],
                [Date.UTC(1970, 11, 1), 0.47],
                [Date.UTC(1970, 11, 11), 0.55],
                [Date.UTC(1970, 11, 25), 1.38],
                [Date.UTC(1971, 0, 8), 1.38],
                [Date.UTC(1971, 0, 15), 1.38],
                [Date.UTC(1971, 1, 1), 1.38],
                [Date.UTC(1971, 1, 8), 1.48],
                [Date.UTC(1971, 1, 21), 1.5],
                [Date.UTC(1971, 2, 12), 1.89],
                [Date.UTC(1971, 2, 25), 2.0],
                [Date.UTC(1971, 3, 4), 1.94],
                [Date.UTC(1971, 3, 9), 1.91],
                [Date.UTC(1971, 3, 13), 1.75],
                [Date.UTC(1971, 3, 19), 1.6],
                [Date.UTC(1971, 4, 25), 0.6],
                [Date.UTC(1971, 4, 31), 0.35],
                [Date.UTC(1971, 5, 7), 0]
            ]
        }, {
            name: 'Winter 2009-2010',
            data: [
                [Date.UTC(1970, 9, 9), 0],
                [Date.UTC(1970, 9, 14), 0.15],
                [Date.UTC(1970, 10, 28), 0.35],
                [Date.UTC(1970, 11, 12), 0.46],
                [Date.UTC(1971, 0, 1), 0.59],
                [Date.UTC(1971, 0, 24), 0.58],
                [Date.UTC(1971, 1, 1), 0.62],
                [Date.UTC(1971, 1, 7), 0.65],
                [Date.UTC(1971, 1, 23), 0.77],
                [Date.UTC(1971, 2, 8), 0.77],
                [Date.UTC(1971, 2, 14), 0.79],
                [Date.UTC(1971, 2, 24), 0.86],
                [Date.UTC(1971, 3, 4), 0.8],
                [Date.UTC(1971, 3, 18), 0.94],
                [Date.UTC(1971, 3, 24), 0.9],
                [Date.UTC(1971, 4, 16), 0.39],
                [Date.UTC(1971, 4, 21), 0]
            ]
        }]
    });

    /* Logarithmic axis */
    $('#logarithmic-axis').highcharts({

        chart: {},

        title: {
            text: 'Logarithmic axis demo'
        },

        xAxis: {
            tickInterval: 1
        },

        yAxis: {
            type: 'logarithmic',
            minorTickInterval: 0.1
        },

        tooltip: {
            headerFormat: '<b>{series.name}</b><br />',
            pointFormat: 'x = {point.x}, y = {point.y}'
        },

        series: [{
            data: [1, 2, 4, 8, 16, 32, 64, 128, 256, 512],
            pointStart: 1
        }]
    });

});
