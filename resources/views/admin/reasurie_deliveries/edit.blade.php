@extends('layouts.admin')
@section('title')
   تعديل خزنة
@endsection

@section('contentHeader')
  الخزن
@endsection

@section('contentHeaderLink')
    <a href="{{ route('admin.treasuries.index') }}">الخزن</a>
@endsection

@section('contentHeaderActive')
    تعديل
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">تعديل بيانات  الخزن  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card card-primary">

{{--                    <form  action="{{ route('admin.treasuries.update',$Treasurie->id) }}"  method="post" enctype="multipart/form-data">--}}
                    <form  action="{{ route('admin.treasuries.update',$Treasurie['id']) }}"  method="post" enctype="multipart/form-data">
{{--                        {{ method_field('HEAD') }}--}}
                        @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> اسم الخزنة</label>
                                    <input type="text" class="form-control" value="{{ $Treasurie->name}}" name="name" placeholder=" اسم الخزنة"  required>
                                </div>
                                @error('name')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror


                                <div class="form-group m-2">
                                    <label for="exampleInputPassword1" class="m-2">هل رئيسية</label>
                                    <label for="is_master"  class="m-2">رئيسية <input type="radio" @if($Treasurie['is_master'] == 1) checked @endif name="is_master" value="1"> </label>
                                    <label for="is_master" class="m-2">فرعية<input type="radio" @if($Treasurie['is_master'] == 0) checked @endif  name="is_master" value="0"> </label>
                                </div>

                                @error('is_master')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror

                                <div class="form-group">
                                    <label for="exampleInputPassword1">اخر ارقم ايصل صرف نقدية لهذه الخزنة</label>
                                    <input type="text" class="form-control" value="{{$Treasurie['last_isal_exchange'] }}" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="last_isal_exchange" placeholder="اخر ارقم ايصل صرف لهذه الخزنة"  required>
                                </div>
                                @error('last_isal_exchange')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">اخر ارقم ايصل تحصيل نقدية لهذه الخزنة  </label>
                                    <input type="text" class="form-control" value="{{ $Treasurie['last_isal_collect'] }}" oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="last_isal_collect" placeholder="اخر ارقم ايصل تحصيل نقدية لهذه الخزنة  "  required>
                                </div>

                                @error('last_isal_collect')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control ">{{ $message }}</span>
                                @enderror
                            <!-- /.card-body -->

                                <div class="form-group m-2">
                                    <label for="exampleInputPassword1" class="m-2">حالة التغعيل </label>
                                    <label for="is_master" class="m-2">نعم <input type="radio" @if($Treasurie['active'] == 1) checked @endif name="active" value="1"> </label>
                                    <label for="is_master" class="m-2">لا<input type="radio"  @if($Treasurie['active'] == 0) checked @endif name="active" value="0">  </label>
                                </div>

                                @error('active')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror

                            <div class="card-footer text-center m-auto mx-auto ">
                                <button type="submit" class="btn btn-primary col-6 ">Update</button>
                            </div>
                            </div>
                    </form>


                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
