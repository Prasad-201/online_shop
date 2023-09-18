@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Product</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="products.html" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
                    <form action="/products/store" name="productForm" id="productForm" method="post">
                        @csrf
					<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">	
                                                <p class="error"></p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="Slug">Slug</label>
                                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="slug">	
                                                    <p class="error"></p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                                    <p class="error"></p>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="hidden" id="image_id" name='image_id' value="">
                                        <label for="image">Image</label>
                                        <input type="file" class="dropzone dz-clickable" id="image"> <!-- Corrected attributes -->
                                        <div class="dz-message needsclick">
                                            <br>Drop Files or Image Here
                                        </div>    	
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">	
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="compare_price">Compare at Price</label>
                                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                                    <p class="text-muted mt-3">
                                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                                    </p>	
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Inventory</h2>								
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">	
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                                </div>
                                            </div>   
                                            <div class="col-md-12">
                                                {{-- <div class="mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" checked>
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">	
                                                </div> --}}
                                            </div>                                         
                                        </div>
                                    </div>	                                                                      
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Select A Category</option>

                                                   @if($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                   <option value="{{$category->id}}">{{$category->name}}</option> 
                                                @endforeach
                                                @endif 
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="category">Sub category</label>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                                <option value="">Select a Subcategory</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product brand</h2>
                                        <div class="mb-3">
                                            <select name="product" id="product" class="form-control">
                                                <option value="">Select A Category</option>
                                                   @if($brands->isNotEmpty())
                                                @foreach ($brands as $brand)
                                                   <option value="{{$brand->id}}">{{$brand->name}}</option> 
                                                @endforeach
                                                @endif 
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                {{-- <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Featured product</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>                                                
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>                                 
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button class="btn btn-primary" type="submit">Create</button>
							<a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
                    </form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				
				<strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
			</footer>
@endsection

@section('customJs')
<script>
    

$("#title").change(function(){
    element=$(this);
    $("button[type=submit]").prop('disabled',true);
$.ajax({
    
url: '{{ route("getSlug") }}',
type: 'get',
data: {title:element.val()},
dataType: 'json',
success: function(response) {
    $("button[type=submit]").prop('disabled',false);
    if(response["status"]==true){
        $("#slug").val(response["slug"]);
    }
}
});
});

$("#productForm").submit(function(event){
    event.preventDefault();
    var formArray=$(this).serializeArray();
    var element = $(this);

    $.ajax({
        url: '{{ route("products.store") }}',
        type: 'post',
        data: formArray,
        dataType: 'json',
        success: function(response) {
            if(response['status']==true){

            }else{
                var errors=response['errors'];
                if(errors['title']){
                    $('#title').addClass('is-invalid').sibiling('p').
                    addClass('invalid-feedback')
                    .html(errors['title']);
                }
            }
        },
           error:function(){
            console.log('!!! Something Went Wrong !!!');
           }
        }
    });

   
$(document).ready(function() {
    $('#category').change(function() {
        var category_id = $(this).val(); // Get the selected category's value
        
        $.ajax({
            url: '{{ route("product-subcategories.index") }}', // Make sure the route name is correct
            type: 'get',
            data: { category_id: category_id },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Log the response data

                $("#sub_category").find("option").not(".first").remove();
                 $.each(response["$sub_category"],function(key,item){
                        $("#sub_category").append('<option value="${item.id}">${item.name}</option>');
                 });
            },
            error: function() {
                console.log('!!! Something Went Wrong !!!');
            }
        });
    });
});



const dropzone = $("#image_id").dropzone({
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url: "{{ route('temp-images.create') }}",
	type: 'post',
    maxFiles: 10,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg, image/png, image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(file, response) {
        $("#image_id").val(response.image_id); // Corrected line
    }


var html = `<div class="col-md-3"><div class="card">
    <input type="hidden" name="image_array" value="${response.image_id}">
    <img src="${response.ImagePath}" class="card-img-top" alt="">
    <div class="card-body">
        <a href="#" class="btn btn-danger">Delete</a>
    </div>
</div></div>`;

$("#product-gallery").append(html);

});


</script>
@endsection
