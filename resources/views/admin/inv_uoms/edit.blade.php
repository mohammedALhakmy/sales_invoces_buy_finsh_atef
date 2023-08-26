@extends('layouts.admin')
@section('title')
   تعديل الوحدات
@endsection

@section('contentHeader')
  الوجدات
@endsection

@section('contentHeaderLink')
    <a href="{{ route('admin.inv_uoms.index') }}">الوحدات</a>
@endsection

@section('contentHeaderActive')
    تعديل
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">تعديل بيانات  الوحدات  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card card-primary">

                    <form  action="{{ route('admin.inv_uoms.update',$data['id']) }}"  method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="">اسم  الوحده     </label>
                                <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                            </div>
                            @error('name')
                            <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                            @enderror

                            <div class="form-group m-2">
                                <label for="exampleInputPassword1" class="m-2"> هل هذه الوحده رئيسية </label>
                                <label for="is_master" class="m-2">نعم <input type="radio"  @if($data->is_master == 1) checked  @endif  name="is_master" value="1"> </label>
                                <label for="is_master" class="m-2">لا<input type="radio"  @if($data->is_master == 0) checked @endif name="is_master" value="0">  </label>
                            </div>


                            <div class="form-group m-2">
                                <label for="exampleInputPassword1" class="m-2">حالة التغعيل </label>
                                <label for="is_master" class="m-2">نعم <input type="radio"  @if($data->active == 1) checked  @endif  name="active" value="1"> </label>
                                <label for="is_master" class="m-2">لا<input type="radio"  @if($data->active == 0) checked @endif name="active" value="0">  </label>
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
