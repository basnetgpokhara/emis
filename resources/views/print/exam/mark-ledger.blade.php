@extends('layouts.master')

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="col-sm-12 align-right hidden-print">
            <a href="#" class="" onclick="window.print();">
                <i class="ace-icon fa fa-print bigger-200"></i>
            </a>
        </div>
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    <div class="row">
                                        <div class="col-md-2 col-print-2 align-left">
                                            @if(isset($generalSetting->logo))
                                                <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="150px">
                                            @endif
                                        </div>
                                        <div class="col-md-10 col-print-10 align-right">
                                            <div class="text-center">
                                                <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 30px">
                                                    <strong>{{ $generalSetting->institute }}</strong>
                                                </h2>
                                                <h3 class="text-uppercase no-margin-top">Department of Examination</h3>
                                                <h5 class="no-margin-top">
                                                    {{ $generalSetting->address }}, {{ $generalSetting->phone }}
                                                </h5>

                                                <h3 class="no-margin no-margin-top" style="font-family: 'Righteous', cursive;">
                                                    <strong> GRADE LEDGER({{ ViewHelper::getExamById($data['exam']) }} - {{ ViewHelper::getYearById($data['year']) }})</strong>
                                                </h3>
                                                 
                                                <h5 class="no-margin no-margin-top" style="font-family: 'Righteous', cursive;">
                                                    <strong>{{ ViewHelper::getFacultyTitle( $data['faculty'] ) }} - {{ ViewHelper::getSemesterTitle( $data['semester'] ) }}</strong>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    @if(isset($data['student']) && $data['student']->count() > 0)
                                        <div class="table-responsive">
                                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">S.N.</th>
                                                        <th rowspan="2">Reg.Number</th>
                                                        <th rowspan="2">Student Name</th>
                                                        @foreach($data['student'][0]->subjects as $subject)
                                                            @if($subject->full_mark_theory > 0 && $subject->full_mark_practical > 0)
                                                                <th colspan="2" class="text-center">
                                                                    {{ ViewHelper::getSubjectById($subject->subjects_id) }}
                                                                    <br>TH | PR
                                                                </th>
                                                            @else
                                                                <th class="text-center">
                                                                    {{ ViewHelper::getSubjectById($subject->subjects_id) }}
                                                                    <br>TH
                                                                </th>
                                                            @endif
                                                        @endforeach
                                                        <!--<th rowspan="2">Total Marks</th>
                                                        <th rowspan="2">Obtain Marks</th>-->
                                                        <th rowspan="2">Final Grade</th>
                                                        <th rowspan="2">GPA</th>
                                                        <th rowspan="2">Result</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1; @endphp
                                                    @foreach($data['student'] as $key => $student)
                                                        @php
                                                            // Collect valid numeric grade points from subjects
                                                            $validGradePoints = $student->subjects->pluck('grade_point')->filter(function($gp) {
                                                                return is_numeric($gp);
                                                            });

                                                            $subjectCount = $validGradePoints->count();

                                                            // Determine overall GPA
                                                            if (isset($student->gpa_average) && is_numeric($student->gpa_average) && $student->gpa_average > 0) {
                                                                $overallGpa = (float) $student->gpa_average;
                                                            } else {
                                                                $overallGpa = $subjectCount > 0 ? ($validGradePoints->sum() / $subjectCount) : 0;
                                                            }

                                                            // Determine Final Grade based on calculated GPA
                                                            if ($overallGpa >= 3.6) {
                                                                $overallGrade = 'A+';
                                                            } elseif ($overallGpa >= 3.2) {
                                                                $overallGrade = 'A';
                                                            } elseif ($overallGpa >= 2.8) {
                                                                $overallGrade = 'B+';
                                                            } elseif ($overallGpa >= 2.4) {
                                                                $overallGrade = 'B';
                                                            } elseif ($overallGpa >= 2.0) {
                                                                $overallGrade = 'C+';
                                                            } elseif ($overallGpa >= 1.6) {
                                                                $overallGrade = 'C';
                                                            } elseif ($overallGpa >= 1.2) {
                                                                $overallGrade = 'D';
                                                            } else {
                                                                $overallGrade = 'NG';
                                                            }
                                                        @endphp

                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $student->reg_no }}</td>
                                                            <td>{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</td>
                                                            
                                                            @foreach($student->subjects as $subject)
                                                                {{-- Theory --}}
                                                                @if($subject->full_mark_theory > 0)
                                                                    <td class="text-center" style="{{ $subject->th_remark == '*' ? 'background:black;color:white' : '' }}">
                                                                        <!--{{ $subject->obtain_mark_theory ? $subject->obtain_mark_theory : '-' }}-->
                                                                        {{ $subject->obtain_score_theory ? $subject->obtain_score_theory : '-' }}
                                                                        <!--{{ $subject->th_grade_point ? $subject->th_grade_point : '-' }}-->
                                                                    </td>
                                                                @endif

                                                                {{-- Practical --}}
                                                                @if($subject->full_mark_practical > 0)
                                                                    <td class="text-center" style="{{ $subject->pr_remark == '*' ? 'background:black;color:white' : '' }}">
                                                                        <!--{{ $subject->obtain_mark_practical ? $subject->obtain_mark_practical : '-' }}-->
                                                                        {{ $subject->obtain_score_practical ? $subject->obtain_score_practical : '-' }}
                                                                        <!--({{ $subject->pr_grade_point ? $subject->pr_grade_point : '-' }})-->
                                                                    </td>
                                                                @endif
                                                            @endforeach

                                                            <!--<td>{{ $student->subjects->sum('full_mark_theory') + $student->subjects->sum('full_mark_practical') }}</td>
                                                            <td>{{ $student->total_obtain ? $student->total_obtain : '-' }}</td>-->
                                                            <td class="text-center"><strong>{{ $overallGrade }}</strong></td>
                                                            <td class="text-center"><strong>{{ number_format($overallGpa, 2) }}</strong></td>
                                                            <td>
                                                                @php
                                                                    $remark = $student->subjects->pluck('remark')->toArray();
                                                                    $pr_remark = $student->subjects->pluck('pr_remark')->toArray();
                                                                @endphp
                                                                @if(in_array('*', $remark) || in_array('*', $pr_remark))
                                                                    * Fail
                                                                @else
                                                                    Pass
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                    <div class="hr hr-8"></div>
                                </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div>
        </div>
    </div><!-- /.main-content -->
@endsection

@section('js')
   @include('includes.scripts.print_script')
@endsection