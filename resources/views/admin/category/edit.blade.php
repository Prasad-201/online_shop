@extends('admin.layouts.app')

@section('content')
                    
				
                
					<!-- /.container-fluid -->
					<section class="content">
						<!-- Default box -->
						<div class="container-fluid">
							<form action="{{ route('category.store') }}" method="post" name="categoryForm" id="categoryForm">
								<div class="card">
									<div class="card-body">                                
										<div class="row">
											<div class="col-md-6">
												<div class="mb-3">
													<label for="name">Name</label>
													<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$category->name}}">    
													<p></p>
												</div>
											</div>
											<div class="col-md-6">
												<div class="mb-3">
													<label for="slug">Slug</label>
													<input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug" value="{{$category->slug}}">    
													<p></p>
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
											

											<div class="col-md-6">
												<div class="mb-3">
													<label for="status">Status</label>
													<select name="status" id="status" class="form-control">
														<option value="1">Active</option>
														<option value="0">Block</option>
													</select>
												</div>
											</div>
										</div>                           
									</div>
								</div>
								<div class="pb-5 pt-3">
									<button type="submit" class="btn btn-primary">Create</button>
									<a href="/categories" class="btn btn-outline-dark ml-3">Cancel</a>
								</div>
							</form>
						</div>
						<!-- /.card -->
					</section>
                @endsection

@section('customJs')


<script>
$("#categoryForm").submit(function(event) {
    event.preventDefault();
    var element = $(this);
	$("button[type=submit]").prop('disabled',true);
    $.ajax({
        url: '{{ route("category.store") }}',
        type: 'post',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response) {
			$("button[type=submit]").prop('disabled',false);

            if (response['status'] == true) {

				window.location.href="{{route('category.index')}}";

                $('#name').removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html();

                $('#slug').removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html();
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
            }
        },
        error: function(jqXHR, exception) {
            console.log("Something went wrong");
        }
    });
});

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

	const dropzone = $("#image").dropzone({
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url: "{{ route('temp-images.create') }}",
	type: 'post',
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg, image/png, image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(file, response) {
        $("#image_id").val(response.image_id); // Corrected line
    }
});


</script>

@endsection

