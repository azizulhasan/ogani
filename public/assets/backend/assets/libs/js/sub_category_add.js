$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#sub_category_add", function () {
		$("#addNewSubCategory").text("Add Sub Category");
		$("#sub_category_name").focus();
		$("#btn_save").text("Add Sub Category");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_sub_category", function () {
        var sub_category_id = $(this).data("id");
        console.log(sub_category_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/sub_categories/"+sub_category_id,
			
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					$("#addNewSubCategory").text("Edit Sub Category");
					$("#btn_save").text("Update Sub Category");
					$("#sub_category_name").val(res[0].sub_category_name);
					$("#category_id").val(res[0].category_id);
                    $("#sub_category_id").val(res[0].id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_sub_category", function () {
		
		var sub_category_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/sub_categories/"+sub_category_id,
				data: {
					id: sub_category_id,
				},
				dataType: "json",
				success: function (res) {
					console.log(res);
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