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
            @include('_message')
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">My Children </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                          <th>Student Id</th>
                          <th>Photo</th>
                          <th>Student Name</th>
                          <th>Admission Number</th>
                          <th>Class Name</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($getRecord as $value )
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>
                                @if (!empty($value->getProfile()))
                                 <img src="{{$value->getProfile()}}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                                @endif
                              </td>
                            <td>{{$value->name}} {{$value->last_name}}</td>
                            <td>{{$value->admission_number}}</td>
                          <td>{{$value->class_name}}</td>
                          <td>
                            <a href="{{url('parent/my_student/subject/'.$value->id)}}" class="btn btn-primary btn-sm">Subjects</a>
                            <a href="{{url('parent/my_student/exam_result/'.$value->id)}}" class="btn btn-success btn-sm">Exam Results</a>
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
