@extends('layouts.admin')
@section('title')
    الضبط العام
@endsection

@section('contentHeader')
    الخزن
@endsection

@section('contentHeaderLink')
    <a href="{{ route('admin.treasuries.index') }}">عرض الخزن</a>
@endsection

@section('contentHeaderActive')
    عرض
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">بيانات الضبط العام</h3>
                    <a href="{{ route('admin.treasuries.create') }}" class="btn btn-sm btn-success p-2">اضافة خزانة</a>
                </div>
                    <input type="hidden" id="token_search" value="{{  csrf_token() }}">
                    <input type="hidden" id="ajax_search_url" value="{{ route('admin.treasuries.ajax_search') }}">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-4">
                            <input type="text" id="search_by_text" placeholder="البحث باالاسم" class="form-control mb-2">
                        </div>

                        <div id="ajax_response_searchDiv">
                            @if(@isset($Treasuries) && !@empty($Treasuries))
                                @php
                                    $i = 1;
                                @endphp
                            <table id="example2" class="table table-bordered table-hover">

                                <thead class="custom_thead">

                                <th> مسلسل</th>
                                <th>اسم الخزنة</th>
                                <th>هل رئيسية</th>
                                <th>حاله التفعيل</th>
                                <th>اخر ايصال صرف</th>
                                <th>اخر ايصال التحصيل</th>
                                <th>  التحكم</th>
                                </tbody>
                                <thead>
                                @forelse($Treasuries as $Treasurie)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Treasurie->name }}</td>
                                        <td>@if($Treasurie->is_master == 1) الرئيسية @else  فرعية @endif  </td>
                                        <td>@if($Treasurie->active == 1) مفعل @else  معطل @endif  </td>
                                        <td>{{ $Treasurie->last_isal_exchange }}</td>
                                        <td>{{ $Treasurie->last_isal_collect }}</td>
                                        <td class="mx-auto text-center">
                                            <a href="{{ route('admin.details.index',$Treasurie->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                            <a href="{{route('admin.treasuries.edit',$Treasurie->id)}}" data-id="{{ $Treasurie->id }}" class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i></a>
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
                                {{  $Treasuries->links() }}
                        </div>

                        <br>


                </div>

                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
