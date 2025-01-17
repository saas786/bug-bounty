<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Auth;
use Inertia\Inertia;
use App\Models\VendorRequest;
use App\Models\User;
use Redirect;

class VendorController extends Controller
{

   public function vendorRequests(request $request) {
       
        $data = VendorRequest::all();

       return Inertia::render('Admin/Dashboard', [
           'vendor_requests' => $data,
       ]);
   }
    
   public function vendorApprove(request $request){

        $request->validate([
           'user_id' => 'required',
        ]);

        VendorRequest::where('user_id', $request->user_id)->update(['approved' => 1]);
        User::where('id', $request->user_id)->update(['isVendor' => 1]);

        return Redirect::route('adminDashboard');

   }


   public function vendorApply(){
        
       if(Auth::user()->isVendor == 0){

            $id = Auth::user()->id;

             $tag = VendorRequest::firstOrCreate([                     
                'user_id' => $id,
                'approved' => '0'
                ]);

             return redirect()->route('dashboard');
        }   
       //else do nothing
       
   }

   public static function vendorDashboard(){

        $vendorPrograms = Program::where('vendorID', Auth::user()->id)->get();
        $vendorReports = array();

        //Get all reports for every program that belongs to the current logged in vendor
        foreach($vendorPrograms as $program){

            $programReports = $program->reports()->get();

            foreach($programReports as $programReport){
                array_push($vendorReports, $programReport);
            }        
        }

        $reports = array_reverse($vendorReports);
        
        return Inertia::render('Vendor', [
                'programs' =>  $vendorPrograms,
                'reports' => $reports,
            ]);
       
    }

    public function programDelete(Request $request){

        $input= $request->toArray();
        $id = Auth::user()->id;
        

        Program::where([
            'vendorID' => $id,
            'id' => $input['id']
            ])->delete();

        return redirect()->route('Vendor');
    }
    
    public function programUpdate(Request $request){

         $request->validate([
            'id' => 'required',
           'title' => 'required',
           'descr' => 'required',
        ]);

        Program::where('id', $request->id)->update(['Title' => $request->title, 'Description' => $request->descr]);

        return Redirect::route('Vendor');

    }



}
