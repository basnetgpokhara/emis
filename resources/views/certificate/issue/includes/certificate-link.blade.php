<a href="{{ route('certificate.attendance.add', ['id' => encrypt($student->id)]) }}" target="_blank" class="btn btn-sm btn-primary white">
    <i class="ace-icon fa fa-calendar  align-top bigger-125 icon-on-right"></i>
    Attendance
</a>

<a href="{{ route('certificate.transfer.add', ['id' => encrypt($student->id)]) }}" target="_blank" class="btn btn-sm btn-primary white">
    <i class="ace-icon fa fa-exchange  align-top bigger-125 icon-on-right"></i>
    Transfer
</a>

<a href="{{ route('certificate.character.add', ['id' => encrypt($student->id)]) }}" target="_blank" class="btn btn-sm btn-primary white">
    <i class="ace-icon fa fa-user-secret  align-top bigger-125 icon-on-right"></i>
    Character
</a>

<a href="{{ route('certificate.bonafide.add', ['id' => encrypt($student->id)]) }}" target="_blank" class="btn btn-sm btn-primary white">
    <i class="ace-icon fa fa-certificate  align-top bigger-125 icon-on-right"></i>
    Bonafide
</a>

<a href="{{ route('certificate.course-completion.add', ['id' => encrypt($student->id)]) }}" target="_blank" class="btn btn-sm btn-primary white">
    <i class="ace-icon fa fa-line-chart  align-top bigger-125 icon-on-right"></i>
    Course Completion
</a>

<a href="{{ route('certificate.nirgam-utara.add', ['id' => encrypt($student->id)]) }}" target="_blank" class="btn btn-sm btn-primary white">
    <i class="ace-icon fa fa-list  align-top bigger-125 icon-on-right"></i>
    Nirgam Utara
</a>