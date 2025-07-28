@extends('layouts.app')

@section('content')
    <h1>Records</h1>


    <table class="table table-bordered">
        <thead>
        <tr>
            @foreach($records[0] as $value)
                <th>{{ $value }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($records as $key => $record)
            @if($key > 0)
                <tr>
                    @foreach($record as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    {{ $records->links() }}
@endsection
