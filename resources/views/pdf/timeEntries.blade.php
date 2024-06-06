<!DOCTYPE html>
<html>
<head>
    <title>Time Entries PDF</title>
    <link rel="icon" type="image/svg+xml" href="https://developing.nl/wp-content/uploads/2023/02/icon.png" />

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
    <h1>Time Entries List</h1>
    <table>
        <thead>
            <tr>
                <th>Datum</th>
                <th>Taak</th>
                {{-- <th>Tag</th> --}}
                <th>Tijd</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $totalSeconds = 0;
                foreach ($timeEntries as $entry) {
                    $milliseconds = $entry->duration;
                    $seconds = floor($milliseconds / 1000);
                    $totalSeconds += $seconds;
            ?>
            <tr>
                <td>{{ date('d-m-Y', strtotime($entry->start_date)) }} tot {{ date('d-m-Y', strtotime($entry->end_date)) }}</td>
                <td>{{ $entry->task }}</td>
                {{-- <td>{{ $entry->tag }}</td> --}}
                <td>
                    <?php
                        $minutes = floor($seconds / 60);
                        $hours = floor($minutes / 60);

                        $minutes %= 60;
                        $seconds %= 60;

                        echo sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
        $totalMinutes = floor($totalSeconds / 60);
        $totalHours = floor($totalMinutes / 60);

        $totalMinutes %= 60;
        $totalSeconds %= 60;

        $totalDuration = sprintf('%02d:%02d:%02d', $totalHours, $totalMinutes, $totalSeconds);
    ?>
    <p><strong>Totaal duur: </strong><?php echo $totalDuration; ?></p>
</body>
</html>
