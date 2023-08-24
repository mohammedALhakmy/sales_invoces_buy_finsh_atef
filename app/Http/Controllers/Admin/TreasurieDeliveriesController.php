<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TreasurieDeliveriesControllerRequest;
use App\Models\Admin;
use App\Models\Treasurie;
use App\Models\Treasurie_deliveries;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Http\Controllers\Controller;

class TreasurieDeliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            $com_code = auth('admin')->user()->com_code;
            $data=Treasurie::select()->find($id);
            if (empty($data)){
                return redirect()->route('admin.treasuries.index')->with(['error'=>'عفوا غير قادر الوصول الى البيانات المطلوبة!!!😎😎']);
            }
            $data['added_by_admin'] = Admin::where("id",$data->added_by)->value('name');
            if ($data['updated_by'] > 0 && $data['updated_by'] != null){
                $data['updated_by_admin'] = Admin::where("id",$data->updated_by)->value('name');
            }

            $Treasurie_deliveries =Treasurie_deliveries::select()->where('treasurie_id',$id)->orderby('id','DESC')->get();

            if (!empty($Treasurie_deliveries)){
                foreach ($Treasurie_deliveries as $treasurie_delivery){
                    $treasurie_delivery->name = Treasurie::where("id",$treasurie_delivery->treasuries_can_delivery_id)->value('name');
                    $treasurie_delivery->added_by_admin = Admin::where("id",$treasurie_delivery->added_by)->value('name');

                }
            }
            return view('admin.reasurie_deliveries.index',['data' => $data,'Treasurie_deliveries'=>$Treasurie_deliveries]);
        }catch (Exception $exception){
            return redirect()->route('admin.treasuries.index')->with(['error' => 'عفوا حدث خطأ ما'.$exception->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {
            $com_code = auth('admin')->user()->com_code;
            $data = Treasurie::select('id','name')->find($id);
            if (empty($data)){
                return redirect()->route('admin.treasuries.index')->with(['error' => '👁️💕عفوا غير قادر الوصول الى البيانات المطلوبة!!!😎😎']);
            }
            $Treasurie = Treasurie::select('id','name')->where(['com_code'=>$com_code,'active'=>1])->get();
            return  view("admin.reasurie_deliveries.create",['data'=>$data,'Treasurie'=>$Treasurie]);
        }catch(Exception $e){
            return redirect()->back()->with(['error'=>'عفوا حدث خطا ما '.$e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TreasurieDeliveriesControllerRequest $request,$id)
    {
        //
        try {
            $com_code = auth('admin')->user()->com_code;
            $data = Treasurie::select('id','name')->find($id);
            if (empty($data)){
                return redirect()->route('admin.treasuries.index')->with(['error'=>'عفوا غير قادر الوصول الى البيانات المطلوبة!!!😎😎']);
            }
            $checkExits = Treasurie_deliveries::where(['treasurie_id'=>$id,'treasuries_can_delivery_id'=>$request->treasuries_can_delivery_id,'com_code'=>$com_code])->first();
            if ($checkExits != null){
                return  redirect()->back()->with(['error'=>'عفوا هذه الخزنة موجوه مسبقا 😒😒'])->withInput();
            }
            $data_deliveries['treasurie_id']=$id;
            $data_deliveries['treasuries_can_delivery_id']=$request->treasuries_can_delivery_id;
            $data_deliveries['added_by']=auth('admin')->user()->id;
            $data_deliveries['com_code']=$com_code;
            Treasurie_deliveries::create($data_deliveries);

            return redirect()->route('admin.details.index',$id)->with(['success' => 'تم اضافة البيانات بنجاح ❤️😎😎']);

        }catch (Exception $e){
            return redirect()->back()->with(['error'=>'عفوا حدث خطا ما'.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Treasurie_deliveries $treasurie_deliveries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treasurie_deliveries $treasurie_deliveries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treasurie_deliveries $treasurie_deliveries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
                $treasurie_deliveries = Treasurie_deliveries::find($id);
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
