<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin_panel_setting_requests;
use App\Models\Admin_panel_setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use  App\Models\Admin;
use Mockery\Exception;

class AdminPanelSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Admin_panel_setting::where('com_code',
            auth('admin')->user()->com_code)->first();
        if (!empty($data)):
            if($data['updated_by'] > 0 && $data['updated_by'] != null){
                $data['updated_by_admin'] = Admin::where("id",$data['updated_by'])->value('name');
            }
        endif;
//        return $data;
        return view('admin.admin_panel_settings.index',['data'=>$data]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Admin_panel_setting $admin_panel_setting)
    {
        //
    }

    public function edit(Admin_panel_setting $admin_panel_setting)
    {
        //
        $edit = Admin_panel_setting::where('com_code',auth('admin')->user()->com_code)->first();
        return view('admin.admin_panel_settings.edit',['edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Admin_panel_setting_requests $requests)
    {
        //

        try {
//            dd($requests);
            $admin_panel_setting = Admin_panel_setting::where('com_code',auth('admin')->user()->com_code)->first();
            $admin_panel_setting->system_name = $requests->system_name;
            $admin_panel_setting->address = $requests->address;
            $admin_panel_setting->general_alert = $requests->general_alert;
            $admin_panel_setting->phone = $requests->phone;
            $admin_panel_setting->updated_by = auth('admin')->user()->id;
            $admin_panel_setting->updated_at = date('Y-m-d H:i:s');
            $photoOldPath = $admin_panel_setting->photo;
            if ($requests->has('photo')){
                $requests->validate([
                   'photo' => 'required|mimes:png,jpg,jpeg|max:2000',
                ]);
                $The_file_path  = upload_image("assets/admin/upload",$requests->photo);
                $admin_panel_setting->photo = $The_file_path;
                if (file_exists("assets/admin/upload/".$The_file_path)){
                    unlink("assets/admin/upload/".$photoOldPath);
                }
            }
            $admin_panel_setting->save();
            return redirect()->route('admin.adminPanelSettings.index')->with(['success' => 'تم تحديث البيانات بنجاح']);

        }catch (Exception $exception){
            return redirect()->route('admin.adminPanelSettings.index')->with(['error' => 'عفوا حدث خطأ ما'.$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin_panel_setting $admin_panel_setting)
    {
        //
    }
}
