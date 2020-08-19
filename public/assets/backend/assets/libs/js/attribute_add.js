$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#attribute_add", function () {
		$("#addNewAttribute").text("Add Attribute");
		$("#attribute_name").focus();
		$("#btn_save").text("Add Attribute");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_attribute", function () {
        var attribute_id = $(this).data("id");
        console.log(attribute_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/attributes/"+attribute_id,
			data: {
				id: attribute_id,
			},
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					
					$("#addNewAttribute").text("Edit Attribute");
					$("#btn_save").text("Update Attribute");
					// $("#btn-save").html("Update Blog");
                    $("#attribute_name").val(res.attribute_name);
                    $("#attribute_id").val(res.id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_attribute", function () {
		
		var attribute_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/attributes/"+attribute_id,
				data: {
					id: attribute_id,
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