@extends('layouts.admin')
@section('title')
    الضبط العام
@endsection

@section('contentHeader')
    الخزن
@endsection

@section('contentHeaderLink')
    <a href="{{ route('admin.treasuries.index') }}">الخزن</a>
@endsection

@section('contentHeaderActive')
    عرض التفاصيل
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                @if(@isset($data) && !@empty($data))
                    <div class="card-header  ">
                        <h3 class="card-title">  تغاصيل الخزنة</h3>
                        <a href="{{route('admin.treasuries.edit',$data->id)}}" data-id="{{ $data->id }}" class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example2" class="table table-bordered table-hover">

                            <tr>
                                <th class="width30">اسم الشركه</th>
                                <th>{{ $data['name'] }}</th>
                            </tr>           <tr>
                                <th class="width30"> خر ايصل الصرف</th>
                                <th>{{ $data['last_isal_exchange'] }}</th>
                            </tr>           <tr>
                                <th class="width30">اخر ايصل التحصيل </th>
                                <th>{{ $data['last_isal_collect'] }}</th>
                            </tr>
         <tr>
                                <th class="width30">هل  هذه الخزنة رئيسية </th>
                                <th>@if($data['is_master'] === 1)رئيسية
                                    @else  فرعية
                                    @endif</th>
                            </tr>
                            <tr>
                                <th class="width30">حاله الشركه </th>
                                <th>@if($data['active'] === 1) مفعل @else غير مفعل @endif</th>
                            </tr>


                            <tr>
                                <th class="width30">تاريخ   الاضافة </th>
                                <th>

                                        @php
                                            $dt = new DateTime($data['created_at']);
                                            $date = $dt->format("Y-m-d");
                                            $time = $dt->format("h:i ");
                                            $newDateTime = date("A",strtotime($time));
                                            $newDateTimeType = (($newDateTime == "AM") ? "مساء" : "صباحا");
                                        @endphp
                                        {{ $date }}
                                        {{ $time }}
                                        {{ $newDateTimeType }}
                                        بواسطة
                                        {{ $data['added_by_admin'] }}
                                </th>
                            </tr>
                            <tr>
                                <th class="width30">تاريخ   التعديل </th>
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
{{--           Start  treasurie_deliveries   --}}
                        <div class="card-header  mt-3">
                            <h3 class="card-title">
                                تفاصيل الخزنة التي
                                سوف تسلم عهدتها  الى الخزنة
                                ( {{ $data->name }} )
                            </h3>
                            <a href="{{route('admin.treasurie_deliveries.add_treasurie_deliveries',$data->id)}}" data-id="{{ $data->id }}" class="btn btn-sm btn-info m-1"><i class="fa fa-plus"></i></a>
                        </div>
                        <div id="ajax_response_searchDiv">
                            @if(@isset($Treasurie_deliveries) && !@empty($Treasurie_deliveries))
                                @php
                                    $i = 1;
                                @endphp
                                <table id="example2" class="table table-bordered table-hover">

                                    <thead class="custom_thead">

                                    <th> مسلسل</th>
                                    <th>اسم الخزنة</th>
                                    <th> تاريخ الاضافة</th>
                                    <th>  التحكم</th>
                                    </tbody>
                                    <thead>
                                    @forelse($Treasurie_deliveries as $Treasurie)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $Treasurie->name }}</td>
                                            <td>
                                                @php
                                                    $dt = new DateTime($data['created_at']);
                                                    $date = $dt->format("Y-m-d");
                                                    $time = $dt->format("h:i ");
                                                    $newDateTime = date("A",strtotime($time));
                                                    $newDateTimeType = (($newDateTime == "AM") ? "مساء" : "صباحا");
                                                @endphp
                                                {{ $date }}
                                                {{ $time }}
                                                {{ $newDateTimeType }}
                                                بواسطة
                                                {{ $data['added_by_admin'] }}
                                            </td>
                                            <td class="mx-auto text-center">
                                                <a href="{{ route('admin.details.destroy',$Treasurie->id) }}" class="btn btn-sm btn-danger" id="are_you_sure"><i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @empty
                                        <div class="alert-danger text-black-50">Empty</div>

                                    @endforelse
                                    </tbody>
                                </table>
                            @else
                                <div class="alert-danger text-black-50 p-2 text-center">Dot Have Data Show </div>
                            @endif
                        </div>
{{--            End treasurie_deliveries   --}}
                    </div>
                @else
                    <div class="alert-danger text-black-50 p-2 text-center">Dot Have Data Show </div>
            @endif
            <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
4-
