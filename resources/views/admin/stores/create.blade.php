@extends('layouts.admin')
@section('title')
اضافة مخزن  جديد
@endsection
@section('contentHeader')
مخازن
@endsection
@section('contentHeaderLink')
    <a href="{{ route('admin.store.index') }}">  المخازن</a>
@endsection
@section('contentHeaderActive')
    اضافة
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اضافة مخزن جديد   </h3>
                </div>
                <!-- /.card-header -->
                <div class="card card-primary">
                    <form  action="{{ route('admin.store.store') }}"  method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">اسم  المخزن     </label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                </div>
                                @error('name')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror

                                <div class="form-group">
                                    <label for="">عنوان  المخزن     </label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                                </div>
                                @error('address')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror

                                <div class="form-group">
                                    <label for="">هاتف  المخزن     </label>
                                    <input type="text" name="phones" value="{{ old('phones') }}" class="form-control">
                                </div>
                                @error('phones')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror

                                <div class="form-group m-2">
                                    <label for="exampleInputPassword1" class="m-2">حالة التغعيل </label>
                                    <label for="is_master" class="m-2">نعم <input type="radio"  @if(old('active') == 1) checked @else '' @endif  name="active" value="1"> </label>
                                    <label for="is_master" class="m-2">لا<input type="radio"  @if(old('active') == 0) checked @else '' @endif name="active" value="0">  </label>
                                </div>
                            <div class="card-footer row text-center justify-content-center">
                                <button type="submit" class="btn btn-primary col-5 ">Submit</button>
                            </div>
                            </div>
                    </form>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
