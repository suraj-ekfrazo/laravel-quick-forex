{!! HTML::script( asset('/assets/js/bootstrap.bundle.min.js')) !!}
{!! HTML::script( asset('/assets/js/mdb.min.js')) !!}
{!! HTML::script( asset('/assets/js/popper.min.js')) !!}
{!! HTML::script( asset('/assets/js/jquery-3.4.1.min.js')) !!}
{!! HTML::script( asset('/assets/js/main.js')) !!}
{!! HTML::script( asset('/assets/js/bootstrap.min.js')) !!}
{!! HTML::script( asset('/assets/js/bootstrap4-toggle.min.js')) !!}
{!! HTML::script(asset('/assets/js/toastr.min.js')) !!}
{!! HTML::script( asset('assets/js/moment.js')) !!}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
	
	var intervalId = window.setInterval(function(){
		notifcation();
	}, 10000);

	notifcation();
	function notifcation(){
		$.ajax({
		url: "{!! route('get.notification') !!}",
			type: 'GET',
			contentType: "application/json",
			success: function(result) {
				if(result.data){
					
					var audio = document.getElementById("notificationSound");
                    audio.play();
					toastr.success(result.data);

				}
			}
		});
	}

    /*$('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');

        if ($(this).find('.btn-primary').length>0) {
            $(this).find('.btn').toggleClass('btn-primary');
        }


        $(this).find('.btn').toggleClass('btn-default');

    });*/

    /*$('form').submit(function(){
        alert($(this["options"]).val());
        return false;
    });*/

</script>

<script>
    /*$(document).ready(function() {
        $(".btn-close").click(function(){
            $('.modal').modal('hide');
        });
    } );*/
    /*$(document).ready(function() {
        $('#example1').DataTable( {
            scrollX: true,
        } );
    } );
    $(document).ready(function() {
        $('#example3').DataTable();
    } );
    $(document).ready(function() {
        $('#example4').DataTable();
    } );
    $(document).ready(function() {
        $('#example5').DataTable( {
            scrollX: true,
        } );
    } );
    $(document).ready(function() {
        $('#example6').DataTable( {
            scrollX: true,
        } );
    } );*/
</script>
