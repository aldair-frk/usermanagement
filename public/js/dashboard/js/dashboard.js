// PARA DONUT CHART
var seriesPie = {
    pie: {
        show       : true,
        radius     : 1,
        innerRadius: 0.42,
        label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
        }
    }
}

function labelFormatter(label, series) {
    return '<div style="font-size:12px; text-align:center; padding:1px; color: #fff; font-weight: 500;">'
    + label + '<br>' + Math.round(series.percent) + '%</div>'
}

//PARA BAR CHART
var seriesBar = {
    bars: {
        show: true, zero: true, barWidth: 0.5, align: 'center', lineWidth: 0, fillColor: {
            colors: [{
                opacity: 1.0
            }, {
                opacity: 1.0
            }]
        }
   },
//    points: { show: true, fill: true }
}

$('<div class="tooltip-inner" id="chartCategory-tooltip"></div>').css({
    position: 'absolute',
    display : 'none',
    opacity : 0.8
}).appendTo('body')

$('#chartCategory').bind('plothover', function (event, pos, item) {
    if (item) {
        var y = item.datapoint[1].toFixed(0)

        $('#chartCategory-tooltip').html(y)
        .css({
            top : item.pageY - 45,
            left: item.pageX - 12
        })
        .fadeIn(200)
    } else {
        $('#chartCategory-tooltip').hide()
    }
})
//PARA LINE CHART
var gridAge = {
    hoverable  : true,
    borderColor: '#f3f3f3',
    borderWidth: 1,
    tickColor  : '#f3f3f3'
}

var seriesLine = {
    shadowSize: 0,
    lines     : {
        show: true,
        zero: true
    },
    points    : {
        show: true
    }
}

$('<div class="tooltip-inner" id="chartAge-tooltip"></div>').css({
    position: 'absolute',
    display : 'none',
    opacity : 0.8
}).appendTo('body')

$('#chartAge').bind('plothover', function (event, pos, item) {
    if (item) {
        var y = item.datapoint[1].toFixed(0)

        $('#chartAge-tooltip').html(y)
        .css({
            top : item.pageY - 45,
            left: item.pageX - 12
        })
        .fadeIn(200)
    } else {
        $('#chartAge-tooltip').hide()
    }
})