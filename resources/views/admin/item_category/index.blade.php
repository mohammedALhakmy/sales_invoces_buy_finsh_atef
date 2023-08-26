@extends('layouts.admin')
@section('title')
    الضبط العام
@endsection

@section('contentHeader')
فئات الاصناف
@endsection

@section('contentHeaderLink')
    <a href="{{ route('item_categories.index') }}">فئات الاصناف</a>
@endsection

@section('contentHeaderActive')
    عرض
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> بيانات فئات الاصناف</h3>
                    <a href="{{ route('item_categories.create') }}" class="btn btn-sm btn-success p-2">اضافة فئة جديدة</a>
                </div>
                <input type="hidden" id="token_search" value="{{  csrf_token() }}">
                <input type="hidden" id="ajax_search_url" value="{{ route('admin.treasuries.ajax_search') }}">

                <!-- /.card-header -->
                <div class="card-body">
{{--                    <div class="col-md-4">--}}
{{--                        <input type="text" id="search_by_text" placeholder="البحث باالاسم" class="form-control mb-2">--}}
{{--                    </div>--}}

                    <div id="ajax_response_searchDiv">
                        @if(@isset($data) && !@empty($data))
                            @php
                                $i = 1;
                            @endphp
                            <table id="example2" class="table table-bordered table-hover">

                                <thead class="custom_thead">

                                <th> #</th>
                                <th>اسم الفئه</th>
                                <th>حاله التفعيل</th>
                                <th>تاريخ الاضافة</th>
                                <th>تاريخ التعديل</th>
                                <th>  التحكم</th>
                                </tbody>
                                <thead>
                                @forelse($data as $Treasurie)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Treasurie->name }}</td>
                                        <td>@if($Treasurie->active == 1) مفعل @else  معطل @endif  </td>
                                        <th>

                                            @php
                                                $dt = new DateTime($Treasurie['created_at']);
                                                $date = $dt->format("Y-m-d");
                                                $time = $dt->format("h:i ");
                                                $newDateTime = date("A",strtotime($time));
                                                $newDateTimeType = (($newDateTime == "AM") ? "مساء" : "صباحا");
                                            @endphp
                                            {{ $date }}
                                            {{ $time }}
                                            {{ $newDateTimeType }}
                                            بواسطة
                                            {{ $Treasurie['added_by_admin'] }}
                                        </th>
                                        <th>
                                            @if($Treasurie['updated_by'] > 0 && $Treasurie['updated_by'] !=null )

                                                @php
                                                    $dt = new DateTime($Treasurie['updated_at']);
                                                    $date = $dt->format("Y-m-d");
                                                    $time = $dt->format("h:i ");
                                                    $newDateTime = date("A",strtotime($time));
                                                    $newDateTimeType = (($newDateTime == "AM") ? "مساء" : "صباحا");
                                                @endphp
                                                {{ $date }}
                                                {{ $time }}
                                                {{ $newDateTimeType }}
                                                بواسطة
                                                {{ $Treasurie['updated_by_admin'] }}
                                            @else
                                                Dot have data
                                            @endif
                                        </th>
                                        <td class="mx-auto text-center row">
                                            <form action="{{route('item_categories.destroy',$Treasurie->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button id="are_you_sure" class="btn btn-sm btn-danger mt-1"><i class="fa fa-trash"></i></button>
                                            </form>

                                            <a href="{{route('item_categories.edit',$Treasurie->id)}}" data-id="{{ $Treasurie->id }}" class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i></a>
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
                        {{  $data->links() }}
                    </div>

                    <br>


                </div>

                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
