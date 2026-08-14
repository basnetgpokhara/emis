<div class="table-responsive">
    <table width="100%" class="table table-bordered">
        <tr>
             <td class="text-right">Name : </td>
            <th class="text-left">{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</th>
            <td class="text-right">Grade : </td>
            <th class="text-left">{{ ViewHelper::getFacultyTitle($student->faculty) }} ({{ ViewHelper::getSemesterTitle($student->semester) }})</th>
            <td class="text-right">Reg No. : </td>
            <th class="text-left">{{ $student->reg_no }}</th>

           
        

        
            
            <td class="text-right">Academic Year : </td>
            <th class="text-left">{{ ViewHelper::getYearById($data['year']) }} B.S.</th>
        </tr>

        
    </table>
</div>