@extends('admin.layouts.layouts')

@section('content')
<div class="p-4">
  <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Back</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h1>Số lượng sản phẩm tồn kho</h1>
        </div>
    </div>
    <div>
      <canvas id="myChart" height="100px"></canvas>
  </div>
</div>


<script>
var dataQuantity = JSON.parse('{!! $quantity !!}');
var dataLabel = JSON.parse('{!! $name !!}');

var quantityArrData = [];
var labelArrData = [];

for(const [key, value] of Object.entries(dataQuantity)){
    for(const [keyQuantity, valueQuantity] of Object.entries(value)){
      quantityArrData.push(valueQuantity);
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
    data: quantityArrData,
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