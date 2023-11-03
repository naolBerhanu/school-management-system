@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>Student List</h2>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/student/add')}}" class="btn btn-primary">Add a new student</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Search Student</h3>
                  </div>
                <!-- form start -->
                <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{Request::get('name')}}"  name="name"  placeholder="Name">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Class</label>
                            <input type="text" class="form-control" value="{{Request::get('class')}}"  name="class"  placeholder="Class">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Admission Number</label>
                            <input type="text" class="form-control" value="{{Request::get('admission_number')}}"  name="admission_number"  placeholder="Admission Number">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Gender</label>
                            <select name="gender" id=""  class="form-control">
                                <option value="">Select Gender</option>
                                <option {{(Request::get('gender') == 'Male') ? 'selected': ''}} value="Male">Male</option>
                                <option {{(Request::get('gender') == 'Female') ? 'selected': ''}} value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Status</label>
                            <select name="status" id=""  class="form-control">
                                <option value="">Select Status</option>
                                <option {{(Request::get('status') == 100) ? 'selected': ''}} value="100">Active</option>
                                <option {{(Request::get('status')== 1) ? 'selected': ''}} value="1">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                          <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fa fa-search"></i></button>
                          <a href="{{url('admin/student/list')}}" class="btn btn-warning" type="reset" style="margin-top: 32px;">Clear</a>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List (Total : {{$getRecord->total()}})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Admission Number</th>
                      {{-- <th>Roll Number</th> --}}
                      <th>Class</th>
                      <th>Gender</th>
                      <th>Date Of Birth</th>
                      <th>Nationality</th>
                      <th>Mobile Number</th>
                      <th>Admitted On</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>
                               @if (!empty($value->getProfileDirect()))
                                <img src="{{$value->getProfileDirect()}}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                               @endif
                             </td>
                            <td>{{$value->name}} {{$value->last_name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->admission_number}}</td>
                            <td>{{$value->class_name}}</td>
                            <td>{{$value->gender}}</td>
                            <td>{{$value->date_of_birth}}</td>
                            <td>{{$value->nationality}}</td>
                            <td>{{$value->mobile_number}}</td>
                            <td>{{$value->admission_date}}</td>
                            <td>
                                @if($value->status == 0)
                                    <span class="btn-success">Active</span>
                                @else
                                    <span class="btn-danger">Inactive</span>
                                @endif
                            </td>
                            <td style="min-width: 150px">
                                <a href="{{url('admin/student/edit/'.$value->id)}}" class="btn btn-info btn-sm"><i class="fas fa-pen"  ></i></a>
                                <a href="{{url('admin/student/delete/'.$value->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash" ></i></a>
                            </td>
                        </tr>
                    @endforeach

                  </tbody>
                </table>
                <div style="padding: 10px; float: right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
