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
            max-width: 100%;
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
            <th>Numerėlis</th>
            <th>Vardas</th>
            <th>Gyvis</th>
            <th>Veislės vardas</th>
            <th>Lytis</th>
            <th>Spava</th>
            <th>Gimtadienis</th>
            <th>Mama</th>
            <th>Tėtis</th>
            <th>Komentaras</th>
        </tr>
        @foreach($data as $animal)
            <tr>
                <td>{{$animal->number}}</td>
                <td>{{$animal->name}}</td>
                <td>{{$animal->liveBeing}}</td>
                <td>{{$animal->breedName}}</td>
                @if($animal->sex == 2)
                    <td>Moteris</td>
                @elseif($animal->sex == 1)
                    <td>Vyras</td>
                @else
                    <td>-</td>
                @endif

                <td>{{$animal->color}}</td>
                <td>{{$animal->birthday}}</td>
                <td>{{$animal->mother}}</td>
                <td>{{$animal->father}}</td>
                <td>
                    <a>
                        {{ str_limit($animal->comment, $limit = 20, $end = '...') }}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>