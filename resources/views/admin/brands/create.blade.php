@extends('admin.layouts.app')

@section('content')
                    
				
                
					<!-- /.container-fluid -->
					<section class="content">
						<!-- Default box -->
						<div class="container-fluid">
							<form action="{{ route('brands.store') }}" method="post" name="brandForm" id="brandForm">
								<div class="card">
									<div class="card-body">                                
										<div class="row">
											<div class="col-md-6">
												<div class="mb-3">
													<label for="name">Name</label>
													<input type="text" name="name" id="name" class="form-control" placeholder="Name">    
													<p></p>
												</div>
											</div>
											<div class="col-md-6">
												<div class="mb-3">
													<label for="slug">Slug</label>
													<input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">    
													<p></p>
												</div>
											</div> 

											
										</div>                           
									</div>
								</div>
								<div class="pb-5 pt-3">
									<button type="submit" class="btn btn-primary">Create</button>
									<a href="/brands" class="btn btn-outline-dark ml-3">Cancel</a>
								</div>
							</form>
						</div>
						<!-- /.card -->
					</section>
                @endsection

@section('customJs')


<script>
$("#brandForm").submit(function(event) {
    event.preventDefault();
    var element = $(this);
	$("button[type=submit]").prop('disabled',true);
    $.ajax({
        url: '{{ route("brands.store") }}',
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

	
   



</script>

@endsection

