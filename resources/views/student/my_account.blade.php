@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
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
@include('_message')
              <!-- form start -->
              <form method="post" action="" enctype="multipart/form-data">
                {{csrf_field() }}
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>First name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('name', $getRecord->name)}}"  name="name" required  placeholder="First Name">
                      </div>
                    <div class="form-group col-md-6">
                        <label>Last name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('last_name', $getRecord->last_name)}}"  name="last_name" required  placeholder="Last Name">
                      </div>
                      <div class="form-group col-md-6">
                        <label>Email <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('email', $getRecord->email)}}"  name="email" required  placeholder="Email">
                        <div style="color: red">{{$errors->first('email')}}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nationality <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" value="{{old('nationality', $getRecord->nationality)}}" maxlength="3" name="nationality" required placeholder="Nationality">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="tel" class="form-control" value="{{old('mobile_number', $getRecord->mobile_number)}}"  name="mobile_number"  placeholder="Mobile Number">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Upload Picture</label>
                        <input type="file" value="{{old('profile_pic', $getRecord->profile_pic)}}"  class="form-control"   name="profile_pic">
                        @if (!empty($getRecord->getProfile()))
                            <img src="{{$getRecord->getProfile()}}" alt="" style="width: 50px;">
                        @endif
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
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
