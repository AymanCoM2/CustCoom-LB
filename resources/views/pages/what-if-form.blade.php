@php
    $oneDay = 60 * 60 * 24;
    $oneYear = 365 * $oneDay;
    $today = date('Y-m-d ');
    $fixedPeriod = $oneDay * 30;
    $allDDLColumn = App\Models\ColumnType::where('colType', 'ddl')
        ->pluck('colName')
        ->all();
    $r = App\Models\EditHistory::where('cardCode', $customerMySqlData->CardCode)
        ->where('isApproved', 0)
        ->get()
        ->makeHidden(['created_at', 'updated_at'])
        ->toArray();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />

    <link href="{{ asset('css/bootstrap5.css') }}" rel="stylesheet" />
    <title>Customer Form Grouping</title>
    <style>
        body {

            background-color: rgba(176, 165, 165, 0.757);
            color: black;
        }

        input[type="radio"]:checked+label {
            background-color: #e2f9185b;
            color: rgb(8, 0, 0rgba(133, 132, 132, 0.5) border-color: #007BFF;
            }
    </style>
</head>

<body>
    <div class="alert alert-danger">
        <p>This is a page To View For What if Updates are Approved</p>
        <a href="{{ route('customer-drive', $cardCode) }}" id="iframeLink2">Back To Docs</a>
    </div>

    @if ((bool) $r)
        <input type="hidden" name="id" value="{{ $customerMySqlData->id }}">
        <input type="hidden" name="CardCode" value="{{ $customerSapData['CardCode'] }}">
        <input type="hidden" name="created_at" value="">
        <input type="hidden" name="updated_at" value="">
        @include('layouts.sep', ['variableName' => 'Group - 1'])
        @include('what-if-groups.group-1')
        @include('layouts.sep', ['variableName' => 'Group - 2'])
        @include('what-if-groups.group-2')
        @include('layouts.sep', ['variableName' => 'Group - 3'])
        @include('what-if-groups.group-3')
        @include('layouts.sep', ['variableName' => 'Group - 4'])
        @include('what-if-groups.group-4')
        @include('layouts.sep', ['variableName' => 'Group - 5'])
        @include('what-if-groups.group-5')
        @include('layouts.sep', ['variableName' => 'Group - 6'])
        @include('what-if-groups.group-6')
        @include('layouts.sep', ['variableName' => 'Group - 7'])
        @include('what-if-groups.group-7')
    @endif

    {{-- <div class="disabled-overlay" id="overlay"></div> --}}
    <br>

    <script src="{{ asset('js/code.jquery.com_jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iframe1 = document.getElementById('iframe1');
            const iframe2 = document.getElementById('iframe2');
            iframe2.addEventListener('load', function() {
                const iframeLink2 = iframe2.contentDocument.getElementById('iframeLink2');
                iframeLink2.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior
                    const linkUrl = iframeLink2.getAttribute('href');
                    iframe2.src = linkUrl; // Load the linked URL in iframe2
                });


            });
        });
    </script>

    @include('unified.collect')
</body>


</html>
