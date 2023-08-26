<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvuomsRequest;
use App\Models\Admin;
use App\Models\Inv_uom;
use App\Http\Controllers\Controller;
use App\Models\Treasurie;
use Illuminate\Http\Request;
use Mockery\Exception;

class InvUomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Inv_uom::select()->orderby('id','DESC')->paginate(PAGINATION_COUNT);
        if (!empty($data)){
            foreach ($data as $datum){
                $datum->added_by_admin = Admin::where('id',$datum->added_by)->value('name');
                if ($datum->updated_by > 0 && $datum->updated_by != null){
                    $datum->updated_by_admin = Admin::where('id',$datum->updated_by)->value('name');
                }
            }
        }
        return view('admin.inv_uoms.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.inv_uoms.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvuomsRequest $request)
    {
        //
        try {
            $com_code = auth('admin')->user()->com_code;
            // Check if not exits
            $checkExits = Inv_uom::where(['name'=>$request->name,'com_code'=>$com_code])->first();
            if ($checkExits == null){
                $data['name'] = $request->name;
                $data['active'] = $request->active;
                $data['is_master'] = $request->is_master;
                $data['added_by'] = auth('admin')->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = date('Y-m-d H:i:s');
                Inv_uom::create($data);
                return  redirect()->route('admin.inv_uoms.index')->with(['success' => 'تم اضافة البيانات بنجاح ❤️❤️😎😎']);
            }else{
                return redirect()->back()->with(['error'=>' اسم الوحده مسجل من قبل'])->withInput();
            }
        }catch (Exception $e){
            return redirect()->back()->with(['error' => 'حدث خطا ما'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inv_uom $inv_uom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Inv_uom::find($id);
        return view('admin.inv_uoms.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvuomsRequest $request, $id)
    {
        //
        try{
            $com_code=auth('admin')->user()->com_code;
            $data=Inv_uom::select()->find($id);
            if(empty($data)){
                return redirect()->route('admin.inv_uoms.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists=Inv_uom::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
            if($checkExists !=null){
                return redirect()->back()
                    ->with(['error'=>'عفوا اسم الفئة مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['name']=$request->name;
            $data_to_update['active']=$request->active;
            $data_to_update['is_master']=$request->is_master;
            $data_to_update['updated_by']=auth('admin')->user()->id;
            $data_to_update['updated_at']=date("Y-m-d H:i:s");
            Inv_uom::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
            return redirect()->route('admin.inv_uoms.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
        }catch(\Exception $ex){
            return redirect()->back()
                ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $store = Inv_uom::find($id);
            if (!empty($store)){
                $float = $store->delete();
                if ($float){
                    return redirect()->back()->with(['success'=>'تم حذف البيانات بنجاح']);
                }else{
                    return redirect()->back()->with(['error'=>'حدث خطا ما']);
                }
            }else{
                return redirect()->back()->with(['error'=>'عفوا غير قادر الوصول الى البيانات المطلوبة']);
            }
        }catch (Exception $e){
            return redirect()->back()->with(['error'=>'حدث خطا ما'.$e->getMessage()]);
        }
    }


    function ajax_search(Request $request){
        if ($request->ajax()){
            $search_by_text=$request->search_by_text;
            $is_master_search=$request->is_master_search;
            if ($is_master_search=='all'){
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            }else{
                $field1 = "is_master";
                $operator1 = "=";
                $value1 = $is_master_search;
            }
            if ($search_by_text==''){
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            }else{
                $field2 = "name";
                $operator2 = "LIKE";
                $value2 = "%{$search_by_text}%";
            }
            $data = Inv_uom::where($field2,$operator2,$value2) ->where($field1,$operator1,$value1)->
            orderBy('id','DESC')->paginate(PAGINATION_COUNT);
            if (!empty($data)){
                foreach ($data as $datum){
                    $datum->added_by_admin = Admin::where('id',$datum->added_by)->value('name');
                    if ($datum->updated_by > 0 && $datum->updated_by != null){
                        $datum->updated_by_admin = Admin::where('id',$datum->updated_by)->value('name');
                    }
                }
            }
            return view('admin.inv_uoms.ajax_search',['data' => $data]);
        }
    }
}
