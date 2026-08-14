{{--{"faculties_id":1,"start_date":"2020-06-07","end_date":"2020-06-18","status":"active","faculty":"BACHELOR OF BUSINESS ADMINISTATION","fac_id":1} {"faculties_id":2,"start_date":"2020-06-07","end_date":"2020-06-18","status":"active","faculty":"TESTIMONIAL","fac_id":2}--}}
<tr class="option_value">
    <td>
        {!! Form::hidden('faculties_id[]', $program->faculties_id,  ['class' => 'form-control chosen-select']) !!}
        {!! Form::text('faculties_title[]', $program->faculty,  ['class' => 'form-control',"readonly"]) !!}
    </td>
    <td>
        <div class="form-group">
            <div class=" col-sm-3"></div>
            <div class=" col-sm-7">
                <div class="input-group ">
                    {!! Form::text('program_start_date[]',$program->start_date,  ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required"]) !!}
                    <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
                    {!! Form::text('program_end_date[]',$program->end_date,  ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required"]) !!}
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
            <a href="#" class="btn btn-danger btn-minier bootbox-confirm delete-program" data-id="{{$program->id}}">
                <i class="ace-icon fa fa-trash-o bigger-130"></i>
            </a>
        </div>

    </td>
</tr>

