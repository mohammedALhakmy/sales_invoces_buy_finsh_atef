@extends('layouts.admin')
@section('title')
   تعديل  الضبط العام
@endsection

@section('contentHeader')
  تعديل  الضبط
@endsection

@section('contentHeaderLink')
    <a href="{{ route('admin.dashboard') }}">الضبط</a>
@endsection

@section('contentHeaderActive')
    تعديل
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(@isset($edit) && !@empty($edit))
                <div class="card-header">
                    <h3 class="card-title"> تعديل بيانات الضبط العام </h3>
                </div>
                <!-- /.card-header -->
                <div class="card card-primary">

                    <form action="{{ route('admin.adminPanelSettings.update',$edit->id) }}" method="post" enctype="multipart/form-data">
{{--                        {{ method_field('HEAD') }}--}}
                        @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">تعديل اسم النظام</label>
                                    <input type="text" class="form-control" name="system_name" value="{{ $edit->system_name }}" placeholder="تعديل اسم النظام" oninvalid="setCustomValidity(' من فظلك ادخل اسم النظام صح')" onchange="try{
                                        setCustomValidity()
                                    }catch (e){}" required>
                                </div>
                                @error('system_name')
                                <span class="alert-danger text-danger m-2 p-2 form-control">{{ $message }}</span>
                                @enderror


                                <div class="form-group">
                                    <label for="exampleInputPassword1">العنوان</label>
                                    <input type="text" class="form-control" name="address" value="{{ $edit->address }}" placeholder="العنوان" oninvalid="setCustomValidity(' من فظلك ادخل عنوان النظام صح')" onchange="try{
                                        setCustomValidity()
                                    }catch (e){}" required>
                                </div>

                                @error('address')
                                <span class="alert-danger text-danger m-2 p-2 form-control">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">الرسالة الى الشركة</label>
                                    <input type="text" class="form-control" name="general_alert" value="{{ $edit->general_alert }}" placeholder="الرسالة الى الشركة" oninvalid="setCustomValidity(' من فظلك ادخل   الرسالة الى الشركة صح')" onchange="try{
                                        setCustomValidity()
                                    }catch (e){}" required>
                                </div>
                                @error('general_alert')
                                <span class="alert-danger text-danger m-2 p-2 form-control">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">هاتف الشركه</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $edit->phone }}" placeholder="هاتف الشركه" oninvalid="setCustomValidity(' من فظلك ادخل    هاتف الشركة صح')" onchange="try{
                                        setCustomValidity()
                                    }catch (e){}" required>
                                </div>

                                @error('phone')
                                <span class="alert-danger text-danger m-2 p-2 form-control">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
{{--                                    <label for="exampleInputFile">لوجو الشركه</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="custom-file">--}}
{{--                                          <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" placeholder="لوجو الشركه" >--}}
{{--                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}

{{--                                    </div>--}}
{{--                                        <div class="input-group-append">--}}
{{--                                            <span class="input-group-text" id="">Upload</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                        <div class="image">
                                            <img src="{{ asset('assets/admin/upload').'/'.$edit['photo'] }}" class="custom_img" alt="{{$edit->system_name  }}">
                                            <button type="button" class="btn btn-sm btn-danger" id="update_image"> تغير الصورة</button>
                                            <button type="button" class="btn btn-sm btn-primary" id="cancel_update_image" style="display: none"> الغاء</button>
                                        </div>

                                    <div id="oldimage">
                                    </div>


                                </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center m-auto mx-auto ">
                                <button type="submit" class="btn btn-primary col-6 ">Submit</button>
                            </div>
                            </div>
                    </form>

                @else
                    <div class="alert-danger text-danger p-2 text-center">Dot Have Data Show </div>
            @endif
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
