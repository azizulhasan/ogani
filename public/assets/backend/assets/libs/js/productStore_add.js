$(document).ready(function(){
	/* When click add Store */
	$("body").on("click", "#productStore_add", function () {
		$("#addProductStore").text("Add Store");
		$("#btn_save").text("Add Store");
		$("#validationform").trigger('reset');
	});

	/* When click edit user */
	$("body").on("click", ".edit_productStore", function () {
		var productStore_id = $(this).data("id");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			method:'get',
			url: $("meta[name='url']").attr("content") + "/dashboard/productStore/"+productStore_id,
			data: {
				id: productStore_id,
			},
			dataType: "json",
			success: function (res) {
                // console.log(res);
				if (res !== '') {
					
					$("#addProductStore").text("Edit Store");
					$("#btn_save").text("Update Store");
					$("#date").val(res.purchase.date);
					$("#reference_no").val(res.purchase.reference_no);
					$("#parchase_rate").val(res.purchaseDetail.parchase_rate);
					$("#quantity").val(res.purchaseDetail.quantity);
                    $("#product_id").val(res.purchaseDetail.product_id);
					$("#productStore_id").val(res.purchaseDetail.id);
					$("#purchase_id").val(res.purchaseDetail.purchase_id);

				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_productStore", function () {
		
		var productStore_id = $(this).data("id");
		var this_button = $(this);
		
		if (confirm("Are You sure want to delete !")) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
			
				method: 'DELETE',
				url: $("meta[name='url']").attr("content") + "/dashboard/productStore/"+productStore_id,
				data: {
					id: productStore_id,
				},
				dataType: "json",
				success: function (res) {
					if(res.status==1){
						this_button.parent().parent().remove()
						$('.alert-success').css('display', 'block');
						$('.alert-success').text(res.message)
						setInterval(() => {
							
							document.querySelector('.alert-success').style.display= 'none';
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