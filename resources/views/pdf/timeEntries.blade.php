<!-- resources/views/tags_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Tags PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Tags List</h1>
    <table>
        <thead>
            <tr>
                <th>Tag Name</th>
                <th>Tag Color</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag['name'] }}</td>
                    <td>{{ $tag['team_id'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
