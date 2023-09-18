<?php

namespace App\Http\Controllers\admin;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandsController extends Controller
{

    public function index()
    {
        $brands=Brand::latest('id');
        $brands=$brands->get();
        return view('admin.brands.list',compact('brands'));
    }


    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required|unique:brands',
        ]);

        if($validator->passes()){
            $brand=new Brand();
            $brand->name=$request->name;
            $brand->slug=$request->slug;
            $brand->status = $request->status ?? 1;
            $brand->save();
        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);
        } 
    }
}
