<table class="tab-content">
    <tr>
        <td class="text-right">Name</td>
        <td> : </td>
        <th class="text-left">{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</th>

        <td class="text-right">Reg.No.</td>
        <td> : </td>
        <th class="text-left">{{ $student->reg_no }}</th>
    </tr>
    <tr>
        <td colspan="6">
            <hr class="hr hr-2">
        </td>
    </tr>
    <tr>
        <td class="text-right">Father Name</td>
        <td> : </td>
        <th class="text-left">{{ $student->father_first_name.' '.$student->father_middle_name.' '.$student->father_last_name }}</th>
        <td class="text-right">Batch/Session</td>
        <td> : </td>
        <th class="text-left">{{ $student->title}}</th>
    </tr>
    <tr>
        <td colspan="6">
            <hr class="hr hr-2">
        </td>
    </tr>
    <tr>
        <td class="text-right">Faculty/Class</td>
        <td> : </td>
        <th class="text-left">{{ ViewHelper::getFacultyTitle($student->faculty) }}</th>
        <td class="text-right">Sem./Sec.</td>
        <td> : </td>
        <th class="text-left">{{ ViewHelper::getSemesterTitle($student->semester) }}</th>
    </tr>

</table>