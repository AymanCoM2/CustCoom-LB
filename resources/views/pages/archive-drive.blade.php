<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf Preview</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customModal.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row my-2">
            @if ($arcihedFiles)
                @foreach ($arcihedFiles as $document)
                    @if ($document->mimeType == 'pdf')
                        <div class="card col-6 ">
                            <img data-pdf-thumbnail-file="{{ asset('storage/' . $document->path) }}"
                                data-pdf-thumbnail-width="200">
                            <div class="card-header">
                                <p>{{ explode('--', $document->path)[1] }}</p>

                                @if (Auth::user()->isSuperUser == 1)
                                    <div class="row">
                                        <a href="{{ route('restore-docu') }}" class="btn btn-success"
                                            onclick="event.preventDefault();
                                        document.getElementById('{{ $document->id }}').submit();">Restore</a>
                                    </div>
                                @endif

                                <form id="{{ $document->id }}" action="{{ route('restore-docu') }}" method="POST"
                                    class="d-none">
                                    <input type="hidden" name="docId" value="{{ $document->id }}">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    @else
                        <div class="card col-6 ">
                            <img src="{{ asset('storage/' . $document->path) }}" alt="" class="imgmime"
                                width="200">

                            @if (Auth::user()->isSuperUser == 1)
                                <div class="row">
                                    <a href="{{ route('restore-docu') }}" class="btn btn-success"
                                        onclick="event.preventDefault();
                                    document.getElementById('{{ $document->id }}').submit();">Restore</a>
                                </div>
                            @endif

                            <form id="{{ $document->id }}" action="{{ route('restore-docu') }}" method="POST"
                                class="d-none">
                                <input type="hidden" name="docId" value="{{ $document->id }}">
                                @csrf
                            </form>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

    </div>

    <hr style="border-width:5px ">
    <a href="{{ route('customer-drive', $cardCode) }}">Back to the Local Drive</a>
    <hr style="border-width:5px ">

    <br>

    <br>

    <script src="{{ asset('js/pdfThumbnails.js') }}" data-pdfjs-src="{{ asset('js/pdf.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/code.jquery.com_jquery-3.7.0.js') }}"></script>

    <script></script>
</body>

</html>
