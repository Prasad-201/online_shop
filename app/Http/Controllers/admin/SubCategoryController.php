<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{

    public function index()
    {
        $subCategories = SubCategory::latest('id')->get(); // Retrieve subcategories using get()
        return view('admin.sub_category.list', compact('subCategories')); // Remove the $ sign from compact
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories']=$categories;
        return view('admin.sub_category.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category_id'=>'required',
            // 'subcategory' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $subCategory = new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->showHome = $request->showHome;
            $subCategory->category_id = $request->category_id;
            $subCategory->save();

            session()->flash('success', 'Sub Category Created Successfully');
        }

        return response([
            'status' => $validator->passes(),
            'errors' => $validator->errors(),
            'message' => 'Sub Category Created Successfully', // You can remove this line if not needed
        ]);
    }
}
