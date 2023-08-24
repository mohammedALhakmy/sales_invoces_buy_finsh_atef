<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TreasuriesRequest;
use App\Models\Admin;
use App\Models\Treasurie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;


class TreasurieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Treasuries = Treasurie::select()->orderby('id','DESC')->paginate(PAGINATION_COUNT);
        if (!empty($Treasuries)){

            foreach ($Treasuries as $treasury){
                $treasury->added_by_admin = Admin::where("id",$treasury->added_by)->value('name');
                if($treasury->updated_by  > 0 && $treasury->updated_by != null){
                    $treasury->updated_by_admin = Admin::where("id",$treasury->updated_by)->value('name');
                }
            }
        }
        return view('admin.treasurie.index',['Treasuries' => $Treasuries]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.treasurie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TreasuriesRequest $request)
    {
        //
        try {
        $com_code = auth('admin')->user()->com_code;
        //check if not exist
            $checkExist= Treasurie::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExist == null){
                if ($request->is_master == 1){
                    $is_master= Treasurie::where(['is_master' => 1, 'com_code' => $com_code])->first();
                    if ($is_master != null){
                        return redirect()->route('admin.treasuries.index')->with(['error' => 'عغوا يوجد خزنة رئيسية اخرىك']);
                    }
                }
//                dd($request->active);
                $treasuries['name'] = $request->name;
                    $treasuries['is_master'] = $request->is_master;
                    $treasuries['last_isal_exchange'] = $request->last_isal_exchange;
                    $treasuries['last_isal_collect'] = $request->last_isal_collect;
                    $treasuries['active'] = $request->active;
                    $treasuries['added_by'] =auth('admin')->user()->id;
                    $treasuries['com_code'] =$com_code;
                    $treasuries['date'] =date('Y-m-d');
                    Treasurie::create($treasuries);
                    return redirect()->route('admin.treasuries.index')->with(['success' => 'تم حفظ البيانات بنجاح']);
            }else{
                return redirect()->back()->with(['error' => 'عفوا اسم الخزنة مسجل من قبل'])->withInput();
            }
        }catch (Exception $exception){
            return redirect()->route('admin.treasuries.index')->with(['error' => 'عفوا حدث خطأ ما'.$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Treasurie $treasurie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $treasurie)
    {
        //
        $Treasurie = Treasurie::select()->find($treasurie);
        return view("admin.treasurie.edit",compact('Treasurie'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update($id,TreasuriesRequest $request){
//        dd($request);
        try{
            $com_code=auth('admin')->user()->com_code;
            $data=Treasurie::select()->find($id);
            if(empty($data)){
                return redirect()->route('admin.treasuries.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists=Treasurie::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
            if( $checkExists !=null){
                return redirect()->back()
                    ->with(['error'=>'عفوا اسم الخزنة مسجل من قبل'])
                    ->withInput(); }
            if($request->is_master==1){
                $checkExists_isMaster=Treasurie::where(['is_master'=>1,'com_code'=>$com_code])->where('id','!=',$id)->first();
                if($checkExists_isMaster!=null){
                    return redirect()->back()
                        ->with(['error'=>'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لايمكن ان يكون هناك اكثر من خزنة رئيسية'])
                        ->withInput();
                }
            }
            $data_to_update['name']=$request->name;
            $data_to_update['active']=$request->active;
            $data_to_update['is_master']=$request->is_master;
            $data_to_update['last_isal_exchange']=$request->last_isal_exchange;
            $data_to_update['last_isal_collect']=$request->last_isal_collect;
            $data_to_update['updated_by']=auth('admin')->user()->id;
            $data_to_update['updated_at']=date("Y-m-d H:i:s");
            Treasurie::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
            return redirect()->route('admin.treasuries.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
        }catch(\Exception $ex){
            return redirect()->back()
                ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treasurie $treasurie)
    {
        //
    }

    function ajax_search(Request $request){
        if ($request->ajax()){
            $search_by_text=$request->search_by_text;
            $Treasuries = Treasurie::where('name',"LIKE","%{$search_by_text}%") ->
                                    orWhere('last_isal_exchange', 'like', '%' . $search_by_text . '%')->
                                    orWhere('is_master', 'like', '%' . $search_by_text . '%')->
                                    orderBy('id','DESC')->paginate(PAGINATION_COUNT);
            return view('admin.treasurie.ajax_search',['Treasuries' => $Treasuries]);
        }
    }
}
