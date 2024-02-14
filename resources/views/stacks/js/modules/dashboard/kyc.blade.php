<script>
    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'txn_number', orderable: false},
                {data: 'customer_name', orderable: false},
                {data: 'txn_type', orderable: false},
                {data: 'booking_purpose_id', orderable: false},
                {data: 'id', orderable: false},
            ],
            columnDefs = [
				{
                    "targets": [2],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
						if(full.txn_type=='1'){
							return "Remittance";
						}
						else{
							return "Card";
						}
                    }
                },
				{
                    "targets": [3],
                    className: 'r-col-action',
					render: function (data, type, full, meta) {
						return full.purpose_data.purpose_name;
                    	}
                },

                {
                    "targets": [4],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return '<a href="dashboard/view-kyc-doc/'+full.txn_number+'" class="text-white bg-danger border-0 p-1 rounded-4" target="_blank"> View KYC Docs\n' +
                            '</a>';
                    }
                }
            ],
            dataTable = callDataTable('kyc-status-table', '{!! route('transactionkyc.data') !!}', filters, columns, '', '', columnDefs);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#kyc-status-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#kyc-status-table').DataTable().page.len($(this).val()).draw();
        });

    });

    setInterval(function () {
        $('.sorting_desc').removeClass('sorting_desc');
    }, 1000);

    /* $('#updateDocForm').submit(function (event) {
        var status = document.activeElement.innerHTML;
        event.preventDefault();
        if (status) {
            $('.ajax-error').html('');
            var data = new FormData(this);

            $.ajax({
                url: $(this).attr("action"),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                    //$(this).attr("disabled", false);
                    if (result.type === 'SUCCESS') {
                        toastr.success(result.message);
                        getCustomersList();
                        $('.modal').modal('hide');
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function (error) {
                    $(this).attr("disabled", false);
                    let errors = error.responseJSON.errors, errorsHtml = '';
                    $.each(errors, function (key, value) {
                        errorsHtml = '<strong>' + value[0] + '</strong>';
                        $('.' + key).html(errorsHtml);
                    });
                }
            });
        }
    }); */
	
	$(document).ready(function() {
        $(document).on("click", ".updateDoc", function() {
            var tr = $(this).closest("tr");
            var id = $(this).data("doc_id");
            var doc_type = $(this).attr("name");
            //alert(doc_type);
            var inci_type = $("#inci_type").val();

            $(".has_error").remove();
            $(".status_error").text('');
            $.ajax({
                type: "GET",
                url: '{{ route('dashboard.kyc-single-update-document-status') }}',
                data: {
                    status: $(this).val(),
                    comment: tr.find(".comment").val(),
                    id: id,
                    doc_type: doc_type,
                    inci_type: inci_type
                },
                success: function(result) {
                    //console.log(result);
                    window.location.reload();
                }
            }).fail(function(response, status, error) {
                var data = response.responseJSON;
                if (status === 'error') {
                    $.each(data.errors, function(i, val) {
                        $("textarea[name=" + i + "]").after(
                            '<div class="text-danger has_error">' + val + '</div>');
                    });
                }
            });
        })
    });
	
	
	$('#updateDocForm').submit(function(event) {
		var valueData = document.querySelector('input[name="kyc_status"]:checked').value;
		
		
		
		
        event.preventDefault();
        $('.status_error').html('');
        var check = $('input[name=kyc_status]').is(':checked');

        if (check) {

            swal({
                title: "Are you sure you want to perform this action?",
                text: "",
                icon: "success",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancel", "Confirm"],
            }).then((willDelete) => {
                if (willDelete) {
                    var typesArray = [];
            var typesA = [];
            var commentArray = [];
            var types = '';
            var id = $('.datas').val();
            $('.datas').each(function() {
                var key = $(this).attr('data-key');
                var comment = $('#textarea_' + key).val();
                var checked = $(this).is(':checked');
                var obj = {
                    type: key,
                    comment: comment,
                    checked: checked
                };
                typesArray.push(obj);

            });

            $.ajax({
                type: 'POST',
                url: '{{ route('dashboard.kyc-multiple-update-document-status') }}',
                data: {
                    id: id,
                    typesArray: typesArray,
				
                    status: valueData == '1' ? 1 : 2,
                    comment: $('input[name=kyc_comment]').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.status == true) {
                       location.reload();
                    } else {
                    }
                }
            });
                }
            });

        } else {

            $('.status_error').html('Please Select Status');
            setTimeout(function() {
                $('.status_error').html('');
            }, 2000);
        }
    });
</script>
