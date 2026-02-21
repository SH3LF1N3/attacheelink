@include('dash.parts.head')
<style>
    .job-card {
        border-radius: 14px;
        border: 1px solid #e8e8e8;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .job-icon-box {
        width: 52px;
        height: 52px;
        background: #f4f5f7;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #888;
        flex-shrink: 0;
    }

    .badge-internship {
        background-color: #e6f9f0;
        color: #1db870;
        font-weight: 500;
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 20px;
    }

    .btn-apply {
        background-color: #1a2b4a;
        color: #fff;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        white-space: nowrap;
    }

    .btn-apply:hover {
        background-color: #243860;
        color: #fff;
    }

    .meta-info {
        font-size: 0.85rem;
        color: #888;
        gap: 16px;
    }

    .meta-info span {
        display: flex;
        align-items: center;
        gap: 4px;
    }
</style>

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
                            <h3 class="mb-0">Opportunities</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Opportunities</li>
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
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">

                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Search by title, company, or keywords">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <select class="custom-select form-control-border" id="exampleSelectBorder">
                                                        <option>Select Location</option>
                                                        <option>Nairobi</option>
                                                        <option>Nakuru</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <select class="custom-select form-control-border" id="exampleSelectBorder">
                                                        <option>Select a Keyword</option>
                                                        <option>Software Engineering</option>
                                                        <option>Marketing</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search"></i> Search</button>
                                            </div>


                                        </div>

                                    </div>

                                </form>
                            </div>
                            <!-- /.card -->

                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->

                        <!--/.col (right) -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="card job-card p-3 p-md-4">
                                    <div class="d-flex align-items-center gap-3">

                                        <!-- Icon -->
                                        <div class="job-icon-box">
                                            <i class="bi bi-briefcase"></i>
                                        </div>

                                        <!-- Info -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-start justify-content-between flex-wrap gap-2">
                                                <div>
                                                    <h6 class="fw-bold mb-0" style="font-size: 1.05rem; color: #1a1a2e;">Software Engineering Intern</h6>
                                                    <p class="mb-2 text-muted" style="font-size: 0.9rem;">Safaricom PLC</p>
                                                    <div class="d-flex flex-wrap meta-info">
                                                        <span><i class="bi bi-geo-alt"></i> Nairobi</span>
                                                        <span><i class="bi bi-clock"></i> 3 months</span>
                                                        <span><i class="bi bi-calendar3"></i> Deadline: Oct 20</span>
                                                    </div>
                                                </div>
                                                <!-- Badge + Button -->
                                                <div class="d-flex flex-column align-items-end gap-2">
                                                    <span class="badge-internship">Internship</span>
                                                    <button class="btn btn-apply">Apply Now</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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