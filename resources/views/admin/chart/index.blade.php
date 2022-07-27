@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        <div class="row w-75 m-auto">
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading my-2">Chart Demo</div>
                        <div class="">
                            <canvas id="userChart" class="rounded shadow">
                            </canvas>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels:  {!!json_encode($chart->labels)!!} ,
                datasets: [
                    {
                        label: 'Chart per prezzo',
                        backgroundColor: {!! json_encode($chart->colours)!!} ,
                        data:  {!! json_encode($chart->dataset)!!} ,
                    },
                ]
            },
    // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}}
                        },
                        scaleLabel: {
                            display: false
                        }
                    }]
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontColor: '#122C4B',
                        fontFamily: "'Muli', sans-serif",
                        padding: 25,
                        boxWidth: 25,
                        fontSize: 14,
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 0,
                        bottom: 10
                    }
                }
            }
        });
    </script>
@endsection