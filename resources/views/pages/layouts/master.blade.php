<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    @include("pages.layouts.css.style_css")

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include("pages.layouts.components.sidebar")

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include("pages.layouts.components.topbar")

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            @stack("title")
                        </h1>
                    </div>

                    <!-- Content Row -->
                    @stack("content-modules")
                </div>
            </div>
            <!-- End of Main Content -->

            @include("pages.layouts.components.footer")

        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include("pages.layouts.components.modal_logout")

    @include("pages.layouts.javascript.style_javascript")

</body>

</html>
