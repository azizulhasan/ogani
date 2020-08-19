$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#discount_add", function () {
		$("#addNewDiscount").text("Add Discount");
		
		$("#btn_save").text("Add Discount");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_discount", function () {
        var discount_id = $(this).data("id");
        console.log(discount_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/discounts/"+discount_id,
			
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					$("#addNewDiscount").text("Edit Discount");
					$("#btn_save").text("Update Discount");
                    $("#discount_percent").val(res[0].discount_percent);
                    $("#product_id").val(res[0].product_id);
                    $("#discount_id").val(res[0].id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_discount", function () {
		
		var discount_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/discounts/"+discount_id,
				data: {
					id: discount_id,
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