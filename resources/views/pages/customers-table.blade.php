<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layouts.dash')

@section('content')
    <div class="container-fluid mt-3 p-0 "> <!-- Changed mx-5 to mx-auto to center the table -->
        <div class="container-fluid p-0">
            <div class="w-75 wrapper" style="margin-right: 0;">
                <!-- Reduced width to 75% and centered to prevent hiding under the sidebar -->
                {{-- table table-bordered --}}
                <table class="table table-success table-hover data-table p-0">
                    <thead>
                        <tr id="the-heading" class="">
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); // Setting Up the Ajax # 1 

        var columns = [];
        $.ajax({
            type: 'POST',
            url: "{{ route('post-all-customers') }}",
            success: function(data) {
                console.log(data);
                const x = data.data;
                const columnNames = data.keys;
                for (var i of columnNames) {
                    columns.push({
                        data: i,
                        name: i
                    });
                }
                document.getElementById("the-heading").innerHTML = data.row;
                // $("#the-heading").html = data.row;

                // var pdfMake;
                // pdfMake.fonts = {
                //     Roboto: {
                //         normal: 'Roboto-Italic.ttf',
                //         bold: 'Roboto-Italic.ttf',
                //         italics: 'Roboto-Italic.ttf',
                //         bolditalics: 'Roboto-Italic.ttf'
                //     }
                // }; // Setting Up the Fonts For the Pdf  Report 
                table = jQuery('.data-table').DataTable({
                    "columnDefs": [{
                        "targets": 1,
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#d3d3d3');
                            $(td).html(
                                // '<a style=" text-decoration: none;" href="' +
                                // '{{ url('/dash/customer-data/drive') }}' +
                                // '/' + cellData + '" >' +
                                // cellData + "(Drive)" + '</a>' + '<br/>' +
                                '<a  style="color:red; text-decoration: none;" href="' +
                                '{{ url('/dash/customer-data/local') }}' +
                                '/' + cellData + '" >' +
                                cellData + "(Local)" + '</a>' + '<br/>' +
                                '<a  style="color:green; text-decoration: none;" href="' +
                                '{{ url('/user-drive-standalone') }}' +
                                '/' + cellData + '" >' + "Files" + '</a>'
                            )
                        }
                    }, {
                        "targets": [6, 7, 8, 9, 10],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            const roundedValue = Math.round(cellData * 100) /
                                100;
                            $(td).html(roundedValue);
                        }
                    }],

                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'csv',
                            className: 'btn btn-primary shadow '
                        }, {
                            extend: 'excelHtml5',
                            className: 'btn btn-success shadow ',
                            title: null
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger shadow ',
                            charset: "utf-8",
                            pageSize: 'A0',
                            bom: true,
                            orientation: 'landscape',
                            customize: function(doc) {
                                doc.defaultStyle.font = "Roboto";
                            }
                        },
                    ],
                    // scrollX: true,
                    // x-scrolling:true  , 
                    fixedColumns: {
                        left: 2,
                        // right: 1
                    },
                    // paging: false,
                    // scrollCollapse: true,
                    // scrollX: true,
                    // scrollY: 300,
                    autoWidth: false,
                    order: [],
                    // paging: true,
                    // deferRender: true,
                    retrieve: false,
                    processing: true,
                    serverSide: false,
                    searchable: true,
                    searching: true,
                    data: x,
                    pageLength: 75,
                    columns: columns,
                    initComplete: function() {
                        this.api()
                            .columns()
                            .every(function() {
                                let column = this;
                                let input = document.createElement('input');
                                input.classList.add("rounded");
                                input.classList.add("w-100");
                                input.classList.add("m-auto");
                                input.classList.add("d-block");
                                input.classList.add("border-primary");
                                input.classList.add("shadow");
                                column.header().prepend(input);
                                input.addEventListener('input', () => {
                                    if (column.search() !== this
                                        .value) {
                                        column.search(input.value)
                                            .draw();
                                    }
                                });
                                $('input').click(function(e) {
                                    e.stopPropagation();
                                });
                            });
                        // alert(timeElapsed);
                    }, // initComplete END 
                }); // End Of Making the New Data Table 
            },
            error: function(e) {
                console.log(e);
            }, // End of Error Option 
        }) // End Of Ajax call 
    });
</script>
</body>

</html>
