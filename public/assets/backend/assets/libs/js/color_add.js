$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#color_add", function () {
		$("#addNewColor").text("Add Color");
		$("#color_name").focus();
		$("#btn_save").text("Add Color");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_color", function () {
        var color_id = $(this).data("id");
        console.log(color_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/colors/"+color_id,
			
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					
					$("#addNewColor").text("Edit Color");
					$("#btn_save").text("Update Color");
					// $("#btn-save").html("Update Blog");
                    $("#color_name").val(res.color_name);
                    $("#color_id").val(res.id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_color", function () {
		
		var color_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/colors/"+color_id,
				data: {
					id: color_id,
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