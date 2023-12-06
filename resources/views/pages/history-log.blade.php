@extends('layouts.dash')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">cardCode</th>
                    <th scope="col">editor_id</th>
                    <th scope="col">fieldName</th>
                    <th scope="col">oldValue</th>
                    <th scope="col">newValue</th>
                    <th scope="col">isApproved</th>
                    <th scope="col">updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allHistory as $editHistory)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('get-customer-data-local', $editHistory->cardCode) }}">
                                {{ $editHistory->cardCode }}
                            </a>
                        </th>
                        <td>{{ \App\Models\User::where('id', $editHistory->editor_id)->first()->name }}</td>
                        <td>{{ __($editHistory->fieldName, [], 'ar') }}</td>
                        <td>{{ $editHistory->oldValue }}</td>
                        <td>{{ $editHistory->newValue }}</td>
                        <td style="background-color:red;">No</td>
                        <td>{{ $editHistory->updated_at->toDateString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allHistory->links() }}
    </div>
@endsection
