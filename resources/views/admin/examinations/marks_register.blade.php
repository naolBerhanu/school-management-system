@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>Mark Registration</h2>
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

                <!-- form start -->
                <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Exam Name</label>
                            <select name="exam_id" id="" class="form-control">
                                <option value="">Select</option>
                                @foreach ($getExam as $exam)
                                    <option {{(Request::get('exam_id')  == $exam->id) ? 'selected' : ''}} value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Class Name</label>
                            <select name="class_id" id="" class="form-control">
                                <option value="">Select</option>
                                @foreach ($getClass as $class)
                                    <option {{(Request::get('class_id')  == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                          <button class="btn btn-primary" type="submit" style="margin-top: 32px;"><i class="fa fa-search"></i></button>
                          <a href="{{url('admin/examinations/marks_register')}}" class="btn btn-warning" type="reset" style="margin-top: 32px;">Clear</a>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            @include('_message')
            @if (!empty($getSubject) && !empty($getSubject->count()))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Register Marks</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      {{-- <th>Class</th> --}}
                      <th>Student Name</th>
                      @foreach ($getSubject as $subject)
                            <th>
                            {{$subject->subject_name}} <br>
                            ({{$subject->subject_type}}:  {{$subject->passing_mark}}/ {{$subject->full_marks}})
                            </th>
                      @endforeach
                      <th>Actions</th>
                    </tr>
                  </thead>
                 <tbody>
                   @if (!empty($getStudent) && !empty($getStudent->count()))
                       @foreach ($getStudent as $student )
                       <form method="post" action="" class="SubmitForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="student_id" value="{{$student->id}}">
                        <input type="hidden" name="exam_id" value="{{Request::get('exam_id')}}">
                        <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">
                           <tr>
                                <td>{{$student->name}} {{$student->last_name}}</td>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($getSubject as $subject)
                                    @php
                                        $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id );
                                    @endphp
                                <td>
                                    <div style="margin-bottom: 10px;">
                                        Test
                                        <input type="hidden" name="mark[{{$i}}][full_marks]" value="{{$subject->full_marks}}">
                                        <input type="hidden" name="mark[{{$i}}][passing_mark]" value="{{$subject->passing_mark}}">


                                        <input type="hidden" name="mark[{{$i}}][subject_id]" value="{{$subject->subject_id}}" class="form-control" style="width: 200px" id="">
                                        <input type="number" value="{{!empty($getMark->test) ? $getMark->test : ''}}" min="10" max="20" placeholder="Total 20%" name="mark[{{$i}}][test]" class="form-control" style="width: 200px" id="">
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        Mid Term/Assignment
                                        <input type="number"  value="{{!empty($getMark->mid) ? $getMark->mid : ''}}" min="15" max="30" placeholder="Total 30%" name="mark[{{$i}}][mid]" class="form-control" style="width: 200px" id="">
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        Final Exam
                                        <input type="number"  value="{{!empty($getMark->final) ? $getMark->final : ''}}" min="30" max="50" placeholder="Total 50%" name="mark[{{$i}}][final]" class="form-control" style="width: 200px" id="">
                                    </div>
                                </td>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                                <td>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </td>
                            </tr>
                       </form>
                       @endforeach
                   @endif
                 </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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

@section('script').
    <script type="text/javascript">
        $('.SubmitForm').submit(function(e){
            e.preventDefault();

            $.ajax({
                type : "POST",
                url : "{{url('admin/examinations/submit_marks_register')}}",
                data : $(this).serialize(),
                dataType : "json",
                success: function(data){
                    alert(data.message)
                }
            })

        })
    </script>
@endsection
