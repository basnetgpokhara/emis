<div class="easy-link-menu align-right">
    <a class="btn-primary btn-sm " href="{{route('online-registration.registration')}}" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Show Online Registration Form</a>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label" for="status"> Registration Status </label>
    <div class="col-sm-10">
        {!! Form::select('status', ['active'=>'Open','in-active'=>'Close'], null, ['class' => 'form-control border-form']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'status'])
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">
    {!! Form::label('range', 'Open & Close Date', ['class' => 'col-sm-2 control-label']) !!}
    <div class=" col-sm-3">
        <div class="input-group ">
            {!! Form::text('start_date', null, ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            <span class="input-group-addon">
                <i class="fa fa-exchange"></i>
            </span>
            {!! Form::text('end_date', null, ["placeholder" => "", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
        </div>
    </div>
</div>

<div class="space-4"></div>
<div class="form-group">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}

        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>
</div>

<div class="space-4"></div>

@if (isset($data['row']))
    <div class="form-group">
        <label class="col-sm-2 control-label">Existing Logo</label>
        <div class="col-sm-9">
            @if ($data['row']->logo)
                <img src="{{ asset('images/setting/'.$folder_name.'/'.$data['row']->logo) }}" >
            @else
                <p>No image.</p>
            @endif
        </div>
    </div>
@endif
<div class="space-4"></div>
<div class="form-group">
    {!! Form::label('logo_image', 'Logo', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::file('logo_image') !!}
        @include('includes.form_fields_validation_message', ['name' => 'logo_image'])
    </div>
</div>


<div class="space-4"></div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="rules_status"> Rules Status </label>
    <div class="col-sm-10">
        {!! Form::select('rules_status', ['1'=>'Show','0'=>'Hide'], null, ['class' => 'form-control border-form ']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'rules_status'])
    </div>
</div>

<div class="space-4"></div>

<div class="form-group">
    {!! Form::label('rules', 'Rules Info', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('rules', null, ["placeholder" => "", "class" => "form-control border-form summernote"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'rules'])
    </div>
</div>

<div class="space-4"></div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="agreement_status"> Agreement Status </label>
    <div class="col-sm-10">
        {!! Form::select('agreement_status', ['1'=>'Show','0'=>'Hide'], null, ['class' => 'form-control border-form']) !!}
        @include('includes.form_fields_validation_message', ['name' => 'agreement_status'])
    </div>
</div>

<div class="space-4"></div>

<div class="form-group">
    {!! Form::label('agreement', 'Agreement Info', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('agreement', null, ["placeholder" => "", "class" => "form-control border-form summernote"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'agreement'])
    </div>
</div>


<div class="space-4"></div>

<div class="form-group">
    {!! Form::label('registration_guidelines', 'Registration Guideline Info', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('registration_guidelines', null, ["placeholder" => "", "class" => "form-control border-form summernote"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'registration_guidelines'])
    </div>
</div>

<div class="space-4"></div>

<div class="form-group">
    {!! Form::label('registration_close_message', 'Registration Close Message', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('registration_close_message', null, ["placeholder" => "", "class" => "form-control border-form summernote"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'registration_close_message'])
    </div>
</div>


<div class="form-group">
    <table class="table-bordered text-center" WIDTH="100%">
        <thead>
            <tr>
                <th>Faculty/Class</th>
                <th width="30%">Start & End Date</th>
                <th width="20%">Status</th>
                <th width="10%">
                    <button type="button" class="btn btn-xs btn-primary pull-right" id="add-program-html">
                        <i class="fa fa-plus bigger-120"></i> Add Registration Program
                    </button>
                </th>
            </tr>
        </thead>

        <tbody id="program_wrapper">
            @if (isset($data['exist_program']) && $data['exist_program']->count() > 0)
                @foreach($data['exist_program'] as $program)
                    @include($view_path.'.includes.program_tr_edit')
                @endforeach
            @endif
        </tbody>

    </table>
</div>