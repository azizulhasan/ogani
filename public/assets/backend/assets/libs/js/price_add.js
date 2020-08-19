$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#price_add", function () {
		$("#addNewPrice").text("Add Price");
		$("#price").focus();
		$("#btn_save").text("Add Price");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_price", function () {
        var price_id = $(this).data("id");
        console.log(price_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/prices/"+price_id,
			
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					$("#addNewPrice").text("Edit Price");
					$("#btn_save").text("Update Price");
                    $("#price").val(res[0].price);
                    $("#old_price").val(res[0].old_price);
                    $("#product_id").val(res[0].product_id);
                    $("#price_id").val(res[0].id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_price", function () {
		
		var price_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/prices/"+price_id,
				data: {
					id: price_id,
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