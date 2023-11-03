@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>Admin List</h2>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/admin/add')}}" class="btn btn-primary">Add a new admin</a>
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
                    <h3 class="card-title">Search Admin</h3>
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
                          <a href="{{url('admin/admin/list')}}" class="btn btn-warning" type="reset" style="margin-top: 32px;">Clear</a>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admin List (Total : {{$getRecord->total()}})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Profile Picture</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Date Created</th>
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
                            <td>{{$value->name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>
                                <a href="{{url('admin/admin/edit/'.$value->id)}}" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                <a href="{{url('admin/admin/delete/'.$value->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
