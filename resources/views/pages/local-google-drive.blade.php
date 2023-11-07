<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf Preview</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fab.css') }}">
    <style>
        .btn {
            padding: 4px;
            margin: 2px;
            text-transform: capitalize;
        }
    </style>

</head>

<body>
    @if (Auth::user()->isSuperUser == 2)
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            id="floatingModalButton">
            Show
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Last Disapproved Fields</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-responsive overflow-auto">
                                <thead>
                                    <th>Field Name</th>
                                    <th>Date</th>
                                    <th>Old Value</th>
                                    <th>Disapproved Value</th>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\TempDisapprove::where('cardCode', $cardCode)->where('editor_id', request()->user()->id)->orderBy('updated_at', 'desc')->get() as $oneOfSeven)
                                        <tr>
                                            <td> {{ __($oneOfSeven->fieldName, [], 'ar') }}</td>
                                            <td> {{ $oneOfSeven->updated_at }}</td>
                                            <td> {{ $oneOfSeven->oldValue }}</td>
                                            <td> {{ $oneOfSeven->newValue }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a class="btn p-1 border border-primary" href="{{ route('get-customer-form-g', $cardCode) }}"
        id="iframeLink_x">تحميل بيانات العميل
        المسجلة حاليا</a>
    <br>
    <a class="btn p-1 border border-danger" href="{{ route('get-customer-form-g-what-if', $cardCode) }}"
        id="iframeLink_y">تحميل بيانات
        العميل في حالة
        الموافقة على التعديلات</a>

    <div id="myModal" class="modalOmola">
        <div class="modal-contentOmola">
            <span class="close">&times;</span>
            <p></p>
            <iframe id="iframe2" src="" style="width:100%; height:900px; border:0;"></iframe>
        </div>
    </div>


    <div class="container conto">
        <div class="row my-2">
            @if ($customerDocs)
                @foreach ($customerDocs as $document)
                    @if ($document->mimeType == 'pdf')
                        <div class="card col-6 ">
                            <img class="pdfmime" data-pdf-thumbnail-file="{{ asset('storage/' . $document->path) }}"
                                data-pdf-thumbnail-width="200">
                            <div class="card-header">
                                <p>{{ $document->path }}</p>
                                @if (Auth::user()->isSuperUser == 1)
                                    <a href="{{ route('delete-docu') }}" class="btn btn-danger"
                                        onclick="event.preventDefault();
                                            document.getElementById('{{ $document->id }}').submit();">Delete</a>
                                    @if (!$document->isApproved)
                                        <a href="{{ route('approve-pdf', $document->id) }}"
                                            class="btn btn-success">Approve</a>
                                        <a href="{{ route('disapprove-pdf', $document->id) }}"
                                            class="btn btn-warning">Dis-Approve</a>
                                    @endif
                                @endif

                                @if (Auth::user()->isSuperUser == 2 && $document->uploaded_id == request()->user()->id && $document->isApproved == false)
                                    {{-- This is For the pdfs Files  --}}
                                    <a href="{{ route('delete-docu') }}" class="btn btn-danger"
                                        onclick="event.preventDefault();
                                            document.getElementById('{{ $document->id }}').submit();">Delete
                                        Pdf Approve</a>
                                @endif
                                <form id="{{ $document->id }}" action="{{ route('delete-docu') }}" method="POST"
                                    class="d-none">
                                    <input type="hidden" name="docId" value="{{ $document->id }}">
                                    @csrf
                                </form>

                                <form id="{{ $document->id }}" action="{{ route('delete-before-approval') }}"
                                    method="POST" class="d-none">
                                    <input type="hidden" name="docIdBeforeApprove" value="{{ $document->id }}">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    @else
                        <div class="card col-6 ">
                            <img src="{{ asset('storage/' . $document->path) }}" alt="" class="imgmime">
                            <div class="card-header">
                                <p>{{ $document->path }}</p>
                                @if (Auth::user()->isSuperUser == 1)
                                    <div class="row">
                                        <a href="{{ route('delete-docu') }}" class="btn btn-danger"
                                            onclick="event.preventDefault();
                                            document.getElementById('{{ $document->id }}').submit();">Delete</a>
                                        @if (!$document->isApproved)
                                            <a href="{{ route('approve-pdf', $document->id) }}"
                                                class="btn btn-success">Approve</a>
                                            <a href="{{ route('disapprove-pdf', $document->id) }}"
                                                class="btn btn-warning">Dis-Approve</a>
                                        @endif
                                    </div>
                                @endif

                                @if (Auth::user()->isSuperUser == 2 && $document->uploaded_id == request()->user()->id && $document->isApproved == false)
                                    {{-- This is For Images  --}}
                                    <a href="{{ route('delete-docu') }}" class="btn btn-danger"
                                        onclick="event.preventDefault();
                                        document.getElementById('{{ $document->id }}').submit();">Delete
                                        Img Approve</a>
                                @endif

                                <form id="{{ $document->id }}" action="{{ route('delete-docu') }}" method="POST"
                                    class="d-none">
                                    <input type="hidden" name="docId" value="{{ $document->id }}">
                                    @csrf
                                </form>

                                <form id="{{ $document->id }}" action="{{ route('delete-before-approval') }}"
                                    method="POST" class="d-none">
                                    <input type="hidden" name="docIdBeforeApprove" value="{{ $document->id }}">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>


    @if (Auth::user()->isSuperUser == 1 || Auth::user()->isSuperUser == 2)
        <hr style="border-width:5px ">
        <div class="container conto">
            <form action="{{ route('handle-upload-form') }}" method="post" enctype="multipart/form-data"
                id="groupFormPdfs">
                @csrf
                <div class="mb-3">
                    <label for="formFileLg" class="form-label">Upload Customer Files(Multiple Files Ok)</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="pdfFiles[]"
                        multiple>
                    <input type="hidden" value="{{ $cardCode }}" name="code">
                </div>
                <button type="submit" class="btn btn-primary float-end">Upload</button>
            </form>
        </div>
    @endif
    <hr style="border-width:5px ">

    {{-- //TODO only show the links if the User is Is Super Admin Only  --}}
    <br>
    @if (Auth::user()->isSuperUser == 1)
        <div class="d-flex justify-content-center bg-light  conto">
            <a href="{{ route('show-archive', $cardCode) }}" class="btn btn-primary rounded-pill">Show Archived
                Files</a>
        </div>
    @endif

    <br>
    <div class="container d-flex justify-content-center align-items-center vh-100 d-none" id="central">
        <div class="spinner-grow d-none" role="status" id="loadingSpinner"></div>
    </div>
    <script src="{{ asset('js/pdfThumbnails.js') }}" data-pdfjs-src="{{ asset('js/pdf.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/code.jquery.com_jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}

    <script>
        var modal = document.getElementById("myModal");
        var frame = document.getElementById("iframe2");
        var span = document.getElementsByClassName("close")[0];
        let allImagesPdf = document.querySelectorAll('img.pdfmime'); // TODO
        let allImagesImg = document.querySelectorAll('img.imgmime'); // TODO
        allImagesPdf.forEach(imgElement => {
            imgElement.addEventListener('click', function() {
                let pdfLink = imgElement.getAttribute('data-pdf-thumbnail-file');
                frame.setAttribute('src', pdfLink);
                modal.style.display = "block";
            })
        });
        allImagesImg.forEach(imgElement => {
            imgElement.addEventListener('click', function() {
                let pdfLink = imgElement.getAttribute('src');
                frame.setAttribute('src', pdfLink);
                modal.style.display = "block";
            })
        });
        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        // groupFormPdfs
        $('#groupFormPdfs').submit(function(e) {
            $('.conto').addClass('d-none');
            $('#central').removeClass('d-none');
            $('#loadingSpinner').removeClass('d-none');
        });
    </script>
</body>

</html>
