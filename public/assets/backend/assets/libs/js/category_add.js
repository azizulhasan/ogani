$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#category_add", function () {
		$("#addNewCategory").text("Add Category");
		$("#category_name").focus();
		$("#btn_save").text("Add Category");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_category", function () {
        var category_id = $(this).data("id");
        console.log(category_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/categories/"+category_id,
			data: {
				id: category_id,
			},
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					
					$("#addNewCategory").text("Edit Category");
					$("#btn_save").text("Update Category");
					// $("#btn-save").html("Update Blog");
                    $("#category_name").val(res.category_name);
                    $("#category_id").val(res.id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_category", function () {
		
		var category_id = $(this).data("id");
        var this_button = $(this);
        var alertBtn = $('.alert-success');
        sessionStorage.clear();
        localStorage.clear()
		
		if (confirm("Are You sure want to delete !")) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
			
				method: 'DELETE',
				url: $("meta[name='url']").attr("content") + "/dashboard/categories/"+category_id,
				data: {
					id: category_id,
				},
				dataType: "json",
				success: function (res) {
					if(res.status==1){
						this_button.parent().parent().remove()
						alertBtn.css('display', 'block');
						alertBtn.text(res.message)
						setInterval(() => {
							alertBtn.css('display', 'none');
						}, 7000);
					}else{
						alert(res.message)
					}
					
				},
				error: function (data) {
					console.log("Error:", data);
				},
			});
		}
    });
})