<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRequest;
use App\Models\Admin;
use App\Models\Sales_matrial_type;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class StoreController extends Controller
{

    public function index()
    {
        //
        $data = Store::select()->orderby('id','DESC')->paginate(PAGINATION_COUNT);
        if (!empty($data)){
            foreach ($data as $datum){
                $datum->added_by_admin = Admin::where('id',$datum->added_by)->value('name');
                if ($datum->updated_by > 0 && $datum->updated_by != null){
                    $datum->updated_by_admin = Admin::where('id',$datum->updated_by)->value('name');
                }
            }
        }
        return view('admin.stores.index',['data' => $data]);
    }

    public function create()
    {
        //
       return view('admin.inv_uoms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
        try {
            $com_code = auth('admin')->user()->com_code;
            // Check if not exits
            $checkExits = Store::where(['name'=>$request->name,'com_code'=>$com_code])->first();
            if ($checkExits == null){
                $data['name'] = $request->name;
                $data['active'] = $request->active;
                $data['address'] = $request->address;
                $data['phones'] = $request->phones;
                $data['added_by'] = auth('admin')->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = date('Y-m-d H:i:s');
                Store::create($data);
                return  redirect()->route('admin.store.index')->with(['success' => 'تم اضافة البيانات بنجاح ❤️❤️😎😎']);
            }else{
                return redirect()->back()->with(['error'=>' اسم المخزن مسجل من قبل'])->withInput();
            }
        }catch (Exception $e){
            return redirect()->back()->with(['error' => 'حدث خطا ما'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $data = Store::find($id);
            return view('admin.stores.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        try{
            $com_code=auth('admin')->user()->com_code;
            $data=Store::select()->find($id);
            if(empty($data)){
                return redirect()->route('admin.store.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists=Store::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
            if($checkExists !=null){
                return redirect()->back()
                    ->with(['error'=>'عفوا اسم الفئة مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['name']=$request->name;
            $data_to_update['active']=$request->active;
            $data_to_update['address']=$request->address;
            $data_to_update['phones']=$request->phones;
            $data_to_update['updated_by']=auth('admin')->user()->id;
            $data_to_update['updated_at']=date("Y-m-d H:i:s");
            Store::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
            return redirect()->route('admin.store.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
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
            $store = Store::find($id);
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
}
