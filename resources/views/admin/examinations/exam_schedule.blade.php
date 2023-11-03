@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>Exam Schedule</h2>
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
                    <h3 class="card-title">Search Exam Schedule</h3>
                  </div>
                <!-- form start -->
                <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Exam Name</label>
                            <select name="exam_id" required id="" class="form-control">
                                <option value="">Select</option>
                                @foreach ($getExam as $exam)
                                    <option {{(Request::get('exam_id')  == $exam->id) ? 'selected' : ''}} value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Class Name</label>
                            <select name="class_id" id="" required class="form-control">
                                <option value="">Select</option>
                                @foreach ($getClass as $class)
                                    <option {{(Request::get('class_id')  == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                          <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fa fa-search"></i></button>
                          <a href="{{url('admin/examinations/exam_schedule')}}" class="btn btn-warning" type="reset" style="margin-top: 32px;">Clear</a>
                        </div>
                    </div>
                  </div>
                </form>
              </div>

            @if (!empty($getRecord))
            <form action="{{url('admin/examinations/exam_schedule_insert')}}" method="post">
                {{ csrf_field() }}
              <input type="hidden" name="exam_id" value="{{Request::get('exam_id')}}">
              <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">

              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Exam Schedule</h3>
              </div>
              @include('_message')
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Class</th>
                      <th>Subject Name</th>
                      {{-- <th>Exam Id</th> --}}
                      <th>Exam Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Room Number</th>
                      <th>Full Mark</th>
                      <th>Passing Mark</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{$value['class_name']}}
                                <input type="hidden"  value="{{$value['class_id']}}" class="form-control" name="schedule[{{$i}}][class_id]">
                            </td>
                            <td>{{$value['subject_name']}}
                                <input type="hidden"  value="{{$value['subject_id']}}" class="form-control" name="schedule[{{$i}}][subject_id]">
                            </td>
                            {{-- <td>{{$value['exam_name']}}
                                <input type="hidden" readonly value="{{$value['subject_id']}}" class="form-control" name="schedule[{{$i}}][subject_id]">
                            </td> --}}
                            <td>
                                <input  type="date" value="{{$value['exam_date']}}" class="form-control"  min="2023-10-01" name="schedule[{{$i}}][exam_date]">
                            </td>
                            <td>
                                <input type="time" class="form-control" value="{{$value['start_time']}}" name="schedule[{{$i}}][start_time]">
                            </td>
                            <td>
                                <input type="time" class="form-control" value="{{$value['end_time']}}" name="schedule[{{$i}}][end_time]">
                            </td>
                            <td>
                                <input type="number" value="{{$value['room_number']}}" min="1" max="99" class="form-control"  name="schedule[{{$i}}][room_number]">
                            </td>
                            <td>
                                <input type="number"  value="100" readonly class="form-control" name="schedule[{{$i}}][full_marks]">
                            </td>
                            <td>
                                <input type="number" value="50" readonly class="form-control" name="schedule[{{$i}}][passing_mark]">
                            </td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                    @endforeach

                  </tbody>
                </table>

                <div class="card-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">clear</button>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
          </form>
          @endif
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
