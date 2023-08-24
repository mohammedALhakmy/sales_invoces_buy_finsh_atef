@extends('layouts.admin')
@section('title')
    الضبط العام
@endsection

@section('contentHeader')
    الضبط
@endsection

@section('contentHeaderLink')
    <a href="{{ route('admin.dashboard') }}">الضبط</a>
@endsection

@section('contentHeaderActive')
    show
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(@isset($data) && !@empty($data))
                <div class="card-header">
                    <h3 class="card-title">بيانات الضبط العام</h3>
                    <a href="{{ route('admin.adminPanelSettings.edit',$data->id) }}" class="text-xl"><i class="fa fa-edit"></i></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example2" class="table table-bordered table-hover">

                        <tr>
                            <th class="width30">اسم الشركه</th>
                            <th>{{ $data->system_name }}</th>
                        </tr>

                        <tr>
                            <th class="width30">كود الشركه </th>
                            <th>{{ $data->com_code }}</th>
                        </tr>
                        <tr>
                            <th class="width30">حاله الشركه </th>
                            <th>@if($data['active'] === 1) مفعل @else غير مفعل @endif</th>
                        </tr>

                        <tr>
                            <th class="width30">عنوان الشركه </th>
                            <th>{{ $data->address }}</th>
                        </tr>
                        <tr>
                            <th class="width30">رقم جوال الشركه </th>
                            <th>{{ $data->phone }}</th>
                        </tr>
                        <tr>
                            <th class="width30">رساله التنبية اعلى الشاشة للشركه </th>
                            <th>{{ $data->general_alert }}</th>
                        </tr>

                        <tr>
                            <th class="width30">لوجو الشركة </th>
                            <th>
                                <div class="image"><img src="{{ asset('assets/admin/upload').'/'.$data['photo'] }}" class="custom_img" alt="{{$data->system_name  }}"></div></th>
                        </tr>

                        <tr>
                            <th class="width30">تاريخ اخر تحديث </th>
                            <th>
                                @if($data['updated_by'] > 0 && $data['updated_by'] !=null )

                                    @php
                                    $dt = new DateTime($data['updated_at']);
                                    $date = $dt->format("Y-m-d");
                                    $time = $dt->format("h:i ");
                                    $newDateTime = date("A",strtotime($time));
                                    $newDateTimeType = (($newDateTime == "AM") ? "مساء" : "صباحا");
                                    @endphp
                                    {{ $date }}
                                    {{ $time }}
                                    {{ $newDateTimeType }}
                                    بواسطة
                                    {{ $data['updated_by_admin'] }}
                                    @else
                                    Dot have data
                                @endif
                            </th>
                        </tr>
                    </table>

                </div>
                @else
                    <div class="alert-danger text-black-50 p-2 text-center">Dot Have Data Show </div>
            @endif
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
