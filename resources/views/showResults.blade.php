<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            text-align: center;
            padding: 10px;
            background: #aaa;
        }

        .stdata {
            margin-left: 100px;
            margin-bottom: 10px;
            margin-right: 100px;
        }

        .stdata td {
            text-align: start;
            padding-left: 1px;
        }

        .stdata th {
            text-align: start;
            width: auto;
            min-width: 90px;
            padding: 2px;
        }

        .results table {
            width: 210mm;
            table-layout: auto;
        }

        .results table,
        .results th {
            border-collapse: collapse;
        }

        .results th,
        .results td {
            padding: 10px;
            border: solid 1px;
        }

        .subject {
            text-align: start;
        }

        .code,
        .grade {
            width: 100px;
        }

        .h2 {
            font-size: 15px;
        }

        p {
            margin-top: 5px;
        }

        .sheet {
            width: 210mm;
            height: auto;
            padding: 0px 30px 30px 30px;
            background: white;
            margin: auto;
            border: 1px solid brown;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body,
            .sheet {
                width: 210mm;
                height: auto;
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <div class="sheet">
        <div class="headTitle">
            <h3>Department of examination SEUSL <br>
                <span class="h2">Bechelar of Information And Comminication Technology <br>
                    Second Semester Examination 19/20  </span>
            </h3>
        </div>
        <div class="stdata">

            <table class="noneBoder">
                @if ($student)
                <tr>
                    <th>Name in full</th>
                    <td>: {{ $student->st_name }}</td>
                </tr>
                <tr>
                    <th>Student id</th>
                    <td>: {{ $student->st_idno }}</td>
                </tr>
                <tr>
                    <th>index no</th>
                    <td>: {{ $student->st_index }}</td>
                </tr>
                @endif
            </table>
        </div>
        @if ($results->isEmpty())
        <p>No results found</p>
        @else
        <div class="results">
            <table>
                <thead>
                    <tr>
                        <th class="code">Code</th>
                        <th>Subject</th>
                        <th class="grade">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->subject->subject_code }}</td>
                        <td class="subject">{{ $result->subject->subject_name }}</td>
                        <td>
                            <b>
                                @if ($result->mark >= 75)
                                A
                                @elseif($result->mark >= 65)
                                B
                                @elseif($result->mark >= 55)
                                C
                                @elseif($result->mark >= 40)
                                S
                                @elseif($result->mark < 40) W @endif 
                            </b>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</body>

</html>