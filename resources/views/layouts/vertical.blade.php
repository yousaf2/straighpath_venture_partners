<!DOCTYPE html>
    <html lang="en">

    <head>
        @include('layouts.shared/title-meta', ['title' => $title])
        @include('layouts.shared/head-css')
        {{-- @include('layouts.shared/head-css', ["demo" => "modern"]) --}}
    </head>

    <body @yield('body-extra')>
        <!-- Begin page -->
        <div id="wrapper">
            @include('layouts.shared/topbar')

            @include('layouts.shared/left-sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">                    
                    @yield('content')
                </div>
                <!-- content -->

                @include('layouts.shared/footer')

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        @include('layouts.shared/right-sidebar')

        @include('layouts.shared/footer-script')
        <script>
            $(document).ready(function () {
                //do load page changes
            });
            $(document).on('click','a#add-more',function () {
                var type = $(this).data('type');
                if(type === "address"){
                    var totalAddresses = $(this).parents('.form-group').find('input').length;
                    $(this).parents('form').find('input#ac').val(totalAddresses);
                    $(this).parents('.form-group').append('<input class="form-control mt-2" name="address_'+totalAddresses+'" type="text" id="address" placeholder="Enter your address" value="{{ old('address')}}"/>')
                }
                if(type === "phone"){
                    var totalPhones = $(this).parents('.form-group').find('input').length;
                    $(this).parents('form').find('input#pc').val(totalPhones);
                    $(this).parents('.form-group').append('<input class="form-control mt-2" name="phone_'+totalPhones+'" type="text" id="phone" placeholder="Enter your phone" value="{{ old('phone')}}"/>')
                }
                if(type === "position"){
                    alert('Work is in progress, updating ASAP.')
                }
            });
            $('.datepicker').datepicker();
        </script>
    </body>
</html>