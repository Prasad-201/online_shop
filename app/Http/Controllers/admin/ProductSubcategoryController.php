<?php

namespace App\Http\Controllers\Admin; // Correct the namespace here

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class ProductSubcategoryController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->category_id)) {
            $subCategories = SubCategory::where('category_id', $request->category_id)
                ->orderBy('name', 'ASC')
                ->get(); // Add the missing semicolon

            return response()->json([
                'status' => true,
                'sub_category' => $subCategories, // Change 'subCategories' to 'sub_category'
            ]);
        } else {
            // Since there's no $subCategories defined here, you might want to retrieve them or define an empty array
            $subCategories = []; // Define an empty array or retrieve subcategories here

            return response()->json([
                'status' => true,
                'sub_category' => $subCategories, // Change 'subCategories' to 'sub_category'
            ]);
        }
    }
}
