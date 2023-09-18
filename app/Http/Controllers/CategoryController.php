<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;




class CategoryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $categories = Category::latest();

    // if (!empty($request->get('keyword'))) {
    //     $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
    // }


    //     $categories=Category::latest()->paginate(10);
    //     $data['categories']=$categories;     
    //     return view('admin.category.list',$data);
    // }

    public function index(Request $request)
{
    $categories = Category::latest();

    if (!empty($request->get('keyword'))) {
        $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
    }

    $categories = $categories->paginate(10);
    $data['categories'] = $categories;

    return view('admin.category.list', $data);
}

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required|unique:categories',
        ]);

        if($validator->passes())
        {
           $category=new Category();
           $category->name=$request->name;
           $category->slug=$request->slug;
           $category->status=$request->status;
           $category->showHome=$request->showHome;
           $category->save();

// Save Image Here

if (!empty($request->image_id)){
$tempImage =TempImage::find($request->image_id);
$extArray = explode('.',$tempImage->name);
$ext=last($extArray);
$newImageName =$category->id.'.'.$ext;
$sPath=public_path().'/temp/'.$tempImage->name;
$dPath=public_path().'/uploads/category/'.$newImageName;
File::copy($sPath,$dPath);

//Generate ThumbNail 
$dPath=public_path().'/uploads/category/thumb/'.$newImageName;
$img = Image::make($sPath);
$img->resize(450, 600);
$img->save($dPath);


$category->image=$newImageName;
$category->save();
}

           $request->session()->flash('Success','Category Added Successfully');
           return response()->json([
            'status'=>true,
            'message'=>'Category Added Successfully',
           ]);

        }
        else {
            return response()->json([
                'status'=>false,
                'errors'=> $validator->errors(),
            ]);
        }
    }

    public function edit($categoryId,Request $request)
    {
        
        $category=Category::find($categoryId);
        return view('admin.category.edit',compact('category'));
        if(empty($category)){
            return redirect()->route('category.index');
        }

    }

    public function update()
    {
        
    }

    public function destroy()
    {
        
    }

}
