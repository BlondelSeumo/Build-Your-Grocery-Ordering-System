var shops,locations;
$( document ).ready(function() {

            //   location map
            var a = {  gray: {
                100: "#f6f9fc",
                200: "#e9ecef",
                300: "#dee2e6",
                400: "#ced4da",
                500: "#adb5bd" 
            }              
            };
            if($('#locations').val()){
                locations = JSON.parse($('#locations').val()); 
            }
        

        var location_marker = [];
        if(locations){            
        for (let i = 0; i < locations.length; i++) {
            var latlang = [];
            latlang.push(locations[i].latitude);
            latlang.push(locations[i].longitude);
            location_marker.push({
                latLng:latlang,
                name:locations[i].name
            });                
        }
        }

        map = $('#locationMap').vectorMap({
        map: 'world_mill',
        zoomOnScroll: !1,
        scaleColors: ["#f00", "#0071A4"],
        normalizeFunction: "polynomial",
        hoverOpacity: .7,
        hoverColor: !1,
        backgroundColor: "transparent",
        regionStyle: {
            initial: {
                fill: a.gray[200],
                "fill-opacity": .8,
                stroke: "none",
                "stroke-width": 0,
                "stroke-opacity": 1
            },
            hover: {
                fill: a.gray[300],
                "fill-opacity": .8,
                cursor: "pointer"
            },              
        },
        markerStyle: {
            initial: {
                fill: "#fb6340",
                "stroke-width": 0
            },
            hover: {
                fill: "#5e72e4",
                "stroke-width": 0
            }
        },
        markers: location_marker,
        series: {
            regions: [{
                values: {
                    AU: 760,
                    BR: 550,
                    CA: 120,
                    DE: 1300,
                    FR: 540,
                    GB: 690,
                    GE: 200,
                    IN: 200,
                    RO: 600,
                    RU: 300,
                    US: 2920
                },
                scale: [a.gray[400], a.gray[500]],
                normalizeFunction: "polynomial"
            }]
        }
        });

        var ctx = document.getElementById('chart-pie');
        if($('#shops').val()){
            shops = JSON.parse($('#shops').val());        
            var label = [],data = [],color = [];

            for (let i = 0; i < shops.length; i++) {
            label.push(shops[i].name);  
            data.push(shops[i].earning);  
            color.push( 'rgb(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ')');  
            }                
            var isAllZero = data.reduce((a, b) => a + b) > 0 ? false : true;
            console.log('shop',isAllZero)
            if(isAllZero==true){
                    var blank_data = [100];
                    var myPieChart = new Chart(ctx, {
                        type: 'doughnut',
                        data:  {
                            labels: ['No data'],
                            datasets: [{
                                data: blank_data,
                                backgroundColor: ['#eee'],                  
                                label: "Restaurant Data",
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: !0,
                            legend: {
                                position: "top",                    
                            },
                            animation: {
                                duration:1000,
                                easing:"easeOutQuad",
                                animateScale: !0,
                                animateRotate: !0                    
                            },
                            
                        }
                        });
            }
            else{
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data:  {
                        labels: label,
                        datasets: [{
                            data: data,
                            backgroundColor: color,                  
                            label: "Restaurant Data",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: !0,
                        legend: {
                            position: "top",                    
                        },
                        animation: {
                            duration:1000,
                            easing:"easeOutQuad",
                            animateScale: !0,
                            animateRotate: !0                    
                        },
                        
                    }
                    });
            }
        }   
});