<!-- BEGIN: Vendor JS-->

<!-- ENDs Vendor JS-->

<!-- BEGIN: Theme JS-->

{!! HTML::script( asset('/assets/js/bootstrap.bundle.min.js')) !!}
{!! HTML::script( asset('/assets/js/mdb.min.js')) !!}
{!! HTML::script( asset('/assets/js/jquery-3.4.1.min.js')) !!}

<!-- General JS Scripts -->
<script>
    // Password show/hide
    $(document).ready(function() {
        $(".login-password").mousedown(function() {
            $("#password").attr("type", "text");
            $(".password-eye").removeClass("fa-eye-slash");
            $(".password-eye").addClass("fa-eye");
        });
        $(".login-password").mouseup(function() {
            $("#password").attr("type", "password");
            $(".password-eye").addClass("fa-eye-slash");
            $(".password-eye").removeClass("fa-eye");
        });
    })

    // Reset show/hide
    $(document).ready(function() {
        $(".reset-password").mousedown(function() {
            $("#password_confirmation").attr("type", "text");
            $(".reset-password-eye").removeClass("fa-eye-slash");
            $(".reset-password-eye").addClass("fa-eye");
        });
        $(".reset-password").mouseup(function() {
            $("#password_confirmation").attr("type", "password");
            $(".reset-password-eye").addClass("fa-eye-slash");
            $(".reset-password-eye").removeClass("fa-eye");
        });
    })
</script>
<!-- END: Theme JS-->
