@extends('layouts.master')

@section('css')
   @include('print.includes.print-layout')
    <style>
        .page-content {
            padding: 20px 22px !important;
            border: 20px #438eb9 solid;
        }

        .widget-box.transparent.padding-class {
            padding: 0px 25px;
        }
        span.position {
            border: 1px black solid;
            padding: 10px;
            float: right;
            margin-right:50px ;
            font-weight: bold;
        }

       @media print {
    .page-content {
        position: relative;
        margin: 0;
        padding: 15px !important;
        border: 5px #3C80A6 solid !important;
        width: 100%;
        height: auto !important; /* Prevents overflow clipping */
        min-height: 285mm;
        box-sizing: border-box;
    }

    /* Prevent table padding from spilling over */
    .table-responsive {
        overflow: visible !important;
    }

    .table th, .table td {
        padding: 4px 6px !important; /* Compact table row heights */
    }

    /* Hide unnecessary elements during printing */
    .hidden-print {
        display: none !important;
    }
}
    </style>
@endsection

@section('content')
    @if($data['student'] && $data['student']->count() > 0)

        @foreach($data['student'] as $student)
            <div class="main-content " >
                <div class="col-sm-12 align-right hidden-print">
                    <a href="#" class="btn btn-primary" onclick="window.print();">
                        <i class="ace-icon fa fa-print bigger-200"></i> Print
                    </a>
                </div>
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1 padding-class">
                                        <div class="widget-box transparent ">
                                            @include('print.includes.institution-detail')
                                            <div class="row">
                                                <div class="col-md-2 col-print-2 align-left"></div>
                                                <div class="col-md-10 col-print-10 align-right">
                                                    <div class="text-center">
                                                        <div class="space-4"></div>
                                                        <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 25px">
                                                            <strong><u>FIRST ASSESSMENT TEST-{{ ViewHelper::getYearById($data['year']) }}</u></strong>
                                                        </h3>
                                                        <div class="space-10"></div>
                                                        <h2 class="no-margin text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 30px">
                                                            <strong><u>GRADE-SHEET</u></strong>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="space-6"></div>
                                                @include('print.includes.studentinfo')
                                                <div class="space-6"></div>
                                            </div>
                                            <div class="text-center">
                                                <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 25px">
                                                    <strong><u>SUBJECT-WISE ACHIEVEMENT</u></strong>
                                                </h3>
                                            </div>		
                                            @php
                                                // Find Nepali Subject
                                                $nepaliSubject = $student->subjects->first(function($sub) {
                                                    $subjectName = ViewHelper::getSubjectById($sub->subjects_id);
                                                    return stripos($subjectName, 'nepali') !== false;
                                                });

                                                if ($nepaliSubject) {
                                                    $nepaliTheoryGp    = is_numeric($nepaliSubject->th_grade_point) ? number_format((float)$nepaliSubject->th_grade_point, 2) : '0.00';
                                                    $nepaliPracticalGp = is_numeric($nepaliSubject->pr_grade_point) ? number_format((float)$nepaliSubject->pr_grade_point, 2) : '0.00';
                                                    $nepaliFinalGp     = is_numeric($nepaliSubject->grade_point) ? number_format((float)$nepaliSubject->grade_point, 2) : '0.00';
                                                    $nepaliFinalGrade  = $nepaliSubject->final_grade ? $nepaliSubject->final_grade : '-';
                                                } else {
                                                    $nepaliTheoryGp    = '0.00';
                                                    $nepaliPracticalGp = '0.00';
                                                    $nepaliFinalGp     = '0.00';
                                                    $nepaliFinalGrade  = '-';
                                                }

                                                // --- OVERALL STUDENT FINAL GRADE & GPA ---
                                                $overallGpa = (isset($student->gpa_average) && is_numeric($student->gpa_average)) ? (float)$student->gpa_average : 0;

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

                                                $overallGpaFormatted = number_format($overallGpa, 2);
                                            @endphp
                                            <div class="table-responsive">
                                                <table width="100%" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">SN</th>
                                                            <th class="text-center">SUBJECT</th>
                                                            <th class="text-center">CAS Grade</th>
                                                            <th class="text-center">CAS GP</th>
                                                            <th class="text-center">Summative Grade</th>
                                                            <th class="text-center">Summative GP</th>
                                                            <th class="text-center">Final GP</th>
                                                            <th class="text-center">Final Grade</th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                        // Safe extraction and summation of numeric grade points
                                                        $validGradePoints = $student->subjects->pluck('grade_point')->filter(function($gp) {
                                                            return is_numeric($gp);
                                                        });

                                                        $totalSubjects = $student->subjects->count();
                                                        $sumGradePoints = number_format((float)$validGradePoints->sum(), 2);
                                                    @endphp
                                                   
                                                    <tbody>
                                                    @if($student->subjects && $student->subjects->count() > 0)
                                                        @php($i=1)
                                                        @foreach($student->subjects as $subject)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ ViewHelper::getSubjectById($subject->subjects_id) }}</td>
                                                                <td class="text-center">{{ $subject->obtain_score_practical ? $subject->obtain_score_practical : '-' }}</td>
                                                                <td class="text-center">{{ $subject->pr_grade_point ? $subject->pr_grade_point : '-' }}</td>
                                                                <td class="text-center">{{ $subject->obtain_score_theory ? $subject->obtain_score_theory : '-' }}</td>
                                                                <td class="text-center">{{ $subject->th_grade_point ? $subject->th_grade_point : '-' }}</td>
                                                                <td class="text-center">{{ $subject->grade_point ? $subject->grade_point : '-' }}</td>
                                                                <td class="text-center">{{ $subject->final_grade ? $subject->final_grade : '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                          
                                                <table width="100%" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="5" class="text-center">Overall Achievement</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Subjects</th>
                                                            <th>Total Final Grade Points</th>
                                                            <th>Grade Point Average (GPA) & Grade</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">{{ $totalSubjects }}</td>
                                                            <td class="text-center">{{ $sumGradePoints }}</td>
                                                            <td class="text-center"> <strong>{{ isset($student->gpa_average) ? $student->gpa_average : '' }} ({{ $overallGrade }})</strong></td>
                                                        </tr>
                                                    </thead>
                                                </table>

                                                <div class="row" style="margin-top: 15px; page-break-inside: avoid;">
                                                    <div class="row" style="margin-top: 15px;">
                                                        <!-- Left Column: Grading Scale Table -->
                                                        <div class="col-xs-5 center" style="padding-right: 5px;">
                                                            <p style="font-weight: bold; margin-bottom: 5px; font-size: 11px;">Subject Wise Grading Scale</p>
                                                            <table class="table table-bordered table-condensed" style="font-size: 10px; width: 100%; margin-bottom: 0;">
                                                                <thead>
                                                                    <tr style="background-color: #f2f2f2;">
                                                                        <th class="text-center" style="padding: 3px;">Grade</th>
                                                                        <th class="text-center" style="padding: 3px;">Grade Point</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr><td class="text-center" style="padding: 2px;">A+</td><td class="text-center" style="padding: 2px;">4.0</td></tr>
                                                                    <tr><td class="text-center" style="padding: 2px;">A</td><td class="text-center" style="padding: 2px;">3.6</td></tr>
                                                                    <tr><td class="text-center" style="padding: 2px;">B+</td><td class="text-center" style="padding: 2px;">3.2</td></tr>
                                                                    <tr><td class="text-center" style="padding: 2px;">B</td><td class="text-center" style="padding: 2px;">2.8</td></tr>
                                                                    <tr><td class="text-center" style="padding: 2px;">C+</td><td class="text-center" style="padding: 2px;">2.4</td></tr>
                                                                    <tr><td class="text-center" style="padding: 2px;">C</td><td class="text-center" style="padding: 2px;">2.0</td></tr>
                                                                    <tr><td class="text-center" style="padding: 2px;">D</td><td class="text-center" style="padding: 2px;">1.6</td></tr>
                                                                    <tr><td class="text-center" style="padding: 2px;">NG</td><td class="text-center" style="padding: 2px;">0.0</td></tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <!-- Right Column: Evaluation & Calculation Method -->
                                                        <div class="col-xs-7" style="padding-left: 5px;">
                                                            <p style="font-weight: bold; margin-bottom: 5px; font-size: 11px;">EVALUATION & CALCULATION METHOD</p>
                                                            <div style="border: 1px solid #ddd; padding: 8px; font-size: 10px; background-color: #fafafa; border-radius: 3px;">
                                                                <ol style="margin-bottom: 0; padding-left: 15px;">
                                                                    <li style="margin-bottom: 3px;"><strong>Calculation Method:</strong> 50% CAS + 50% Summative</li>
                                                                    <li style="margin-bottom: 3px;"><strong>Final GP:</strong> Final GP = (CAS GP + Summative GP) / 2</li>
                                                                    <li style="margin-bottom: 3px;"><strong>For Example (Nepali):</strong> CAS GP = {{ $nepaliTheoryGp }} & Summative GP = {{ $nepaliPracticalGp }}, then Final GP = ({{ $nepaliTheoryGp }} + {{ $nepaliPracticalGp }}) / 2 = <strong>{{ $nepaliFinalGp }} ({{ $nepaliFinalGrade }})</strong></li>
                                                                    <li style="margin-bottom: 3px;"><strong>Overall GPA:</strong> Overall GPA = sum of Final GP / {{ $totalSubjects }} i.e. {{ $sumGradePoints }} / {{ $totalSubjects }} = <strong>{{ $overallGpaFormatted }} ({{ $overallGrade }})</strong></li>
                                                                    <li><strong>Final Result:</strong> <strong>{{ $overallGpaFormatted }} ({{ $overallGrade }})</strong></li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="space-32"></div>
                                            <div class="space-8"></div>
                                             
                                            <div class="row text-uppercase">
                                                <div class="table-responsive">
                                                    <table width="100%">
                                                        <tr>
                                                            <td class="text-left"><strong style="border-top:1px black solid;">Class Teacher</strong></td>
                                                            <td class="text-center"><strong style="border-top:1px black solid;">Exam Coordinator</strong></td>
                                                            <td class="text-center"><strong style="border-top:1px black solid;">Principal</strong></td>
                                                            <td class="text-right"><strong style="border-top:1px black solid;">Parent/Guardian</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="text-center" style="padding-top:30px">
                                                                <strong>Date of Publication : {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}</strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="page-break-after:always;"></div>
        @endforeach
    @endif
@endsection

@section('js')
   @include('includes.scripts.print_script')
@endsection