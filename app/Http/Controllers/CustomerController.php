<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // direct create page
    public function createPage(){
        return view("create");
    }

    // create
    public function create(Request $request){

        $this->validationCheck($request, "create");

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
        // dd($data);
        Customer::create($data);
        return redirect()->route('read')->with('createSuccess',"Customer Account ဖန်တီးမှု အောင်မြင်ပါသည်");
    }

    // direct read page
    public function readPage(){
        $data = Customer::orderBy('created_at','desc')->paginate(3);
        return view("read",compact('data'));
    }

    // direct update page
    public function updatePage($id){
        $data = Customer::where("id",$id)->first();
        return view("update",compact("data"));
    }

    // update
    public function update($id, Request $request){
        $this->validationCheck($request, "update");

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "updated_at" => Carbon::now(),
        ];
        Customer::where("id",$id)->update($data);
        return redirect()->route("read")->with('updateSuccess',"Customer Account ပြင်ဆင်မှု အောင်မြင်ပါသည်");
    }

    // delete
    public function delete($id){
        Customer::where("id",$id)->delete();
        return back()->with('deleteSuccess',"Customer Account တစ်ခုဖျက်လိုက်ပါသည်");
    }

    // validation
    private function validationCheck($request, $status){
        if($status == "create"){
            $validationRule = [
                'name' => 'required',
                'email' => "required",
                'phone' => "required|min:6|max:15|unique:customers,phone",
                'address' => "required"
            ];
        }elseif($status == "update"){
            $validationRule = [
                'name' => 'required',
                'email' => "required",
                'phone' => "required|min:6|max:15||unique:customers,phone,".$request->id,
                'address' => "required"
            ];
        }

        $validationMessage = [
            "name.required" => "name ဖြည့်ရန်လိုအပ်ပါသည်",
            "email.required" => "email ဖြည့်ရန်လိုအပ်ပါသည်",
            "phone.required" => "phone no ဖြည့်ရန်လိုအပ်ပါသည်",
            "phone.min" => "phone no သည် အနည်းဆုံးခြောက်လုံးရှိရပါမည်",
            "phone.max" => "phone no သည် ဆယ့်ငါးလုံးမကျော်ရပါ",
            "phone.unique" => "phone no သည် တူနေပါသည်",
            "address" => "address ဖြည့်ရန်လိုအပ်ပါသည်"
        ];

        Validator::make($request->all(),$validationRule,$validationMessage)->validate();
    }
}
