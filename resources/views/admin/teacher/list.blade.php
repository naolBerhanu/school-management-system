@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>Teacher List</h2>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/teacher/add')}}" class="btn btn-primary">Add a new teacher</a>
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
                    <h3 class="card-title">Search Teacher</h3>
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
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{Request::get('email')}}"  name="email"  placeholder="Email">
                        </div>
                        <div class="form-group col-md-3">
                          <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fa fa-search"></i></button>
                          <a href="{{url('admin/teacher/list')}}" class="btn btn-warning" type="reset" style="margin-top: 32px;">Clear</a>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Teacher List (Total : {{$getRecord->total()}})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Qualification</th>
                        <th>Experience</th>
                        <th>Address</th>
                        <th>Status</th>
                        {{-- <th>Date Joined</th> --}}
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>
                               @if (!empty($value->getProfile()))
                                <img src="{{$value->getProfile()}}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                               @endif
                             </td>
                            <td>{{$value->name}} {{$value->last_name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->mobile_number}}</td>
                            <td>{{$value->qualification}}</td>
                            <td>{{$value->experience}} Years</td>
                            <td>{{$value->address}}</td>
                            <td>
                                @if($value->status == 0)
                                    <span class="btn-success">Active</span>
                                @else
                                    <span class="btn-danger">Inactive</span>
                                @endif
                            </td>
                            {{-- <td>{{$value->date_created}}</td> --}}
                            <td style="min-width: 150px">
                                <a href="{{url('admin/teacher/edit/'.$value->id)}}" class="btn btn-info btn-sm"><i class="fas fa-pen"  ></i></a>
                                <a href="{{url('admin/teacher/delete/'.$value->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash" ></i></a>
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
