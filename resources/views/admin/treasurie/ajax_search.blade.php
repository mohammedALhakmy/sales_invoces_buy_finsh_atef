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
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                    <a href="{{route('admin.treasuries.edit',$Treasurie->id)}}" data-id="{{ $Treasurie->id }}" class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i></a>
                </td>

            </tr>
            @php
                $i++;
            @endphp
        @empty
            <div class="alert-danger text-black-50 p-2 text-center mx-auto text-black-50">The Table is Empty</div>

        @endforelse
        </tbody>
    </table>
    <div class="col-md-12" id="ajax_pagenation_in_serach">
        {{  $Treasuries->links() }}
    </div>

@else
    <div class="alert-danger text-black-50 p-2 text-center mx-auto text-black-50">Dot Have Data Show </div>
@endif
