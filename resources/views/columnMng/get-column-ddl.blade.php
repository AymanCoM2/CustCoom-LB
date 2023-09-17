<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layouts.dash')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- $selectedOption --}}

    <div class="container">
        <form action="{{ route('col-ddl-post') }}" method="post">
            @csrf

            <div class="mb-3 row">
                <div class="col-6">
                    <select name="theDDL" class="form-select" id="theDdlWheel">
                        @foreach ($allColumnNames as $colName)
                            <option value="{{ $colName }}"
                                @if (session()->get('selectedOption')) @if ($colName == session()->get('selectedOption'))
                                   {
                                     {{ 'selected' }} 
                                   } @endif
                                @endif>
                                {{ __($colName, [], 'ar') }}
                            </option>
                        @endforeach
                    </select>
                    {{-- {{ $column->colName }} --}}
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" name="theDDLOption">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Option</button>
        </form>
        <h3 class="mt-2">Avaialble Options : </h3>
        <div class="row mt-3">
            <div class="col-6">
                <div class="container" id="cont">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
    <script>
        // FOR INITIATION 
        $('#cont').empty();
        var xxx = $("#theDdlWheel").val();
        $.ajax({
            type: 'GET',
            url: `/aja-get-col-options/${xxx}`,
            success: function(data) {
                console.log(data.data);
                var dataArray = data.data;
                // Loop through the array and create cards
                for (var i = 0; i < dataArray.length; i++) {
                    var cardContent = dataArray[i];
                    var card = $('<div class="card"><div class="card-body">' + cardContent +
                        '<a href="#" class="delete-link float-end btn btn-danger rounded-pill">-Delete</a>' +
                        '</div></div>'); // Append the card to the container
                    $('#cont').append(card);

                    card.find(".delete-link").on("click", function() {
                        // var content = $(this).siblings(".card-body").text().trim();
                        var content = $(this).closest(".card").find(".card-body").text().trim();
                        var selectedValue = $("#theDdlWheel").val();
                        console.log("Selected value: " + selectedValue);
                        // printCardContent(content);
                        let ddl = content.split('-')[0];
                        console.log(ddl);
                        deletingTheDDlOption(selectedValue, ddl);
                    });
                }
            },
            error: function() {
                console.log("Error Running the SQL query !!");
            }, // End of Error Option
        });
        // FOR INITIATION 

        var selectedValue;
        $("#theDdlWheel").on("change", function() {
            selectedValue = $(this).val();
            $('#cont').empty();
            console.log("Selected value: " + selectedValue);

            $.ajax({
                type: 'GET',
                url: `/aja-get-col-options/${selectedValue}`,
                success: function(data) {
                    console.log(data);
                    var dataArray = data.data;
                    // Loop through the array and create cards
                    for (var i = 0; i < dataArray.length; i++) {
                        var cardContent = dataArray[i];
                        var card = $('<div class="card"><div class="card-body">' + cardContent +
                            '<a href="#" class="delete-link float-end btn btn-danger rounded-pill">-Delete</a>' +
                            '</div></div>');
                        // Append the card to the container
                        $('#cont').append(card);

                        card.find(".delete-link").on("click", function() {
                            // var content = $(this).siblings(".card-body").text().trim();
                            var content = $(this).closest(".card").find(".card-body").text()
                                .trim();
                            // printCardContent(content);
                            var selectedValue = $("#theDdlWheel").val();
                            console.log("Selected value: " + selectedValue);
                            let ddl = content.split('-')[0];
                            console.log(ddl);
                            $(this).closest(".card").remove();
                            deletingTheDDlOption(selectedValue, ddl);
                        });
                    }
                },
                error: function() {
                    console.log("Error Running the SQL query !!");
                }, // End of Error Option
            });
        });


        function deletingTheDDlOption(sslOption, ddlOption) {
            // Once Deleted , Remove it from the Dom Tree Or refresh 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); // Setting Up the Ajax # 1 

            var postData = {
                ssl: sslOption,
                ddl: ddlOption
            };

            $.ajax({
                type: 'POST',
                url: "{{ route('delete-the-option') }}",
                data: postData,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    Toastify({
                        text: "Option is Deleted ",
                        duration: 3000,
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                    }).showToast();
                    // location.reload();

                },
                error: function() {
                    console.log("Error Running the SQL query !!");
                }, // End of Error Option
            });
        }
    </script>
@endsection
