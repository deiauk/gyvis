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
        <th rowspan="2">Eil. Nr</th>
        <th>Data</th>
        <th>Pavadinimas</th>
        <th>Pagaminimo data</th>
        <th>Galioja</th>
        <th>Serija</th>
        <th>Pacientų registracijos nr.</th>
        <th>Gauta</th>
        <th>Sunaudota</th>
        <th>Likutis</th>
    </tr>
    @foreach($data as $medicine)
        <tr>
            <td>{{$medicine->id}}</td>
            <td>{{$medicine->filldate}}</td>
            <td width="30%">{{$medicine->from}}</td>
            <td>{{$medicine->productiondate}}</td>
            <td>{{$medicine->expirydate}}</td>
            <td>{{$medicine->series}}</td>
            <td width="12%">{{$medicine->patientregistrationnr}}</td>
            <td>{{$medicine->quantity}}</td>
            <td>{{$medicine->consumed}}</td>
            <td>{{$medicine->balance}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>