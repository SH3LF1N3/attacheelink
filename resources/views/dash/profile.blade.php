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
                            <h3 class="mb-0">Profile</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="/src/assets/img/Pinnacle.jpeg"
                                            alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center">Sherry Obare</h3>

                                    <p class="text-muted text-center">Admin</p>


                                    <a data-toggle="modal" data-target="#upload" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Upload Image</a>

                                    <div class="modal fade" id="upload">
                                        <div class="modal-dialog modal-m">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Upload New Profile Picture</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="registrationForm" action="#" Method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="row">


                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputFile">Image File</label>
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="pic" accept="image/*">
                                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Change Settings</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Change Password</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">

                                        <!-- /.tab-pane -->

                                        <div class="active tab-pane" id="settings">
                                            <form action="#" Method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Name" value="Sherry" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Full Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Name" name="fname" value="Sherry Obare" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" placeholder="Email" name="email" value="Obaresherry@gmail.com" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="0712345678" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">User Type</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" value="Admin" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="tab-pane" id="password">
                                            <form id="passForm" action="{{url('/update_password')}}" Method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">New Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                                                        <span class="text-danger" id="cpass"></span>
                                                        @if($errors->has('password'))
                                                        <span class="text-danger">{{$errors->first('password')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Confirm New Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="re-password" name="password_confirmation" placeholder="Confirm Password">
                                                        <span class="text-danger" id="ccpass"></span>
                                                        @if($errors->has('password_confirmation'))
                                                        <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('dash.parts.footer')