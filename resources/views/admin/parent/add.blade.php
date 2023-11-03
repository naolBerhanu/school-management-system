@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Parent</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form method="post" action="" enctype="multipart/form-data">
                {{csrf_field() }}
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>First name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('name')}}"  name="name" required  placeholder="First Name">
                      </div>
                    <div class="form-group col-md-6">
                        <label>Last name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('last_name')}}"  name="last_name" required  placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" value="{{old('email')}}"  name="email" required  placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Gender <span style="color: red;">*</span></label>
                        <select name="gender" id="" required class="form-control">
                            <option value="">Select Gender</option>
                            <option {{(old('gender') == 'Male') ? 'selected': ''}} value="Male">Male</option>
                            <option {{(old('gender') == 'Female') ? 'selected': ''}} value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="tel" class="form-control" value="{{old('mobile_number')}}"  name="mobile_number"  placeholder="Mobile Number">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Occupation <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('occupation')}}"  name="occupation" required  placeholder="Occupation">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('address')}}"  name="address" required  placeholder="Address">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Upload Picture</label>
                        <input type="file" value="{{old('profile_pic')}}"  class="form-control"   name="profile_pic">
                    </div>


                    <div class="form-group col-md-6">
                        <label>Status <span style="color: red;">*</span></label>
                        <select name="status" id="" required class="form-control">
                            <option value="">Select Status</option>
                            <option {{(old('status') == 0) ? 'selected': ''}} value="0">Active</option>
                            <option {{(old('status') == 1) ? 'selected': ''}} value="1">Inactive</option>
                        </select>
                    </div>


                  </div>

                  <hr>

                  <div class="form-group">
                    <label>Email <span style="color: red;">*</span></label>
                    <input type="email" class="form-control" name="email"  required placeholder="Email">
                    <div style="color: red">{{$errors->first('email')}}</div>
                  </div>
                  <div class="form-group">
                    <label>Password <span style="color: red;">*</span></label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @endsection
