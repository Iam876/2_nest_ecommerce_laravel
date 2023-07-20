<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Shipping\shippingDivision;
use App\Models\Shipping\shippingDistrict;
use App\Models\Shipping\shippingState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class shippingController extends Controller
{
    //
    
// Division Part Start
public function AllDivision(){
    return view('backend.shipping.division');
}

public function InsertDivision(Request $request){
     shippingDivision::insert([
        'division_name' => $request->name,
        'status' => $request->status,
        'created_at' => Carbon::now()
    ]);
    return response()->json(['success' => 'Division Successfully inserted']);
}
public function ShowDivision(){
     $data = shippingDivision::latest()->get();
     return response()->json(['data' => $data ]);
}

public function InActive($id){
     $data = shippingDivision::findOrFail($id);
     $data->update(['status'=>'inactive']);
     return response()->json(['success' => 'Division Successfully Inactive' ]);
}
public function Active($id){
     $data = shippingDivision::findOrFail($id);
     $data->update(['status'=>'active']);
     return response()->json(['success' => 'Division Successfully active' ]);
}
public function DeleteDivision($id){
     $data = shippingDivision::findOrFail($id);
     $data->delete();
     return response()->json(['success' => 'Division Successfully Deleted' ]);
}

public function EditDivision($id){
    $data = shippingDivision::findOrFail($id);
    return response()->json(['data' => $data ]);
}
public function UpdateDivision(Request $request,$id){
    $data = shippingDivision::findOrFail($id);
    $data->update([
        'division_name' => $request->name,
        'status' => $request->status,
    ]);
    return response()->json(['success' => 'Division Successfully Updated' ]);
}
// Division Part End







// District Part Start
public function AllDistrict(){
    return view('backend.shipping.district');
}

public function ShowAllDivision(){
    $division = shippingDivision::where('status','active')->latest()->get();
    return response()->json(['division' => $division]);
}

public function DistrictAdd(Request $request){
    shippingDistrict::insert([
        'district_name' =>$request->name,
        'division_id' =>$request->divisionName,
        'status' =>$request->status,
        'created_at' => Carbon::now()
    ]);
    return response()->json(['success' => 'District Added Successfully']);
}

public function ShowDistrict(){
    $district = shippingDistrict::with('division')->whereHas('division',function($query){
        $query->where('status','active');
    })->latest()->get();
    return response()->json(['data'=>$district]);
}

public function InactiveDistrict($id){
    shippingDistrict::findOrFail($id)->update([
        'status'=>'inactive'
    ]);
    return response()->json(['status'=>'District Successfully Inactive']);
}
public function ActiveDistrict($id){
    shippingDistrict::findOrFail($id)->update([
        'status'=>'active'
    ]);
    return response()->json(['status'=>'District Successfully Active']);
}

public function DeleteDistrict($id){
    shippingDistrict::findOrFail($id)->delete();
    return response()->json(['status'=>'District Successfully Deleted']);
}

// District Part End


// All State Part Start
public function AllState(){
    return view('backend.shipping.state');

}
// shippingState
public function ShowAllDistrict(){
    $district = shippingDistrict::with('division')->whereHas('division',function($query){$query->where('status','active');})->where('status','active')->latest()->get();
    return response()->json(['district' => $district]);
}
public function StateAdd(Request $request){
    shippingState::insert([
        'district_id'=>$request->districtName,
        'division_id'=>$request->divisionName,
        'state_name'=>$request->name,
        'status'=>$request->status,
        'created_at'=>Carbon::now(),
    ]);
    return response()->json(['status'=>'State Successfully Added']);
}

public function ShowState(){
    $state = shippingState::with('division','district')->whereHas('division',function($query){
        $query->where('status','active');
    })->whereHas('district',function($query){
        $query->where('status','active');
    })->latest()->get();
    return response()->json(['data'=>$state]);
}
public function Inactivetate($id){
    shippingState::findOrFail($id)->update(['status'=>'inactive']);
        return response()->json(['status'=>'State Successfully Inactive']);
}
public function ActiveState($id){
    shippingState::findOrFail($id)->update(['status'=>'active']);
        return response()->json(['status'=>'State Successfully Active']);
}
public function DeleteState($id){
    shippingState::findOrFail($id)->delete();
    return response()->json(['status'=>'State Successfully Delete']);
}


// All State part End
}
