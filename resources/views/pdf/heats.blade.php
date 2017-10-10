<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Gyvūnų sąrašas</title>

    <style type="text/css">
        * {
            font-family: DejaVu Sans !important;
            font-size: 13px;
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

        .no-med {
            background-color: rgb(255, 223, 220);
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Karvės numeris</th>
        <th>Karvės veršiavimosi data</th>
        <th>Pastebėta ruja</th>
        <th>Apsiveršiavimo data</th>
        <th>Pastebėjimai</th>
    </tr>
    @foreach($data as $heat)
        <tr>
            <td>{{$heat->number}}</td>
            <td>{{$heat->calving_date}}</td>
            <td>{{$heat->heat_date}}</td>
            <td>{{$heat->calving_date_expected}}</td>
            <td>{{$heat->notes}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>