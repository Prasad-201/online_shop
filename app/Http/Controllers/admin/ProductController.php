<?php

namespace App\Http\Controllers\admin;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product; // Don't forget to import the Product model

class ProductController extends Controller
{
    public function index(){
        // $products=Product::latest('id')->paginate();
        return view('admin.products.list');
    }

    public function create()
    {
        $data=[];
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories']=$categories;
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['brands']=$brands;
        $sub_Categories=SubCategory::orderBy('name', 'ASC')->get();
        $data['sub_Categories']=$sub_Categories;

        return view('admin.products.create',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required',
            // 'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            // 'is_featured' => 'required|in:Yes,No',
        ]);

        // if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
        //     $rules['qty'] = 'required|numeric';
        // }

        if ($validator->passes()) {
            $product = new Product;

            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            // $product->track_qty = $request->input('track_qty', 'Yes'); // Use 0 if it's unchecked
            // $product->qty = $request->input('qty', 0); // Use 0 as the default if qty is not provided

        
            // $product->qty = $request->qty; // Removed the colon ':' after $request->qty
            $product->status = $request->status;
            $product->category_id = $request->category; // Changed Sproduct to $product and corrected the variable name
            $product->sub_category_id = $request->sub_category; // Changed Sproduct to $product and corrected the variable name
            $product->brand_id = $request->product; // Changed $request->brand to $request->product
            // $product->is_featured = $request->is_featured;

            $product->save(); // Added the missing parentheses for the save() method

            // Handle successful product creation here
        } else {
            // Handle validation errors
            return response()->json(['errors' => $validator->errors(), 'status' => false], 422);
        }
    }
}
