@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>Exam List</h2>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{url('admin/examinations/exam/add')}}" class="btn btn-primary">Add a new Exam</a>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            @include('_message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Exam List (Total : {{$getRecord->total()}})</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Exam Name</th>
                      <th>Note</th>
                      <th>Date Created</th>
                      <th>Create By</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->note}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->created_by}}</td>
                            <td>
                                <a href="{{url('admin/examinations/exam/edit/'.$value->id)}}" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                <a href="{{url('admin/examinations/exam/delete/'.$value->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
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
