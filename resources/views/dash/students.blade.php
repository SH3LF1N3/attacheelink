@include('dash.parts.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('dash.parts.topnav')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('dash.parts.sidenav')
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">


                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Students</h3>
                            <br>
                            <div class="col-sm-4">
                                <a data-toggle="modal" data-target="#add" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add Student</a>
                            </div>

                            @include('dash.modals.addstudent')
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Students</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!-- page content goes here -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Staff Lists</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Staff ID</th>
                                        <th>User Name</th>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Department</th>
                                        <th>Reg Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--end page content-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('dash.parts.footer')