@extends('admin.dashboard.statisticalProduct')

@section('dashboard')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 text-center pt-3">
            <h1>Số lượng sản phẩm tồn kho</h1>
        </div>
    </div>
    <div>
      <canvas id="myChart" height="100px"></canvas>
  </div>
</div>


<script>
product();
function product() {
  var dataProduct = JSON.parse('{!! $products !!}');
  var quantityData = [];
  var nameData = [];

  for(const [key, value] of Object.entries(dataProduct)){
      nameData.push(value['name']);
      quantityData.push(value['quantity']);
  }

  const data = {
    labels: nameData,
    datasets: [{
      label: 'My First Dataset',
      data: quantityData,
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
}
</script>
@endsection