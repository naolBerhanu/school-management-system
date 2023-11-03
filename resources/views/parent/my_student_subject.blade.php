@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Subject List for <strong class="text-primary">{{$getUser->name}}</strong></h2>
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
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Subject Id</th>
                      <th>Subject Name</th>
                      <th>Type</th>

                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($getRecord as $value )
                            <tr>
                                <td>{{$value->subject_id}}</td>
                                <td>{{$value->subject_name }}</td>
                                <td>{{$value->subject_type }}</td>
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
