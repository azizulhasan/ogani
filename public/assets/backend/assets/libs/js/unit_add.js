$(document).ready(function(){
	/* When click add unit */
	$("body").on("click", "#unit_add", function () {
		$("#addNewUnit").text("Add Unit");
		$("#unit_name").focus();
		$("#btn_save").text("Add Unit");
		$("#validationform").trigger('reset');
	});

	/* When click edit unit */
	$("body").on("click", ".edit_unit", function () {
        var unit_id = $(this).data("id");
        console.log(unit_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'GET',
			url: $("meta[name='url']").attr("content") + "/dashboard/units/"+unit_id,
			data: {
				id: unit_id,
			},
			dataType: "json",
			success: function (res) {
                console.log(res);
				if (res !== '') {
					
					$("#addNewUnit").text("Edit Unit");
					$("#btn_save").text("Update Unit");
					// $("#btn-save").html("Update Blog");
                    $("#unit_name").val(res.unit_name);
                    $("#unit_id").val(res.id);
				}
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
    });


    $("body").on("click", ".delete_unit", function () {
		
		var unit_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/units/"+unit_id,
				data: {
					id: unit_id,
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