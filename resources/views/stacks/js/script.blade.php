{!! HTML::script( asset('/assets/js/bootstrap.bundle.min.js')) !!}
{!! HTML::script( asset('/assets/js/mdb.min.js')) !!}
{!! HTML::script( asset('/assets/js/popper.min.js')) !!}
{!! HTML::script( asset('/assets/js/jquery-3.4.1.min.js')) !!}
{!! HTML::script( asset('/assets/js/main.js')) !!}
{!! HTML::script( asset('/assets/js/bootstrap.min.js')) !!}
{!! HTML::script( asset('/assets/js/bootstrap4-toggle.min.js')) !!}
{!! HTML::script( asset('/assets/js/jquery.dataTables.min.js')) !!}
{!! HTML::script( asset('/assets/js/select2.min.js')) !!}
{!! HTML::script(asset('/assets/js/toastr.min.js')) !!}
{!! HTML::script( asset('assets/js/moment.js')) !!}

<script>
	
	 var intervalId = window.setInterval(function(){
        notifcation();
    }, 10000);

    notifcation();
    function notifcation(){
        $.ajax({
        url: "{!! route('get.notifications') !!}",
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
    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');

        if ($(this).find('.btn-primary').length>0) {
            $(this).find('.btn').toggleClass('btn-primary');
        }


        $(this).find('.btn').toggleClass('btn-default');

    });

    /*$('form').submit(function(){
        alert($(this["options"]).val());
        return false;
    });*/

</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
    $(document).ready(function() {
        $('#example3').DataTable();
    } );
    $(document).ready(function() {
        $('#example4').DataTable();
    } );
    $(document).ready(function() {
        $('#example5').DataTable( {

        } );
    } );
</script>

<script>

    $( '#single-select-field' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );

</script>

<script>

    var awsmDialog = (function(){
        function $(selector){
            return document.querySelector(selector);
        }

        function create(tag, cl, txt){
            var el = document.createElement('div');
            el.className = cl;
            if(txt){
                var newContent = document.createTextNode(txt);
                el.appendChild(newContent);
            }
            return el;
        }

        var dialog = $('.awsm-dialog'),
            okCallback = null,
            cancelCallback = null;

        function init(){
            if(dialog) return;

            dialog = create('div', 'awsm-dialog');

            var divContent = create('div', 'awd-content');

            dialog.appendChild(divContent);

            var pMessage = create('p', 'awd-message', 'Are you sure?');

            divContent.appendChild(pMessage);

            var btnOk = create('button', 'btn awd-ok', 'Yes');

            divContent.appendChild(btnOk);

            var btnCancel = create('button', 'btn awd-cancel', 'No');

            divContent.appendChild(btnCancel);

            document.querySelector('body').append(dialog);
        }

        function open(message){
            init();
            okCallback = null;
            cancelCallback = null;
            $('.awd-message').innerText = message;
            show();
            return this;
        }

        function show(){
            dialog.style.display = 'block';
            ok();
            cancel();
        }

        function ok(callback){

            okCallback = callback;

            $('.awd-ok').onclick = function(ev){

                hide();

                if(okCallback){

                    okCallback();

                }
            };

            return this;
        }

        function cancel(callback){

            cancelCallback = callback;

            $('.awd-cancel').onclick = function(ev){

                hide();

                if(cancelCallback){

                    cancelCallback();

                }
            }
        }

        function hide(){
            dialog.className = 'awsm-dialog animated bounceOutDown';

            setTimeout(function(){
                dialog.style.display = 'none';
                dialog.className = 'awsm-dialog animated bounceIn';
            }, 1000);
        }

        return {
            open,
            ok,
            cancel
        };

    })();

    var btn = document.querySelector('.btn-dialog');

    btn.addEventListener('click', function(ev){
        ev.preventDefault();

        awsmDialog.open('Are You Sure To Confirm This Deal?');
    })


    // for creating preview screenshot

    var btnOk = document.querySelector('.awd-ok');

    function demo(){


        setInterval(function(){
            btn.click()
        }, 1000);

        setInterval(function(){
            btnOk.click();
        }, 3000);
    }

    if (document.location.pathname.indexOf('fullcpgrid')>-1){
        demo();
    }
</script>
