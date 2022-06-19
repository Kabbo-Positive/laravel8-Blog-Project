<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        return view('admin.setting.index',compact('setting'));
    }

    public function savedata(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'website_name' => 'required|max:255',
            'logo' => 'nullable',
            'favicon' => 'nullable',
            'description' => 'nullable',
            'meta_title' => 'required|max:255',
            'meta_keyword' => 'nullable',
            'meta_description' => 'nullable',
        ]);
        if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }
            $setting = Setting::where('id','1')->first();
            if($setting)
            {
                if ($request->hasFile('logo')) {
                    $path = 'assets/uploads/setting' . $setting->logo;
                        if(File::exists($path))
                        {
                            File::delete($path);
                        }
                    $file = $request->file('logo');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('assets/uploads/setting', $filename);
                    $setting->logo = $filename;
                }
                if ($request->hasFile('favicon')) {
                    $path = 'assets/uploads/setting' . $setting->favicon;
                        if(File::exists($path))
                        {
                            File::delete($path);
                        }
                    $file = $request->file('favicon');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('assets/uploads/setting', $filename);
                    $setting->favicon = $filename;
                }
                $setting->website_name = $request->website_name;
                $setting->description = $request->description;
                $setting->meta_title = $request->meta_title;
                $setting->meta_keyword = $request->meta_keyword;
                $setting->meta_description = $request->meta_description;
                $setting->save();

                return redirect('admin/settings')->with('message','Setting Updated Successfully');
            }
            else
            {
                $setting = new  Setting();
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('assets/uploads/setting', $filename);
                    $setting->logo = $filename;
                }
                if ($request->hasFile('favicon')) {
                    $file = $request->file('favicon');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    $file->move('assets/uploads/setting', $filename);
                    $setting->favicon = $filename;
                }
                $setting->website_name = $request->website_name;
                $setting->description = $request->description;
                $setting->meta_title = $request->meta_title;
                $setting->meta_keyword = $request->meta_keyword;
                $setting->meta_description = $request->meta_description;
                $setting->save();

                return redirect('admin/settings')->with('message','Setting Added Successfully');


            }
    }
}
