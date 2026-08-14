<div class="row">
    <div class="col-xs-12">
        @include('includes.data_table_header')
        <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>S.N.</th>
                        <th>SEM</th>
                        <th>Subjects</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data['semester']) && $data['semester']->count() > 0)
                        @php($i=1)
                        @foreach($data['semester'] as $semester)
                            <tr>
                                <td class="center first-child">
                                    <label>
                                        <input type="checkbox" name="chkIds[]" value="{{ $semester->id }}" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td colspan="2">
                                                <div class="width-80 label label-info label-xlg">
                                                    <div class="inline position-relative">
                                                        <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                            <span class="white">{{ $semester->semester }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Grading Type</td>
                                            <td>{{ ViewHelper::getGradingTitle($semester->gradingType_id) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Teacher/Staff</td>
                                            <td>{{ ViewHelper::getStaffNameById($semester->staff_id) }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    @if(isset($semester->subjects))
                                        @php($j=1)
                                        @foreach($semester->subjects as $subject)
                                            {{ $j.'. ['.$subject->code.'] '.$subject->title  }}
                                            <hr class="hr-2">
                                            @php($j++)
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $semester->status == 'active'?"btn-info":"btn-warning" }}" >
                                            {{ $semester->status == 'active'?"Active":"In Active" }}
                                            <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('semester.active', ['id' => $semester->id]) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            </li>

                                            <li>
                                                <a href="{{ route('semester.in-active', ['id' => $semester->id]) }}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a class="green" href="{{ route($base_route.'.edit', ['id' => $semester->id]) }}">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                        <a href="{{ route($base_route.'.delete', ['id' => $semester->id]) }}" class="red bootbox-confirm">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
