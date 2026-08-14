@extends('layouts.master')

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous" rel="stylesheet">
    <style>
        .page-content {
            padding: 20px 22px !important;
        }
        @media print {
            .page-content {
                margin: 0;
                padding: 15px !important;
                width: 100%;
                min-height: 285mm;
                box-sizing: border-box;
            }
            .table th, .table td {
                padding: 4px 6px !important;
            }
            .hidden-print {
                display: none !important;
            }
        }
        .table > thead > tr > th {
            vertical-align: middle !important;
            text-align: center !important;
        }
        .table > tbody > tr > td {
            vertical-align: middle !important;
            text-align: center !important;
        }
    </style>
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
                                                <h3 class="text-uppercase no-margin-top">Examination Department</h3>
                                                <h5 class="no-margin-top">
                                                    {{ $generalSetting->address }}, {{ $generalSetting->phone }}
                                                </h5>

                                                <h3 class="no-margin no-margin-top" style="font-family: 'Righteous', cursive;">
                                                    <strong> GRADE LEDGER (FIRST ASSESSMENT TEST- {{ ViewHelper::getYearById($data['year']) }})</strong>
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
                                                                <th colspan="3" class="text-center">
                                                                    {{ ViewHelper::getSubjectById($subject->subjects_id) }}
                                                                </th>
                                                            @else
                                                                <th colspan="2" class="text-center">
                                                                    {{ ViewHelper::getSubjectById($subject->subjects_id) }}
                                                                </th>
                                                            @endif
                                                        @endforeach
                                                        <th rowspan="2">Final Grade</th>
                                                        <th rowspan="2">GPA</th>
                                                        <th rowspan="2">Result</th>
                                                    </tr>
                                                    <tr>
                                                        @foreach($data['student'][0]->subjects as $subject)
                                                            @if($subject->full_mark_theory > 0 && $subject->full_mark_practical > 0)
                                                                <th class="text-center"><small>CAS GP</small></th>
                                                                <th class="text-center"><small>Summative GP</small></th>
                                                                <th class="text-center"><small>Final GP</small></th>
                                                            @elseif($subject->full_mark_theory > 0)
                                                                <th class="text-center"><small>Summative GP</small></th>
                                                                <th class="text-center"><small>Final GP</small></th>
                                                            @else
                                                                <th class="text-center"><small>CAS GP</small></th>
                                                                <th class="text-center"><small>Final GP</small></th>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1; @endphp
                                                    @foreach($data['student'] as $key => $student)
                                                        @php
                                                            // Initialize variables
                                                            $totalSubjects = $student->subjects ? $student->subjects->count() : 0;
                                                            $sumFinalGp = 0;
                                                            $subjectFinalGps = [];
                                                            $subjectFinalGrades = [];

                                                            // Calculate Final GP for each subject: (Theory GP + Practical GP) / 2
                                                            foreach ($student->subjects as $sub) {
                                                                $thGp = isset($sub->th_grade_point) && is_numeric($sub->th_grade_point) ? (float)$sub->th_grade_point : 0;
                                                                $prGp = isset($sub->pr_grade_point) && is_numeric($sub->pr_grade_point) ? (float)$sub->pr_grade_point : 0;
                                                                
                                                                // Calculate Final GP using the formula: (Theory GP + Practical GP) / 2
                                                                if ($sub->full_mark_theory > 0 && $sub->full_mark_practical > 0) {
                                                                    // Both theory and practical exist
                                                                    $finalGp = ($thGp + $prGp) / 2;
                                                                } elseif ($sub->full_mark_theory > 0) {
                                                                    // Only theory exists
                                                                    $finalGp = $thGp;
                                                                } elseif ($sub->full_mark_practical > 0) {
                                                                    // Only practical exists
                                                                    $finalGp = $prGp;
                                                                } else {
                                                                    $finalGp = 0;
                                                                }
                                                                
                                                                // Determine Final Grade based on Final GP
                                                                if ($finalGp >= 3.6) {
                                                                    $finalGrade = 'A+';
                                                                } elseif ($finalGp >= 3.2) {
                                                                    $finalGrade = 'A';
                                                                } elseif ($finalGp >= 2.8) {
                                                                    $finalGrade = 'B+';
                                                                } elseif ($finalGp >= 2.4) {
                                                                    $finalGrade = 'B';
                                                                } elseif ($finalGp >= 2.0) {
                                                                    $finalGrade = 'C+';
                                                                } elseif ($finalGp >= 1.6) {
                                                                    $finalGrade = 'C';
                                                                } elseif ($finalGp >= 1.2) {
                                                                    $finalGrade = 'D';
                                                                } else {
                                                                    $finalGrade = 'NG';
                                                                }
                                                                
                                                                // Store for display
                                                                $subjectFinalGps[] = $finalGp;
                                                                $subjectFinalGrades[] = $finalGrade;
                                                                $sumFinalGp += $finalGp;
                                                            }

                                                            // Calculate Overall GPA: Sum of Final GP / Total Subjects
                                                            $overallGpa = $totalSubjects > 0 ? $sumFinalGp / $totalSubjects : 0;
                                                            $overallGpaFormatted = number_format($overallGpa, 2);
                                                            $overallGpa = (float) $overallGpaFormatted;

                                                            // Determine Overall Grade using the same scale as grading-sheet1
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
                                                            
                                                            @foreach($student->subjects as $index => $subject)
                                                                {{-- Display CAS GP (Practical) --}}
                                                                @if($subject->full_mark_practical > 0)
                                                                    <td class="text-center" style="{{ $subject->pr_remark == '*' ? 'background:black;color:white' : '' }}">
                                                                        {{ isset($subject->pr_grade_point) && is_numeric($subject->pr_grade_point) ? number_format((float)$subject->pr_grade_point, 2) : '-' }}
                                                                    </td>
                                                                @endif

                                                                {{-- Display Summative GP (Theory) --}}
                                                                @if($subject->full_mark_theory > 0)
                                                                    <td class="text-center" style="{{ $subject->th_remark == '*' ? 'background:black;color:white' : '' }}">
                                                                        {{ isset($subject->th_grade_point) && is_numeric($subject->th_grade_point) ? number_format((float)$subject->th_grade_point, 2) : '-' }}
                                                                    </td>
                                                                @endif

                                                                {{-- Display Final GP and Grade for each subject --}}
                                                                <td class="text-center">
                                                                    {{ isset($subjectFinalGps[$index]) ? number_format($subjectFinalGps[$index], 2) : '-' }}
                                                                    <br>
                                                                    <small>({{ isset($subjectFinalGrades[$index]) ? $subjectFinalGrades[$index] : '-' }})</small>
                                                                </td>
                                                            @endforeach

                                                            <td><strong>{{ $overallGrade }}</strong></td>
                                                            <td><strong>{{ $overallGpaFormatted }}</strong></td>
                                                            <td>
                                                                @php
                                                                    $remark = $student->subjects->pluck('remark')->toArray();
                                                                    $pr_remark = $student->subjects->pluck('pr_remark')->toArray();
                                                                @endphp
                                                                @if(in_array('*', $remark) || in_array('*', $pr_remark))
                                                                    <span style="color:red;">* Fail</span>
                                                                @else
                                                                    <span style="color:green;">Pass</span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
   @include('includes.scripts.print_script')
@endsection