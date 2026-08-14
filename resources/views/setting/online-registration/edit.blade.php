@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include('setting.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        {!! Form::model($data['row'], ['route' => [$base_route.'.update', $data['row']->id], 'method' => 'POST', 'class' => 'form-horizontal',
                            'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}

                            {!! Form::hidden('id', $data['row']->id) !!}

                            @include($view_path.'.includes.form')

                            <div class="clearfix form-actions">
                                <div class="align-right">
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-save bigger-110"></i>
                                        Update
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-24"></div>

                        {!! Form::close() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.summarnote')
    @include('includes.scripts.datepicker_script')
    {{--@include('includes.scripts.delete_confirm')--}}
    <script>
        $(document).ready(function () {
            $('#add-program-html').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('setting.online-registration.program-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            //toastr.warning(data.message, "warning");
                        } else {

                            $('#program_wrapper').append(data.html);
                            //toastr.success(data.message, "success");
                        }
                    }
                });

            });

            $('.delete-program').click(function () {
                id =$(this).data('id');
                $(this).closest('tr').remove();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('setting.online-registration.remove-program') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            toastr.warning(data.message, "warning");
                        } else {
                            toastr.success(data.message, "success");
                        }
                    }
                });

            });

        });
    </script>


@endsection