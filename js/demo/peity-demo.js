$(function() {
    $("span.pie").peity("pie", {
        fill: ['#FBBC05', '#d7d7d7', '#ffffff']
    })

    $(".line").peity("line",{
        fill: '#FBBC05',
        stroke:'#169c81',
    })

    $(".bar").peity("bar", {
        fill: ["#FBBC05", "#d7d7d7"]
    })

    $(".bar_dashboard").peity("bar", {
        fill: ["#FBBC05", "#d7d7d7"],
        width:100
    })

    var updatingChart = $(".updating-chart").peity("line", { fill: '#FBBC05',stroke:'#FF0004', width: 64 })

    setInterval(function() {
        var random = Math.round(Math.random() * 10)
        var values = updatingChart.text().split(",")
        values.shift()
        values.push(random)

        updatingChart
            .text(values.join(","))
            .change()
    }, 1000);

});
