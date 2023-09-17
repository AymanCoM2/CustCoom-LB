@extends('layouts.dash')

@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">File Name</th>
                    <th scope="col">updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allHistory as $editHistory)
                    <tr>
                        <td>{{ str_replace('pdf/', '', $editHistory->filePathName) }}</td>
                        <td>{{ $editHistory->updated_at->toDateString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allHistory->links() }}
    </div>
@endsection

{{-- 

  --}}
