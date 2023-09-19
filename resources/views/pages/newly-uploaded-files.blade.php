@extends('layouts.dash')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Path Info For the DoC</th>
                    <th scope="col">Uplooader</th>
                    <th scope="col">Upload History</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docsHistory as $docHist)
                    @php
                        $cardCode = \App\Models\Customers::find($docHist->customer_id)->CardCode;
                    @endphp
                    <tr>
                        <th scope="row">
                            <a href="{{ route('get-customer-data-local', $cardCode) }}">
                                {{ $docHist->path }}
                            </a>
                        </th>
                        <td>{{ \App\Models\User::find($docHist->uploaded_id)->name }}</td>
                        <td>{{ $docHist->updated_at->toDateString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $allHistory->links() }} --}}
    </div>
@endsection
