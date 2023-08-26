@extends('layouts.admin')
@section('title')
   تعديل الفئات
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
                    <h3 class="card-title">تعديل بيانات  الفئات  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card card-primary">

                    <form  action="{{ route('admin.store.update',$data['id']) }}"  method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="">اسم  المخزن     </label>
                                <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                            </div>
                            @error('name')
                            <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="">عنوان  المخزن     </label>
                                <input type="text" name="address" value="{{ $data->address }}" class="form-control">
                            </div>
                            @error('address')
                            <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="">هاتف  المخزن     </label>
                                <input type="text" name="phones" value="{{ $data->phones }}" class="form-control">
                            </div>
                            @error('phones')
                            <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                            @enderror

                            <div class="form-group m-2">
                                <label for="exampleInputPassword1" class="m-2">حالة التغعيل </label>
                                <label for="is_master" class="m-2">نعم <input type="radio"  @if($data->active == 1) checked @else '' @endif  name="active" value="1"> </label>
                                <label for="is_master" class="m-2">لا<input type="radio"  @if($data->active == 0) checked @else '' @endif name="active" value="0">  </label>
                            </div>
                            <div class="card-footer row text-center justify-content-center">
                                <button type="submit" class="btn btn-primary col-6 ">Update</button>
                            </div>
                            </div>
                    </form>


                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
