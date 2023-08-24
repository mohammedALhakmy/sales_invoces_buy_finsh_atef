<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SalesMatrialTypeRequest;
use App\Models\Admin;
use App\Models\Sales_matrial_type;
use App\Models\Treasurie;
use App\Models\Treasurie_deliveries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class SalesMatrialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Sales_matrial_type::select()->orderby('id','DESC')->paginate(PAGINATION_COUNT);
        if (!empty($data)){
            foreach ($data as $datum){
                $datum->added_by_admin = Admin::where('id',$datum->added_by)->value('name');
                if ($datum->updated_by > 0 && $datum->updated_by != null){
                    $datum->updated_by_admin = Admin::where('id',$datum->updated_by)->value('name');
                }
            }
        }
        return view('admin.sales_matrial_types.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.sales_matrial_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesMatrialTypeRequest $request)
    {
        //
        try {
             $com_code = auth('admin')->user()->com_code;
             // Check if not exits
            $checkExits = Sales_matrial_type::where(['name'=>$request->name,'com_code'=>$com_code])->first();
            if ($checkExits == null){
                $data['name'] = $request->name;
                $data['active'] = $request->active;
                $data['added_by'] = auth('admin')->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = date('Y-m-d H:i:s');
                Sales_matrial_type::create($data);
                return  redirect()->route('admin.sales_matrial_types.index')->with(['success' => 'تم اضافة البيانات بنجاح ❤️❤️😎😎']);
            }else{
                return redirect()->back()->with(['error'=>'هذه اسم الفئة مسجلة من قبل'])->withInput();
            }
        }catch (Exception $e){
            return redirect()->back()->with(['error' => 'حدث خطا ما'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales_matrial_type $sales_matrial_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Sales_matrial_type::find($id);
        return view('admin.sales_matrial_types.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalesMatrialTypeRequest $request, $id)
    {
        //
        try{
            $com_code=auth('admin')->user()->com_code;
            $data=Sales_matrial_type::select()->find($id);
            if(empty($data)){
                return redirect()->route('admin.sales_matrial_types.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists=Sales_matrial_type::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
            if($checkExists !=null){
                return redirect()->back()
                    ->with(['error'=>'عفوا اسم الفئة مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['name']=$request->name;
            $data_to_update['active']=$request->active;
            $data_to_update['updated_by']=auth('admin')->user()->id;
            $data_to_update['updated_at']=date("Y-m-d H:i:s");
            Sales_matrial_type::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
            return redirect()->route('admin.sales_matrial_types.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
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
        try {
            $treasurie_deliveries = Sales_matrial_type::find($id);
            if (!empty($treasurie_deliveries)){
                $float = $treasurie_deliveries->delete();
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
