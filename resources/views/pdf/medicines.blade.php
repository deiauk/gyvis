<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gyvūnų sąrašas</title>

    <style type="text/css" >
        *{
            font-family: DejaVu Sans !important;
            font-size: 13px;
        }
        .table {
            display: table;
            width: 100%;
        }
        .tr {
            display: table-row;
        }
        .highlight {
            background-color: greenyellow;
            display: table-cell;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            padding: 5px 5px;
            border: 1px solid black;
        }
        th {
            border-bottom: 2px solid black;
        }
        .no-med {
            background-color: rgb(255, 223, 220);
        }
    </style>
</head>
<body>
<table class="table">
    <tr>
        <th>Eil. Nr</th>
        <th>Data</th>
        <th>Pavadinimas</th>
        <th>Pagaminimo data</th>
        <th>Galioja</th>
        <th>Serija</th>
        <th>Gauta</th>
        <th>Sunaudota</th>
        <th>Likutis</th>
    </tr>
    @if($data->medicine)
        <tr>
            <td>{{$data->medicine->id}}</td>
            <td>{{$data->medicine->filldate}}</td>
            <td width="30%">{{$data->medicine->from}}</td>
            <td>{{$data->medicine->productiondate}}</td>
            <td>{{$data->medicine->expirydate}}</td>
            <td>{{$data->medicine->series}}</td>
            <td>{{$data->medicine->quantity}}</td>
            <td>{{$data->medicine->consumed}}</td>
            <td>{{$data->medicine->balance}}</td>
        </tr>
    @endif
</table>
<br>
@if($data->log)
<table class="table">
    <tr>
        <th>Vaistas</th>
        <th>Pacientų registracijos nr.</th>
        <th>Kiekis</th>
        <th>Sunaudota</th>
        <th>Likutis</th>
    </tr>
    @foreach($data->log as $log)
        <tr>
            <td width="30%">{{ $log->medicine->from }}</td>
            <td>{{ $log->registration_num > -1 ? $log->registration_num : "Pridedamas kiekis" }}</td>
            <td>{{ $log->quantity }}</td>
            <td>{{ $log->used > 0 ? "+" : "" }}{{ $log->used }}</td>
            <td>{{ $log->quantity + $log->used }}</td>
        </tr>
    @endforeach
</table>
@endif
</body>
</html>