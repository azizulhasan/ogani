$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#brand_add", function () {
		$("#addNewBrand").text("Add Brand");
		$("#brand_name").focus();
		$("#btn_save").text("Add Brand");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_brand", function () {
        var brand_id = $(this).data("id");
        console.log(brand_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/brands/"+brand_id,
			data: {
				id: brand_id,
			},
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					
					$("#addNewBrand").text("Edit Brand");
					$("#btn_save").text("Update Brand");
					// $("#btn-save").html("Update Blog");
                    $("#brand_name").val(res.brand_name);
                    $("#brand_id").val(res.id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_brand", function () {
		
		var brand_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/brands/"+brand_id,
				data: {
					id: brand_id,
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