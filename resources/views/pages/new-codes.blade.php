@extends('layouts.dash')

@section('content')
    <form action="" method="GET">
        <div class="d-flex justify-content-center align-items-center m-3">
            <div class="row">
                <input type="text" class="w-100 rounded-pill p-3" name="search" placeholder="Search...">
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row gy-2">
            @foreach ($allNewCardCodes as $card)
                <div class="col-sm-2 mx-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="{{ route('get-customer-data-local', $card->cc) }}">{{ $card->cc }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <br>
    {{ $allNewCardCodes->links() }}
    <br>
@endsection
