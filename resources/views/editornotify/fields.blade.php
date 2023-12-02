@extends('layouts.dash')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
    <hr style="border: 5px solid black;">
    <br>
    <h1 class="text-center">Edits Notifications</h1>
    @php
        $allNotify = \App\Models\EditorOnceTimeNOtification::where('editor_id', request()->user()->id)->get();
    @endphp
    @foreach ($allNotify as $notify)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $notify->file_name }}</h5>
                <p class="card-text">
                    <span class="">Old Value : {{ $notify->field_old_value }}</span> <i class='bx bx-dots-vertical'></i>
                    <span class="">New Value : {{ $notify->field_new_value }}</span> <i
                        class='bx bx-dots-vertical'></i>
                    <span class="">State OF Approval : {{ $notify->state ? 'Approved' : 'Not approved' }}</span> <i
                        class='bx bx-dots-vertical'></i>
                    <button id={{ $notify->id }} class="btn btn-danger float-end">
                        Mark as Read
                    </button>
                </p>
            </div>
        </div>
    @endforeach
@endsection


@section('extra-script')
    <script>
        $("button").on("click", function() {
            let theButton = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); // Setting Up the Ajax # 1 
            $.ajax({
                type: 'POST',
                url: "{{ route('mark-as-read') }}",
                data: {
                    idOfElement: $(this).attr('id'),
                    typeOfElement: 'field',
                },
                success: function(data) {
                    console.log('Data Success From the API');
                    console.log(data);
                    Toastify({
                        text: "✔️",
                        duration: 3000,
                        style: {
                            background: "linear-gradient(to right, #FFFFFF, #FFFFFF)",
                        },
                    }).showToast();
                    var cardDiv = $(theButton).closest('.Card');
                    cardDiv.remove();
                },
                error: function() {
                    console.log(err);
                    alert('Error Happened');
                }, // End of Error Option 
            }) // End Of Ajax call 
        });
    </script>
@endsection
