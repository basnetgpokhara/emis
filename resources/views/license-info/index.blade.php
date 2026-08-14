@extends('layouts.master')
@section('css')
@endsection
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">

      {{--          +"amount": "24.99"
                +"sold_at": "2020-03-06T21:23:24+11:00"
                +"license": "Regular License"
                +"support_amount": "10.50"
                +"supported_until": "2021-03-07T03:23:24+11:00"
                +"item": {#1904 ▶}
                +"buyer": "waseem_1981"
                +"purchase_count": 1--}}
                <table class="table table-bordered table-hover">
                    <tr>
                        <td colspan="2" class="text-uppercase text-center h3"> Unlimited Edu Firm Certification</td>
                    </tr>
                    <tr>
                        <td class="blue text-right">License :</td>
                        <td>{{$body->license}}</td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Buy Date:</td>
                        <td>{{$body->sold_at}}</td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Buyer:</td>
                        <td><a href="https://codecanyon.net/user/{{$body->buyer}}">{{$body->buyer}}</a></td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Total Purchase:</td>
                        <td>{{$body->purchase_count}}</td>
                    </tr>
                    <tr>
                        <td class="blue text-right">Support Status:</td>
                        <td>
                            {{$body->supported_until}}
                            <span class="label-info white">
                            {{\Carbon\Carbon::parse($body->supported_until)->diffForHumans()}}
                            </span>
                        </td>
                    </tr>
                </table>

            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
@endsection
@section('js')

@endsection