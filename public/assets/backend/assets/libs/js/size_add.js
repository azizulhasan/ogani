$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#size_add", function () {
		$("#addNewSize").text("Add Size");
		$("#size_name").focus();
		$("#btn_save").text("Add Size");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_size", function () {
        var size_id = $(this).data("id");
        console.log(size_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/sizes/"+size_id,
			data: {
				id: size_id,
			},
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					
					$("#addNewSize").text("Edit Size");
					$("#btn_save").text("Update Size");
					// $("#btn-save").html("Update Blog");
                    $("#size_name").val(res.size_name);
                    $("#size_id").val(res.id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_size", function () {
		
		var size_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/sizes/"+size_id,
				data: {
					id: size_id,
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