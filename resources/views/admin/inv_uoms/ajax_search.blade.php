@if(@isset($data) && !@empty($data))
    @php
        $i = 1;
    @endphp
    <table id="example2" class="table table-bordered table-hover">

        <thead class="custom_thead">

        <th> #</th>
        <th>اسم الوحده</th>
        <th>نوع الوحده</th>
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
                <td>@if($Treasurie->is_master == 1)  واحد اب @else  واحده تجزئه @endif  </td>
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
                <td class="mx-auto text-center">
                    <a href="{{ route('admin.inv_uoms.destroy',$Treasurie->id) }}" id="are_you_sure" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    <a href="{{route('admin.inv_uoms.edit',$Treasurie->id)}}" data-id="{{ $Treasurie->id }}" class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i></a>
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
    <div class="col-md-12" id="ajax_pagenation_in_serach">
        {{  $data->links() }}
    </div>

@else
    <div class="alert-danger text-black-50 p-2 text-center mx-auto text-black-50">Dot Have Data Show </div>
@endif
