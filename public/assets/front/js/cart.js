
$(document).ready(function(){
	

	/* When click edit unit */
	$("body").on("click", ".featured__item__pic__hover li:nth-child(3)", function (e) {
        e.preventDefault();
        var product_id = $(this).children().data("id");
        console.log(product_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            method:'POST',
			url: $("meta[name='url']").attr("content") + "/addCart",
			data: {
				id: product_id,
			},
			success: function (res) {
				// console.log(res);

				var data = JSON.parse(JSON.stringify(res))
				console.log(data)
				var arr =[];
				for( var key in data){
					arr.push(data[key].id)
				}
				$("#shoppingCart").html(
				`<span>${arr.length}</span>`
				)
				$("#addProductAlert-"+product_id).css('display', 'block');
				$("#addProductAlert-"+product_id).fadeToggle(3000)
				$("#addProductAlert-"+product_id).html(`added to Cart. Total Products : ${arr.length}`)
			
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
	});
	

	$('body').on('click', '#updateCart', function(e){
		e.preventDefault();
		var rowLength= $("#cartItem tr").length;
		var ids = [];
		var qnts = [];
		for(var i =1; i<rowLength+1; i++){
			ids.push($(`#cartItem tr:nth-child(${i})`).data('id'))
			qnts.push($(`#singleItemQnt-${ids[i-1]}`).val())
		}
		var formData = new FormData(); // Currently empty
		formData.append('ids' , ids)
		formData.append('qnts' , qnts)
		console.log(...formData)

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			method: 'POST',
			url: $("meta[name='url']").attr("content") + "/updateCart",
			data: formData,
			dataType: "json",
			cache: false,
        	processData: false,
        	contentType : false,
			type: 'POST',
			success: function (res) {
				console.log(res);
				// if(res.status==1){
				// 	this_button.parent().parent().remove()
				// 	alertBtn.css('display', 'block');
				// 	alertBtn.text(res.message)
				// 	setInterval(() => {
				// 		alertBtn.css('display', 'none');
				// 	}, 7000);
				// }else{
				// 	alert(res.message)
				// }
			},
			error: function (data) {
				console.log("Error:", data);
			},
		});
	})
	/////////////////////////////////////////////////////
	// Check OUt page
	////////////////////////////////////////////////////

	$("#acc").on('change', function(){
		$("#acc_content").toggle();
		$("#acc_pass").toggle()
	})
	$("#acc-or").on('change', function(){
		$("#acc_content_or").toggle();
		$("#acc_pass").toggle()
	})
	




    $("body").on("click", ".delete_brand", function () {
		
		var product_id = $(this).data("id");
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
				url: $("meta[name='url']").attr("content") + "/dashboard/brands/"+product_id,
				data: {
					id: product_id,
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



        // $(".update-cart").click(function (e) {
        //    e.preventDefault();
        //    var ele = $(this);
        //     $.ajax({
        //     //    url: '{{ url('update-cart') }}',
        //        method: "patch",
        //        data: {_token: '{{ csrf_token() }}',
        //         id: ele.attr("data-id"), 
        //         quantity: ele.parents("tr").find(".quantity").val()
        //     },
        //        success: function (response) {
        //            window.location.reload();
        //        }
        //     });
        // });
   

        // $(".remove-from-cart").click(function (e) {
        //     e.preventDefault();
        //     var ele = $(this);
        //     if(confirm("Are you sure")) {
        //         $.ajax({
        //             // url: '{{ url('remove-from-cart') }}',
        //             method: "DELETE",
        //             data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
        //             success: function (response) {
        //                 window.location.reload();
        //             }
        //         });
        //     }
        
        // })
