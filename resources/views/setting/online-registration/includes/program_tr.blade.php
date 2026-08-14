<tr class="option_value">
    <td>
        {!! Form::select('faculties_id[]', $programs, null, ['class' => 'form-control chosen-select',"required"]) !!}
    </td>
    <td>
        <div class="form-group">
            <div class=" col-sm-3"></div>
            <div class=" col-sm-7">
                <div class="input-group ">
                    {!! Form::text('program_start_date[]', null, ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required"]) !!}
                    <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
                    {!! Form::text('program_end_date[]', null, ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required"]) !!}
                </div>
            </div>
            <div class=" col-sm-3"></div>
        </div>
    </td>
    <td>
        {!! Form::select('program_status[]', ['active' => 'Active', 'in-active' => 'Inactive'], request('status'), ['class' => 'from-control']) !!}
    </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="ace-icon fa fa-trash"></i>
            </button>
        </div>

    </td>
</tr>

@include('includes.scripts.datepicker_script')