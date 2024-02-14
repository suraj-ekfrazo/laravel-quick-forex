{!! HTML::script(asset('assets/js/jquery.dataTables.min.js')) !!}
{!! HTML::script("//cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js") !!}
{{--{!! HTML::script(asset('assets/plugins/datatables/datatables.min.js')) !!}
{!! HTML::script(asset('assets/plugins/datatables/dataTables.bootstrap.min.js')) !!}--}}

<script>

    var dataTableOptions = {
        dom:'<"top"fl>'+
            '<""' +
            'rt' +
            '<"datatable-footer container-fluid"' +
            '<"datatable-footer-inner row"' +
            '<"col"' +
            '<"page-count pull-right"i>' +
            '>' +
            '<"col-md-auto col"' +
            '<"datatable-pager"p>' +
            '>' +
            '>' +
            '>' +
            '>',
        /*dom: '<"top"i>rt<"bottom"flp><"clear">',*/
        processing: false,
        serverSide: true,
        searching: true,
        lengthChange: true,
        lengthMenu: [[10, 100, 200, -1], [10, 50, 100, "All"]],
        aaSorting: [[0, "desc"]],
        pageLength: 10,
        pagingType: 'full_numbers',
        order: [[0, "asc"]],
        language: {
            sProcessing: "Processing...",
            sLengthMenu: "Show _MENU_ entries",
            sZeroRecords: "{{trans('app.no_records')}}",
            sInfo: "Showing _START_ to _END_ of _TOTAL_ entries",
            sInfoEmpty: "Showing 0 to 0 of 0 entries",
            sInfoFiltered: "{{trans('app.pagination_filtered')}}",
            sInfoPostFix: "",
            sSearch: "search",
            sUrl: "",
            sEmptyTable: "No data available in table.",
            sLoadingRecords: "{{trans('app.loading')}}",
            sInfoThousands: ",",
            oPaginate: {
                sFirst: 'Previous',
                sLast: "Last",
                sNext: '<svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z"></path></svg>',
                sPrevious: '<svg class="svg-inline--fa fa-chevron-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M224 480c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25l192-192c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l169.4 169.4c12.5 12.5 12.5 32.75 0 45.25C240.4 476.9 232.2 480 224 480z"></path></svg>'
            },
            oAria: {
                sSortAscending: ": activate to sort column ascending",
                sSortDescending: ": activate to sort column descending"
            },
        }
    };

    function callDataTable(element, url, filters, columns, dataFilter, drawCallBack, columnDefs,createdRow,scrollXValue=null) {
        var dataTable = $('#' + element);
        return dataTable.DataTable({
            ...dataTableOptions,
            "destroy":true,
            ajax: {
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: "application/json",
                dataType: "json",
                data: function (json) {
                    /*console.log("json");*/
                    /*console.log(json);*/
                    json = {...json, ...filters};
                    return JSON.stringify(json);
                },
                dataFilter: dataFilter
            },
            /*scrollX: !!scrollXValue,*/
            columns: columns,
            columnDefs: columnDefs,
            drawCallback: drawCallBack,
            createdRow:createdRow
        });
    }

</script>
