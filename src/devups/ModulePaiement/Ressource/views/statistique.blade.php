@extends('layout')
@section('title', 'List')
@section('layout_content')
    <script src="{{node_modules}}chart.js/dist/Chart.min.js"></script>
    <div class="col-md-12">
        <canvas  id="myChart"></canvas>
    </div>
    <br> <br><div class="container">
        <h4 style="text-decoration: underline;text-align: center">Tableau Statistique</h4><hr>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Heure</th>
                <th>Montant</th>
                <th>Etat</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transaction as $a)
                <tr>
                    <td>{{$a->getId()}}</td>
                    <td>{{$a->getHeure()}}</td>
                    <td>{{$a->montant}}</td>
                    <td><button class="btn btn-danger">En attente</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
       new Chart(document.getElementById("myChart"), {
    type: 'bar',
    data: {
      labels: [
        @foreach ($transaction as $a)
            "{{$a->heure}}",
        @endforeach
      ],
      datasets: [
        {
          label: "Vente (Fcfa)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#ccd850","#3ff5cd", "#8eaaa2","#3cbabb","#edda3b9","#fadefd","#aabbdd","#cae4450","#cfe8ee","#cfa800","#cd7850","#caaee0","#cdcdcd","#aaeade","#aaddee","#acd850"],
          data: [        @foreach ($transaction as $a)
            "{{$a->montant}}",
        @endforeach]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Date  /   Vente (fcfa)'
      }
    }
});
</script>
@endsection
            