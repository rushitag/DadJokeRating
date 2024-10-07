<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (count($data) > 0)
        <table border="1" align="center">
            <tr>
                <td colspan="3">best_joke:{{ $best_joke ? $best_joke->average_rate : 0 }}</td>
                <td colspan="2">worst_joke:{{ $worst_joke ? $worst_joke->average_rate : 0 }}</td>
            </tr>


            <tr>
                <td>joke</td>
                <td>Average rate</td>
                <td>Total rates</td>
                <td>Add Rates</td>
                <td>Action</td>
            </tr>
            @foreach ($data as $joke)
                <form action="{{ route('save.joke') }}" method="POST">
                    @csrf
                    <tr>
                        <td>{{ $joke->joke }}</td>
                        <td>{{ $joke->average_rate }}</td>
                        <td>{{ $joke->total_rates }}</td>
                        <td>
                            <input type="number" name="rate" min="1" max="5" id="rate">
                            <input type="hidden" name="id" value="{{ $joke->id }}" id="id">
                        </td>
                        <td><button type="submit">Add Rate</button></td>
                    </tr>
                </form>
            @endforeach

        </table>
    @else
        <h4 align="center">No joke found !</h4>
    @endif
</body>

</html>
