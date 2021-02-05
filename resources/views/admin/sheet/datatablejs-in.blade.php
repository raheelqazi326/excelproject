<script>
    $(document).ready(function(){

        $('#spreadsheet-table').css("line-height","12.1px");
        let DataTable;
        let interests = ["sheet_upload", "approved", "rejected", "waiting_for_approve", "comment_from_colette"];
        var editor; // use a global for the submit and return data rendering in the examples
        var start = moment();
        var end = moment();
        
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            DataTable.ajax.url("{{ route('sheet.datatable') }}?type=in&start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD'));
            DataTable.ajax.reload();
        }
        
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        
        // Enable pusher logging - don't include this in production
        $(".spreadsheet-refresh").click(function(e){
            e.preventDefault();
            DataTable.ajax.reload();
        });
        editor = new $.fn.dataTable.Editor({
            ajax: {
                url:"{{ route('sheet.edit') }}",
                type: "POST",
                data:{
                    'user_id': "{{ auth()->user()->id }}",
                    'name': "{{ auth()->user()->first_name.' '.auth()->user()->last_name }}",
                    'role_id':"{{ auth()->user()->role_id }}",
                    "type": "in"
                },
                success: function(result){
                    DataTable.ajax.reload();
                }
            },
            table: "#spreadsheet-table",
            idSrc: "id",
            fields: [
                {
                    label: "Date",
                    name: "date",
                    type: "datetime",
                    def:   function () { return new Date(); }
                },
                {
                    label: "Amount",
                    name: "amount"
                },
                {
                    label: "Description",
                    name: "description"
                },
                {
                    label: "Category",
                    name: "category"
            }]
        });
        $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        // console.log(editor);
        $("#spreadsheet-table").on( 'click', 'tbody td', function (e){
            try {
                let i = $(this).index();
                editor.inline( this, {
                    onBlur: 'submit',
                    buttons: {
                        label: 'x', className: "btn-danger", fn: function () { this.close(); }
                    } 
                });
            } catch (error) {
                console.log(error);                    
            }
        });
        // $("#excelExport").on("click", function() {
        //     $(".dt-buttons .buttons-excel").trigger("click");
        // });
        $("#excelExport").on("click", function() {
            $(".dt-buttons .buttons-excel.admin-btn").trigger("click");
        });
        $('#spreadsheet-table thead tr').clone(true).appendTo( '#spreadsheet-table thead' );
        $('#spreadsheet-table thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" class='+title + i +' placeholder="Search" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( DataTable.column(i).search() !== this.value ) {
                    DataTable
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        let domTemplate = '<"row"<"col-3"l><"col-8 text-center"<"disappear"B>>><"table-responsive"rt><"row"<"col"i><"col"p>>';
        DataTable = $("#spreadsheet-table").DataTable({
            "lengthMenu": [[-1, 10, 25, 50, 100], ["All", 10, 25, 50, 100]],
            // "iDisplayLength": -1,
            dom: domTemplate,
            processing: true,
            language: {
                'loadingRecords': '&nbsp;',
                'processing': '<div class="spinner"></div>'
            }, 
            orderCellsTop: true,
            fixedHeader: true,         
            ajax: "{{ route('sheet.datatable') }}?type=in&start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD'),                
            // order: [[ 1, 'asc' ]],
            columns: [
                {
                    data: "type",
                    visible: false
                },
                {
                    data: "date",
                    type: "date"
                },
                {
                    data: "amount"
                },
                {
                    data: "description"
                },
                {
                    data: "category"
                }
                // {
                //     data: "request_grade"
                // },
                // {
                //     data: "candidate"
                // },
                // {
                //     data: "national_insurance"
                // },
                // {
                //     data: null,
                //     defaultContent: '',
                //     orderable: false,
                //     render: function ( data, type, row ) {
                //         // Combine the first and last names into a single table field
                //         let actionWrapper = $("<div/>");
                //         if(is_colette){
                //             let attr = {
                //                 "data-toggle": "tooltip",
                //                 "title": "Approve Request",
                //                 "class": "label label-success mr-1 mb-1 change-request-status",
                //                 "data-id": data.id,
                //                 "data-status": 3,
                //                 "style": "cursor:pointer"
                //             };
                //             if(!(data.status_id == 2 || data.status_id == 4)){
                //                 attr.disabled = "disabled";
                //                 attr.class = "label label-info mr-1 mb-1";
                //                 attr.title = "";
                //             }
                //             $("<span></span>").attr(attr).append($('<i class="fa fa-check"></i>')).appendTo(actionWrapper);
                //             attr.title = "Reject Request";
                //             attr.class = "label label-danger change-request-status";
                //             attr["data-status"] = 4;
                //             if(!(data.status_id == 2 || data.status_id == 3)){
                //                 attr.disabled = "disabled";
                //                 attr.class = "label label-info mr-1 mb-1";
                //                 attr.title = "";
                //             }
                //             $("<span></span>").attr(attr).append($('<i class="fa fa-times"></i>')).appendTo(actionWrapper);
                //         }
                //         else if(!is_colette){
                //             let attr = {
                //                 "data-toggle":"tooltip",
                //                 "title":"Cancel Request",
                //                 "class": "label label-danger change-request-status",
                //                 "data-id": data.id,
                //                 "data-status": 1,
                //                 "style": "cursor:pointer"
                //             }
                //             if(data.status_id == 1){
                //                 attr.disabled = "disabled";
                //                 attr.class = "label label-info mr-1 mb-1";
                //                 attr.title = "";
                //             }
                //             $("<span></span>").attr(attr).append($('<i class="fa fa-times"></i>')).appendTo(actionWrapper);
                //         }
                //         return actionWrapper.html();
                //     }
                // },
            ],
            select: false,
            buttons: [
                // {
                //     extend: 'copy',
                //     text: "Copy Spreadsheet to Clipboard",
                // },
                { extend: "create", editor: editor },
                {
                    extend: 'excel',
                    text: "Export Spreadsheet",
                    filename: 'Spreadsheet-{{ date("Y-m-d", time()) }}',
                    className: "admin-btn",
                    exportOptions:
                    {
                        columns: [ 1, 2, 3, 4 ]
                    }
                },
                /*
                { extend: "edit",   editor: editor },
                { extend: "remove", editor: editor }
                {
                    extend: "selectedSingle",
                    text: "Approve",
                    action: function ( e, dt, node, config ) {
                        // Immediately add `250` to the value of the salary and submit
                        editor
                            .edit( DataTable.row( { selected: true } ).index(), false )
                            .set( 'status', 3 )
                            .submit();
                    }
                },
                {
                    extend: "selectedSingle",
                    text: "Reject",
                    action: function ( e, dt, node, config ) {
                        // Immediately add `250` to the value of the salary and submit
                        editor
                            .edit( DataTable.row( { selected: true } ).index(), false )
                            .set( 'status', 4 )
                            .submit();
                    }
                },
                */
            ]
        });
        DataTable.on('xhr.dt', function ( e, settings, json, xhr ) {
            // Do some staff here...
            // $('#status').html( json.status );
            // console.log(settings);
            // console.log("json:", json);
            if(json === null){
                // console.log("json object is null");
                console.log("Total: ", 0);
                console.log("pending: ", 0);
                console.log("waiting for approval: ", 0);
                console.log("approved: ", 0);
                console.log("rejected: ", 0);
            }
            else{
                // console.log("json object is not null");
                console.log("Total: ", json.data.length);
                console.log("pending: ", json.data.reduce((a, o) => (o.status_id == 1 && a.push(o.value), a), []).length);
                console.log("waiting for approval: ", json.data.reduce((a, o) => (o.status_id == 2 && a.push(o.value), a), []).length);
                console.log("approved: ", json.data.reduce((a, o) => (o.status_id == 3 && a.push(o.value), a), []).length);
                console.log("rejected: ", json.data.reduce((a, o) => (o.status_id == 4 && a.push(o.value), a), []).length);
            }
        } )
        cb(start, end);
        // DataTable.rows({ search: "{{ auth()->user()->first_name.' '.auth()->user()->last_name }}" }).select();
        // console.log(DataTable.rows({selected: true}).data());
        $("#spreadsheet-table").on('click', "span.change-request-status", function(){
            console.log($(this))
            let ele = $(this);
            $.ajax({
                url: "{{ route('sheet.update.status') }}",
                type: "post",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    id: ele.data('id'),
                    status_id: ele.data('status')
                },
                success: function(result){
                    console.log(result);
                    DataTable.ajax.reload();
                },
                error: function(result){
                    // console.log(error);
                }
            });
        });
    });
</script>