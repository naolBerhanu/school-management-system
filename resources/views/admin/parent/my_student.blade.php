@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>Parent Student List</h2>
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
                        <div class="form-group col-md-3">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{Request::get('name')}}"  name="name"  placeholder="Name">
                        </div>
                        <div class="form-group col-md-3">
                          <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fa fa-search"></i></button>
                          <a href="{{url('admin/parent/my_student/'.$parent_id)}}" class="btn btn-warning" type="reset" style="margin-top: 32px;">Clear</a>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            @include('_message')

            @if (!empty($getSearchStudent))

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>Student Id</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admission Number</th>
                        <th>Parent Name</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getSearchStudent as $value )
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>
                           @if (!empty($value->getProfile()))
                            <img src="{{$value->getProfile()}}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                           @endif
                         </td>
                        <td>{{$value->name}} {{$value->last_name}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->admission_number}}</td>
                        <td>{{$value->parent_name}}</td>
                        <td style="min-width: 150px">
                            <a href="{{url('admin/parent/assign_student_parent/'.$value->id.'/'.$parent_id)}}" class="btn btn-info btn-sm">Assign to Parent</a>
                        </td>
                    @endforeach

                  </tbody>
                </table>
                <div style="padding: 10px; float: right;">
                    {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>

            @endif
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Parent Student List </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                          <th>Parent Id</th>
                          <th>Parent Name</th>
                          <th>Phone</th>
                          <th>Student Id</th>
                          <th>Student Name</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($getRecord as $value )
                        <tr>
                            <td>{{$value->parent_id}}</td>
                            <td>{{$value->parent_name}}</td>
                            <td>{{$value->mobile_number}}</td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}} {{$value->last_name}}</td>
                            <td style="min-width: 150px">
                                <a href="{{url('admin/parent/assign_student_parent_delete/'.$value->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        @endforeach

                    </tbody>
                  </table>
                  <div style="padding: 10px; float: right;">
                      {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
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
