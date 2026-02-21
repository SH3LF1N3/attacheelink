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
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Applications</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Applications</li>
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
                            <h3 class="card-title">Projects</h3>

                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            Role
                                        </th>
                                        <th style="width: 20%">
                                            Organization
                                        </th>
                                        <th style="width: 30%">
                                            Date Applied
                                        </th>
                                        <th>
                                            Project Progress
                                        </th>
                                        <th style="width: 8%" class="text-center">
                                            Status
                                        </th>
                                        <th style="width: 20%">Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                                </div>
                                            </div>
                                            <small>
                                                57% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100" style="width: 47%">
                                                </div>
                                            </div>
                                            <small>
                                                47% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                                                </div>
                                            </div>
                                            <small>
                                                77% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                </div>
                                            </div>
                                            <small>
                                                60% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar5.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="width: 12%">
                                                </div>
                                            </div>
                                            <small>
                                                12% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                                </div>
                                            </div>
                                            <small>
                                                35% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar5.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                                </div>
                                            </div>
                                            <small>
                                                87% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                                                </div>
                                            </div>
                                            <small>
                                                77% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                AdminLTE v3
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar5.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                                                </div>
                                            </div>
                                            <small>
                                                77% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
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