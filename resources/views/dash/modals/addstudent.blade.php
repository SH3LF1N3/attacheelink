<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" action="#" Method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
                                    <span id="usere" class="text-danger"></span>
                                    @if($errors->has('username'))
                                    <span class="text-danger">{{$errors->first('username')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name="full_name" id="fname" placeholder="Enter Full Name" required>
                                    <span id="fnamee" class="text-danger"></span>
                                    @if($errors->has('full_name'))
                                    <span class="text-danger">{{$errors->first('full_name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" required>
                                    <span id="emaile" class="text-danger"></span>
                                    @if($errors->has('email'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required>
                                    <span id="phonee" class="text-danger"></span>
                                    @if($errors->has('phone'))
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control select2bs4" style="width: 100%;">
                                        <option selected disabled>Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Rather Not Say</option>
                                    </select>
                                    <span id="gene" class="text-danger"></span>
                                    @if($errors->has('gender'))
                                    <span class="text-danger">{{$errors->first('gender')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control select2bs4" style="width: 100%;">
                                        <option selected disabled>Select Status</option>
                                        <option>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                    <span id="state" class="text-danger"></span>
                                    @if($errors->has('status'))
                                    <span class="text-danger">{{$errors->first('status')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Department/Group</label>
                                    <select name="department" id="dept" class="form-control select2bs4" style="width: 100%;">
                                        <option selected disabled>Select Department</option>

                                    </select>
                                    <span id="depte" class="text-danger"></span>
                                    @if($errors->has('department'))
                                    <span class="text-danger">{{$errors->first('department')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>User Type</label>
                                    <select name="type" id="type" class="form-control select2bs4" style="width: 100%;">
                                        <option selected disabled>Select Type</option>

                                    </select>
                                    <span id="typee" class="text-danger"></span>
                                    @if($errors->has('type'))
                                    <span class="text-danger">{{$errors->first('type')}}</span>
                                    @endif
                                </div>
                            </div>

                        </div>


                    </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>