<style>
    * {
        font-family: DejaVu Sans, sans-serif;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

</style>
<div style=" width: 90%; margin-left: auto;margin-right: auto;">
    <h3 style="text-align:center">Tasks from @isset($fromDate)  {{ $fromDate }} @else  begining @endisset
       until @isset($toDate) {{ $toDate }} @else  now @endisset</h3>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th style="width: 60%;">Comment</th>
                <th>Date</th>
                <th style="width: 7%;">Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->comment }}</td>
                    <td>{{ $task->date }}</td>
                    <td>{{ $task->time_spent }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">Total time spent</td>
                <td>{{ $totalTime ?? '0'}}</td>
            </tr>
        </tbody>
    </table>
</div>
