<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('front-assets') }}/" data-template="vertical-menu-template-free">

@include('front.partial.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('front.partial.side')

            <!-- Layout container -->
            <div class="layout-page">
                @include('front.partial.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')

                    @include('front.partial.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('front.partial.script')
</body>

</html>
