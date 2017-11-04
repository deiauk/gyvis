<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gyvūnų sąrašas</title>

    <style type="text/css" >
        *{
            font-family: DejaVu Sans !important;
            font-size: 12px;
        }
        .table {
            display: table;
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
    </style>
</head>
<body>
<table class="table">
    <tr>
        <th rowspan="2">Data</th>
        <th rowspan="2">Gyvulio Nr.</th>
        <th colspan="3">GYVULIO</th>
        <th rowspan="2">Susirgimo data</th>
        <th colspan="3">Gyvulio tyrimo duomenys</th>
        <th rowspan="2">Diagnozė</th>
        <th rowspan="2">Gydymas ir nurodymai</th>
        <th rowspan="2">Vaistai</th>
        <th rowspan="2">Vaistų kiekis</th>
        <th rowspan="2">Baigtis</th>
        <th rowspan="2">Pastabos</th>
    </tr>
    <tr>
        <th>Rūšis</th>
        <th>Amžius</th>
        <th>Spalva</th>
        <th>Temperatūra</th>
        <th>Pulsas</th>
        <th>Kvėpavimas</th>
    </tr>
    @foreach($data as $medicine)
        <tr>
            <td>{{$medicine->date}}</td>
            <td>{{$medicine->animalNumber}}</td>
            <td>{{$medicine->animalType}}</td>
            <td>{{$medicine->age}}</td>
            <td>{{$medicine->color}}</td>
            <td>{{$medicine->sickDate}}</td>
            <td>{{$medicine->temperature}}</td>
            <td>{{$medicine->pulse}}</td>
            <td>{{$medicine->breath}}</td>
            <td>{{$medicine->diagnosis}}</td>
            <td>
                {{ str_limit($medicine->treatmentAndDirections, $limit = 40, $end = '...') }}
            </td>
            <td>{{ $medicine->medicine['from'] }}</td>
            <td>{{ $medicine->quantity }}</td>
            <td>{{$medicine->result}}</td>
            <td>
                {{ str_limit($medicine->notes, $limit = 20, $end = '...') }}
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>