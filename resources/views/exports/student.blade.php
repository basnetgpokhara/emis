<table>
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Faculty/Class</th>
            <th>Sem./Sec.</th>
            <th>Reg. Num.</th>
            <th>Reg. Date</th>
            <th>University Reg.</th>
            <th>Student Name</th>
            <th>Date Of Birth</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Nationality</th>
            <th>Mother Tongue</th>
            <th>Email</th>
            <th>Address</th>
            <th>State</th>
            <th>Country</th>
            <th>Temp. Address</th>
            <th>Temp. State</th>
            <th>Temp. Country</th>
            <th>Home Phone</th>
            <th>Mobile 1</th>
            <th>Mobile 2</th>
            <th>Academic Status</th>
            <th>Status</th>
            <th>Grand Father Name</th>
            <th>Father Name</th>
            <th>Father Eligibility</th>
            <th>Father Occupation</th>
            <th>Father Office</th>
            <th>Father Office Number</th>
            <th>Father Resident Number</th>
            <th>Father Mobile 1</th>
            <th>Father Mobile 2</th>
            <th>Father Email</th>
            <th>Mother Name</th>
            <th>Mother Eligibility</th>
            <th>Mother Occupation</th>
            <th>Mother Office</th>
            <th>Mother Office Number</th>
            <th>Mother Resident Number</th>
            <th>Mother Mobile 1</th>
            <th>Mother Mobile 2</th>
            <th>Mother Email</th>
            <th>Guardian Name</th>
            <th>Guardian Eligibility</th>
            <th>Guardian Occupation</th>
            <th>Guardian Office</th>
            <th>Guardian Office Number</th>
            <th>Guardian Resident Number</th>
            <th>Guardian Mobile 1</th>
            <th>Guardian Mobile 2</th>
            <th>Guardian Email</th>
            <th>Guardian Relation</th>
            <th>Guardian Address</th>
            <th>ExtraInfo</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($students) && $students->count() > 0)
        @php($i=1)
        @foreach($students as $student)
            <tr>
                <td>{{ $i }}</td>
                <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
                <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                <td>{{ $student->reg_no }}</td>
                <td>{{ \Carbon\Carbon::parse($student->reg_date)->format('Y-m-d')}} </td>
                <td>{{ $student->university_reg }}</td>
                <td>{{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</td>
                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d')}}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->blood_group }}</td>
                <td>{{ $student->nationality }}</td>
                <td>{{ $student->mother_tongue }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->state }}</td>
                <td>{{ $student->country }}</td>
                <td>{{ $student->temp_address }}</td>
                <td>{{ $student->temp_state }}</td>
                <td>{{ $student->temp_country }}</td>
                <td>{{ $student->home_phone }}</td>
                <td>  {{ $student->mobile_1}}  </td>
                <td> {{ $student->mobile_2}}</td>
                <td>{{ ViewHelper::getStudentAcademicStatusId($student->academic_status) }}</td>
                <td>{{ $student->status=="active"?"Active":"In-Active" }}</td>
                <td>{{ $student->grandfather_first_name.' '.$student->grandfather_middle_name.' '. $student->grandfather_last_name }}</td>
                <td>{{ $student->father_first_name.' '.$student->father_middle_name.' '. $student->father_last_name }}</td>
                <td>{{ $student->father_eligibility }}</td>
                <td>{{ $student->father_occupation }}</td>
                <td>{{ $student->father_office }}</td>
                <td>{{ $student->father_office_number }}</td>
                <td>{{ $student->father_residence_number }}</td>
                <td>{{ $student->father_mobile_1 }}</td>
                <td>{{ $student->father_mobile_2 }}</td>
                <td>{{ $student->father_email }}</td>
                <td>{{ $student->mother_first_name.' '.$student->mother_middle_name.' '. $student->mother_last_name }}</td>
                <td>{{ $student->mother_eligibility }}</td>
                <td>{{ $student->mother_occupation }}</td>
                <td>{{ $student->mother_office }}</td>
                <td>{{ $student->mother_office_number }}</td>
                <td>{{ $student->mother_residence_number }}</td>
                <td>{{ $student->mother_mobile_1 }}</td>
                <td>{{ $student->mother_mobile_2 }}</td>
                <td>{{ $student->mother_email }}</td>
                <td>{{ $student->guardian_first_name.' '.$student->guardian_middle_name.' '. $student->guardian_last_name }}</td>
                <td>{{ $student->guardian_eligibility }}</td>
                <td>{{ $student->guardian_occupation }}</td>
                <td>{{ $student->guardian_office }}</td>
                <td>{{ $student->guardian_office_number }}</td>
                <td>{{ $student->guardian_residence_number }}</td>
                <td>{{ $student->guardian_mobile_1 }}</td>
                <td>{{ $student->guardian_mobile_2 }}</td>
                <td>{{ $student->guardian_email }}</td>
                <td>{{ $student->guardian_relation }}</td>
                <td>{{ $student->guardian_address }}</td>
                <td>{{ $student->extra_info }}</td>
            </tr>
            @php($i++)
        @endforeach
    @endif
    </tbody>
</table>