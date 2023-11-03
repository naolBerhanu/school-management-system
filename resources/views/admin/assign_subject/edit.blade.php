@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit subject assignment</h1>
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
              <form method="post" action="">
                {{csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Class Name</label>
                    <select name="class_id" required id="" class="form-control">
                        <option value="">Select Class </option>
                        @foreach ($getClass as $class )
                            <option {{($getRecord->class_id == $class->id ? 'selected': '')}} value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                      <label>Subject Name</label>
                            @foreach ($getSubject as $subject)
                                @php
                                    $checked = "";
                                @endphp
                                @foreach ($getAssignSubjectId as $subjectAssign)
                                    @if($subjectAssign->subject_id == $subject->id)
                                        @php
                                        $checked = "checked";
                                        @endphp
                                    @endif
                                @endforeach
                                <div>
                                    <label style="font-weight: normal; text-transform: uppercase;">
                                        <input {{$checked}} type="checkbox"  value="{{$subject->id}}" name="subject_id[]" multiple> {{$subject->name}}
                                    </label>
                                </div>
                            @endforeach

                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{($getRecord->status== 100 ? 'selected': '')}}  value="0">Active </option>
                        <option {{($getRecord->status== 1 ? 'selected': '')}}  value="1">Inactive </option>
                    </select>
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
