<script>
    $(document).ready(function(){
        $('#spreadsheet-table').css("line-height","12.1px");
        let DataTable;
        let interests = ["sheet_upload", "approved", "rejected", "waiting_for_approve", "comment_from_colette"];
        var editor; // use a global for the submit and return data rendering in the examples
        var is_colette = {{ auth()->user()->role_id == 2?1:0 }};
        var is_user = {{ auth()->user()->role_id == 3?1:0 }};
        
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('c091dc9b8b47adbbc4ee', {
            cluster: 'ap2'
        });
        if(is_colette){
            interests = ["waiting_for_approve"];
        }
        else if(is_user){
            interests = ["sheet_upload", "approved", "rejected", "comment_from_colette"];        
        }
        var channel = pusher.subscribe('online-spreadsheet');
        const beamsClient = new PusherPushNotifications.Client({
            instanceId: '9bbe1ce1-37b6-4263-b669-e8528a3a8630',
        });

        beamsClient.start()
            .then(() => {
                $.each(interests, (i, val) => {
                    beamsClient.addDeviceInterest(val)
                })
            })
            .then(() => console.log('Successfully registered and subscribed!'))
            .catch(console.error);

        $(".spreadsheet-refresh").click(function(e){
            // window.location.reload();
            e.preventDefault();
            DataTable.ajax.reload();
        });
        channel.bind('App\\Events\\SheetUpdate', function(data) {
            // alert(JSON.stringify(data));
            // console.log(data);
            // console.log(DataTable);
            DataTable.ajax.reload();
        });
        // channel.bind('App\\Events\\SheetUpdate', function(data) {
        //     alert(JSON.stringify(data));
        //     // console.log(data);
        //     // console.log(DataTable);
        //     DataTable.ajax.reload();
        // });
        // channel.bind('sheet-update', function(data) {
        //     alert(JSON.stringify(data));
        //     // console.log(data);
        //     // console.log(DataTable);
        //     DataTable.ajax.reload();
        // });
        let fields = [];
        if(is_colette){
            fields = [{
                    label: "Comment From Colette:",
                    name: "comment_from_colette"
                },
                {
                    label: "Status:",
                    name: "status"
                }
            ];
        }
        else{
            fields = [{
                    label: "Candidate:",
                    name: "candidate"
                },
                {
                    label: "National Insurance:",
                    name: "national_insurance"
                }
            ];
        }
        editor = new $.fn.dataTable.Editor({
            ajax: {
                url:"{{ route('sheet.edit') }}",
                type: "POST",
                data:{
                    'role_id':{{ auth()->user()->role_id }}
                }
            },
            table: "#spreadsheet-table",
            idSrc: "id",
            fields: fields
        });
        $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        // console.log(editor);
        $("#spreadsheet-table").on( 'click', 'tbody td', function (e){
            try {
                let i = $(this).index();
                // console.log(is_colette);
                if (!is_colette && (i == 6 || i == 7)){
                    editor.inline( this, {
                        onBlur: 'submit'
                    });
                }
                else if (is_colette && (i == 10)){
                    editor.inline( this, {
                        onBlur: 'submit'
                    });
                }
            } catch (error) {
                console.log(error);                    
            }
        });
        $("#excelExport").on("click", function() {
            $(".dt-buttons .buttons-excel").trigger("click");
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
        let domTemplate = '<"row"<"col-3"l><"col-5 text-center"<"disappear"B>><"col-4"f>><"table-responsive"rt><"row"<"col"i><"col"p>>';
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
            ajax: "{{ route('sheet.datatable') }}",
            // order: [[ 1, 'asc' ]],
            columns: [
                {
                    data: "request_id"
                },
                {
                    data: "date",
                    type: "date"
                },
                {
                    data: "start",
                    type: "datetime"
                },
                {
                    data: "end",
                    type: "datetime"
                },
                {
                    data: "ward"
                },
                {
                    data: "request_grade"
                },
                {
                    data: "candidate"
                },
                {
                    data: "national_insurance"
                },
                {
                    data: null,
                    defaultContent: '',
                    orderable: false,
                    render: function ( data, type, row ) {
                        // Combine the first and last names into a single table field
                        let actionWrapper = $("<div/>");
                        if(is_colette){
                            let attr = {
                                "data-toggle":"tooltip",
                                "title":"Approve Request",
                                "class": "label label-success mr-1 mb-1 change-request-status",
                                "data-id": data.id,
                                "data-status": 3,
                                "style": "cursor:pointer"
                            };
                            if(!(data.status_id == 2 || data.status_id == 4)){
                                attr.disabled = "disabled";
                                attr.class = "label label-info mr-1 mb-1";
                                attr.title = "";
                            }
                            $("<span></span>").attr(attr).append($('<i class="fa fa-check"></i>')).appendTo(actionWrapper);
                            attr.title = "Reject Request";
                            attr.class = "label label-danger change-request-status";
                            attr["data-status"] = 4;
                            if(!(data.status_id == 2 || data.status_id == 3)){
                                attr.disabled = "disabled";
                                attr.class = "label label-info mr-1 mb-1";
                                attr.title = "";
                            }
                            $("<span></span>").attr(attr).append($('<i class="fa fa-times"></i>')).appendTo(actionWrapper);
                        }
                        else if(!is_colette){
                            let attr = {
                                "data-toggle":"tooltip",
                                "title":"Cancel Request",
                                "class": "label label-danger change-request-status",
                                "data-id": data.id,
                                "data-status": 1,
                                "style": "cursor:pointer"
                            }
                            if(data.status_id == 1){
                                attr.disabled = "disabled";
                                attr.class = "label label-info mr-1 mb-1";
                                attr.title = "";
                            }
                            $("<span></span>").attr(attr).append($('<i class="fa fa-times"></i>')).appendTo(actionWrapper);
                        }
                        return actionWrapper.html();
                    }
                },
                {
                    data: "status.name"
                },
                {
                    data: "comment_from_colette"
                }
                
            ],
            select: false,
            buttons: [
                // {
                //     extend: 'copy',
                //     text: "Copy Spreadsheet to Clipboard",
                // },
                {
                    extend: 'excel',
                    text: "Export Spreadsheet",
                    filename: 'Spreadsheet-{{ date("Y-m-d", time()) }}',
                    exportOptions:
                    {
                        columns: [ 1, 2, 3, 4, 5, 6, 7, 9, 10 ]
                    }
                },
                /*
                { extend: "create", editor: editor },
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