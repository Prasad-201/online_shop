@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <form action="route('sub_category.store') }}" name="subCategoryForm" id="subCategoryForm" method="post">
    <div class="card">
        <div class="card-body">								
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="name">Sub Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                           <option value="" >Select a Category</option>
                            @if($categories->isNotEmpty())
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option> 
                            @endforeach
                           @endif 
                        </select>
                             
                        {{-- <input type="hidden" name="category_id" id="category_id" value="{{$category->category_id}}">
                        <p></p> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                        <p></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email">Slug</label>
                        <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">	
                        <p></p>
                    </div>
                </div>	
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Block</option>
                        </select>
                        <p></p>
                    </div>
                </div>	
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status">Show On Home</label>
                        <select name="showHome" id="showHome" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                
            </div>
        </div>							
    </div>
    <div class="pb-5 pt-3">
        <button class="btn btn-primary" type="submit">Create</button>
        <a href="subcategory.html" class="btn btn-outline-dark ml-3">Cancel</a>
    </div>
</form>
</div>

<!-- /.card -->
</section>                    
					
@endsection

@section('customJs')


<script>
    //slug setting
    	$("#name").change(function(){
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

        //categoryForm Controll 
    $("#subCategoryForm").submit(function(event) {
    event.preventDefault();
    var element = $("#subCategoryForm");
    var category_id = $("#category_id").val();
	$("button[type=submit]").prop('disabled',true);
    $.ajax({
        
        url: '{{ route("sub_category.store") }}',
        type: 'post',
        data: element.serializeArray(),
        subcategory: $('#subcategory').val(),
        category_id: category_id,
        dataType: 'json',
        success: function(response) {
			$("button[type=submit]").prop('disabled',false);

            if (response['status'] == true) {

				// window.location.href="{{route('category.index')}}";

                // $('#name').removeClass('is-invalid').siblings('p')
                //     .removeClass('invalid-feedback').html();

                // $('#slug').removeClass('is-invalid').siblings('p')
                //     .removeClass('invalid-feedback').html("");
            } else {
                var errors = response['errors'];
                if (errors['name']) {
                    $('#name').addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                } else {
                    $('#name').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback').html();
                }

                if (errors['slug']) {
                    $('#slug').addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback').html(errors['slug']);
                } else {
                    $('#slug').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback').html();
                }



                if (errors['subcategory']) {
                    $('#subcategory').addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback').html(errors['subcategory']);
                } else {
                    $('#subcategory').removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback').html();
                }
            }
        },
        error: function(jqXHR, exception) {
            console.log("Something went wrong");
        }
    });
});



</script>

@endsection

