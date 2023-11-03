<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Exam Result</title>
    <style>
        @page{
            size: 8.3in 11.7in;
        }
        @page{
            size: A4;
        }
        .margin_bottom{
            margin-bottom: 3px;
        }
        .table-bg{
            border-collapse: collapse;


            width: 100%;
            text-align: center;
            font-size: 15px;
        }
        .table-bg th, .table-bg td{
            border: 1px solid;
        }
        .subject{
            font-weight: bold;
            text-align: left;
        }
        @media print{
            @page{
                margin: 0px;
                margin-left:  20px;
            }
        }

    </style>
</head>
<body>
    <div id="page">
        <table style="width: 100%;  text-align:center;">
            <tr>
                <td width="5%"></td>
                <td width="150px"><img src="{{url('upload/school_logo.jpg')}}" alt="--School Logo--" style="width: 200px; height: 200px; border-radius: 50%;" ></td>
                <td style="text-align: left; text-decoration: underline;"><h1> ONESMOS NESIB ACADEMY </h1></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td width="5%"></td>
                <td width="70%">
                    <table class="margin_bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="27%">Student Name: </td>
                                <td style="border-bottom: 1px solid; width : 100%">{{$getStudent->name}} {{$getStudent->last_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="margin_bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="23%">Admission Number:</td>
                                <td style="border-bottom: 1px solid; width : 100%">{{$getStudent->admission_number}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="margin_bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="23%">Class:</td>
                                <td style="border-bottom: 1px solid; width : 100%">{{$getClass->class_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="margin_bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                {{-- <td width="28%">Academic Session: </td>
                                <td style="border-bottom: 1px solid; width : 20%"></td> --}}
                                <td width="11%">Term/Semister: </td>
                                <td style="border-bottom: 1px solid; width : 80%">{{$getExam->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <table class="margin_bottom" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="28%">Total Score: </td>
                                <td style="border-bottom: 1px solid; width : 20%"></td>
                                <td width="16%">Average Score: </td>
                                <td style="border-bottom: 1px solid; width : 80%"></td>
                            </tr>
                        </tbody>
                    </table> --}}
                </td>
                <td width="5%"></td>
                <td width="20%" valign="top">
                    <img src="{{$getStudent->getProfileDirect()}}" alt="--STUDENT PHOTO--"  style="width: 200px; height: 200px; border-radius: 50%; border: 1px solid;">
                    <br> <br>
                   Gender: {{$getStudent->gender}}
                </td>
            </tr>
        </table>
        <br>

        <div>
            <table class="table-bg">
                <thead>
                   <tr>
                      <th class="subject">Subject Name</th>
                      <th>Test</th>
                      <th>Mid &amp; Assignment</th>
                      <th>Final Exam</th>
                      <th>Total</th>
                      <th>Grade</th>
                   </tr>
                </thead>
                <tbody>
                    @foreach ($getExamMark as $examResult )
                        <tr>
                            <td class="subject">{{$examResult['subject_name']}}</td>
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
        <div>
            <p> <strong>Remark: </strong> Our school, provides this transcript as an official record of the academic achievements and progress of the student named below. This transcript reflects the courses taken, grades earned, and any additional relevant information pertaining to the student's educational journey at our institution. It is intended to serve as a comprehensive summary of the student's academic performance and accomplishments during their time at our school. Please note that this transcript is confidential and should only be shared with authorized individuals or institutions for educational or professional purposes. For any inquiries or further information, please contact our school's administration office</p>
        </div>
        <br>
        <table class="margin_bottom" style="width: 50%; float: right;">
            <tbody>
                <tr>
                    <td width="20%">Signiture: </td>
                    <td style="border-bottom: 1px solid; width : 100%"></td>
                </tr>
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
