@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h2>My Exam Result</h2>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @foreach ( $getRecord as $value)

            <div class="row col-md-12">
            <div class="col-md-12">
                @include('_message')
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$value['exam_name']}}</h3>
                    <a class="btn btn-warning btn-sm float-right" target="_blank" href="{{url('student/my_exam_result/print?exam_id='.$value['exam_id'].'&student_id='.Auth::user()->id)}}">Print</a>
                </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Subject Name</th>
                            <th>Test <br>(20%) </th>
                            <th>Mid & Assignment<br>(30%)</th>
                            <th>Final Exam<br>(50%)</th>
                            <th>Total<br>(100%)</th>
                            <th>Grade</th>
                            {{-- <th style="width: 150px">Passing Mark/Full Mark </th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($value['subject'] as $examResult )
                                <tr>
                                    <td>{{$examResult['subject_name']}}</td>
                                    <td>{{$examResult['test']}}</td>
                                    <td>{{$examResult['mid']}}</td>
                                    <td>{{$examResult['final']}}</td>
                                    <td>{{$examResult['test'] + $examResult['mid'] + $examResult['final']}}</td>
                                    <td>
                                        @php
                                        $total = $examResult['test'] + $examResult['mid'] + $examResult['final'];

                                        if ($total >= 90) {
                                            $grade = 'A+';
                                        } elseif ($total >= 83 && $total < 90) {
                                            $grade = 'A';
                                        } elseif ($total >= 80 && $total < 83) {
                                            $grade = 'A-';
                                        } elseif ($total >= 75 && $total < 80) {
                                            $grade = 'B+';
                                        } elseif ($total >= 70 && $total < 75) {
                                            $grade = 'B';
                                        } elseif ($total >= 65 && $total < 70) {
                                            $grade = 'B-';
                                        } elseif ($total >= 60 && $total < 65) {
                                            $grade = 'C+';
                                        } elseif ($total >= 50 && $total < 60) {
                                            $grade = 'C';
                                        } elseif ($total >= 40 && $total < 50) {
                                            $grade = 'D';
                                        } else {
                                            $grade = 'F';
                                        }

                                        $total = 0;
                                    @endphp

                                        {{$grade}}

                                    </td>
                                    {{-- <td>{{$examResult['passing_mark']}}/{{$examResult['full_marks']}}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
              </div>
            </div>
            @endforeach
        </div>

    </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection
