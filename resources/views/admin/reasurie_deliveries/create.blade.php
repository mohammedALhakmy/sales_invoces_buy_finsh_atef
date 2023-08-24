@extends('layouts.admin')
@section('title')
الضبط
@endsection
@section('contentHeader')
  الخزن
@endsection
@section('contentHeaderLink')
    <a href="{{ route('admin.treasuries.index') }}">الخزن الفرعية للاستلام</a>
@endsection
@section('contentHeaderActive')
    اضافة
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اضافة خزن للاستلام منها للخزنة ( {{ $data['name'] }} )  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card card-primary">
                    <form  action="{{ route('admin.reasurie_deliveries.store',$data->id) }}"  method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">اختار الخزنة الفرعية </label>
                                    <select name="treasuries_can_delivery_id" id="treasuries_can_delivery_id" class="form-control">
                                        <option value="" disabled>اختار الخنة</option>
                                        @if(@isset($Treasurie) && !@empty($Treasurie))
                                            @forelse($Treasurie as $Treasuries)
                                                <option @if(old('treasuries_can_delivery_id') == $Treasuries->id) selected="selected" @endif value="{{ $Treasuries->id }}">{{ $Treasuries->name }}</option>
                                                @empty
                                                    <div class="alert-danger text-black-50 ">فاضي الخنة من الاقسام</div>
                                                @endforelse
                                        @endif
                                    </select>
                                </div>
                                @error('treasuries_can_delivery_id')
                                <span class="alert-danger text-black-50 m-2 p-2 form-control">{{ $message }}</span>
                                @enderror
                            <div class="card-footer row text-center justify-content-center">
                                <a href="{{ route('admin.treasuries.index') }}" class="btn btn-danger col-5 ml-4">Cancel</a>
                                <button type="submit" class="btn btn-primary col-5 ">Submit</button>
                            </div>
                            </div>
                    </form>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
