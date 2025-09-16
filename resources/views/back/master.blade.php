<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('back-assets') }}/" data-template="vertical-menu-template-free">

@include('back.partial.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('back.partial.side')

            <!-- Layout container -->
            <div class="layout-page">
                @include('back.partial.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')

                    @include('back.partial.footer')

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

    @include('back.partial.script')
</body>

</html>
