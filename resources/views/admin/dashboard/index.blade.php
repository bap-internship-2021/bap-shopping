@extends('admin.layouts.layouts')

@section('content')
<div>
    <canvas id="myChart" height="100px"></canvas>
</div>

<script>
var dataPrice = JSON.parse('{!! $price !!}');
var dataLabel = JSON.parse('{!! $name !!}');

var priceArrData = [];
var labelArrData = [];

for(const [key, value] of Object.entries(dataPrice)){
    for(const [keyPrice, valuePrice] of Object.entries(value)){
        priceArrData.push(valuePrice);
    }
}

for(const [key, value] of Object.entries(dataLabel)){
    for(const [keyLabel, valueLabel] of Object.entries(value)){
        labelArrData.push(valueLabel);
    }
}

const data = {
  labels: labelArrData,
  datasets: [{
    label: 'My First Dataset',
    data: priceArrData,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
};

const config = {
  type: 'doughnut',
  data: data,
};

var myChart = new Chart(document.getElementById('myChart'), config);
</script>
@endsection()