<script src="../assets/js/date_time.js"></script>
<script src="../assets/js/vendor/jquery-1.11.1.min.js"></script>
<script src="../assets/js/vendor/jquery-1.11.3.min.js"></script>
<script src="../assets/js/vendor/jquery-1.12.4.js"></script>
<script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="../assets/js/vendor/jquery-ui.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/lib/data-table/datatables.min.js"></script>
<script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="../assets/js/lib/data-table/jszip.min.js"></script>
<script src="../assets/js/lib/data-table/pdfmake.min.js"></script>
<script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="../assets/js/lib/data-table/datatables-init.js"></script>

<script type="text/javascript">

	<!--DateTime On Load-->
	$(document).ready(function(){
		window.onload = date_time('date_time');
 });

	<!--Register Member Fingerprint-->
	$(document).ready(function(){
	$("#MemberID").ready(function(){
		var MemberID = $("#MemberID").val();
		$.ajax ({
				type:'POST',
				 url: "manage_member_register_socket_send.php",
				 data:{MemberID:MemberID},
				 success: function(data){
				 }
			});
		});
	});

	<!--Select Book Category-->
	$(document).ready(function(){
			$('#book_category').on('change',function(){
					var categoryID = $(this).val();
					if(categoryID){
							$.ajax({
									type:'POST',
									url:'manage_book_register_ajax.php',
									data:'category_id='+categoryID,
									success:function(html){
											$('#book_shelf').html(html);
									}
							});
					}else{
							$('#book_shelf').html('<option value="">Select Category First!</option>');
					}
			});
	});

	<!--Check Book Damage-->
	$(document).ready(function(){
	 $('#btn_damage').click(function(){
		if(confirm("Are you sure you want to remark this?")){
		 var id = [];
		 $(':checkbox:checked').each(function(i){
			id[i] = $(this).val();
		 });
		 if(id.length === 0){
			 alert("Please Select atleast one checkbox");
		 }else{
			$.ajax({
			 url:'manage_book_damage_ajax.php',
			 method:'POST',
			 data:{id:id},
			 success:function(){
				 alert("Successfull remark book damage!");
					window.location.reload(true);
			 }
			});
		 }
		}else{
		 return false;
		}
	 });
	});

	<!--On Keyup Borrow Member Fingerprint-->
	$(document).ready(function(){
	$("#member_id").ready(function(){
		var member_id = $("#member_id").val();
		$.ajax({
			url: "manage_issue_borrow_member_ajax.php",
			type: "POST",
			dataType:"JSON",
			data:{
				member_id: member_id
			},
			cache: false,
			success: function(data){
				$("#member_ic").val(data.member_ic);
				$("#member_fullname").val(data.member_fullname);
				$("#member_email").val(data.member_email);
				$("#member_contact").val(data.member_contact);
				$("#member_limit").val(data.member_limit);
				$("#member_id").val(data.member_id);

					alert("Successfull Validate Member!");
				}
			});
		});
	});

	<!--On Keyup Borrow Member TextField -->
	$(document).ready(function(){
		$("#member_ic").keyup(function(){
			var member_ic = $("#member_ic").val();
			$.ajax({
				url: "manage_issue_borrow_member2_ajax.php",
				type: "POST",
				dataType:"JSON",
				data:{
					member_ic: member_ic
				},
				cache: false,
				success: function(data){
					$("#member_id").val(data.member_id);
					$("#member_ic").val(data.member_ic);
					$("#member_fullname").val(data.member_fullname);
					$("#member_email").val(data.member_email);
					$("#member_contact").val(data.member_contact);
					$("#member_limit").val(data.member_limit);
					}
				});
			});
		});

//This!

	<!--Check Member Borrow-->
	$(document).ready(function(){
	 $('#check').click(function(){
		 var member_ic = $("#member_ic").val();
		 $.ajax({
			url:'manage_issue_borrow_availability_ajax.php',
			method:"POST",
			data:{memberIC:member_ic},
			success:function(data)
			{
			 if(data != '0')
			 {
				$('#availability').html('<div class="alert alert-danger"><strong>Failed!</strong> Members must return previous book and pay penalty!</div>');
				$('#btn_borrow').attr("hidden", true);
				$('#insert').attr("hidden", true);
			 }
			 else
			 {
				$('#btn_borrow').attr("hidden", false);
				$('#insert').attr("hidden", false);
			 }
			}
		 })
	});
 });

	<!--On Keyup Borrow Book-->
	$(document).ready(function(){
	$("#book_code").keyup(function(){
		var bookCODE = $("#book_code").val();
		$.ajax({
			url: "manage_issue_borrow_book_ajax.php",
			type: "POST",
			dataType:"JSON",
			data:{
				book_code: bookCODE
			},
			cache: false,
			success: function(data){
					$("#book_tittle").val(data.book_tittle);
					$("#book_category").val(data.book_category);
					$("#book_author").val(data.book_author);
					$("#book_id").val(data.book_id);
				}
			});
		});
	});

	<!--Borrow Book-->
	$(document).ready(function(){
		var count = 0;

		$('#borrow').click(function(){

			$('#book_id').val('');
			$('#book_code').val('');
			$('#book_tittle').val('');
			$('#book_category').val('');
			$('#book_author').val('');

			$('#error_book_id').text('');
			$('#error_book_code').text('');
			$('#error_book_tittle').text('');
			$('#error_book_category').text('');
			$('#error_book_author').text('');

			$('#book_id').css('border-color', '');
			$('#book_code').css('border-color', '');
			$('#book_tittle').css('border-color', '');
			$('#book_category').css('border-color', '');
			$('#book_author').css('border-color', '');

			$('#save').text('Save');

		});

		$('#save').click(function(){

			var member_id = '';
			var member_ic = '';
			var member_limit = '';
			var book_id = '';
			var book_code = '';
			var book_tittle = '';
			var book_category = '';
			var book_author = '';

			var error_member_id = '';
			var error_member_ic = '';
			var error_member_limit = '';
			var error_book_id = '';
			var error_book_code = '';
			var error_book_tittle = '';
			var error_book_category = '';
			var error_book_author = '';

			if($('#member_id').val() == '')
			{
				error_member_id= '';
				$('#error_member_id').text(error_member_id);
				member_id = '';
			}
			else
			{
				error_member_id = '';
				$('#error_member_id').text(error_member_id);
				member_id = $('#member_id').val();
			}

			if($('#member_ic').val() == '')
			{
				error_member_ic= alert('Member ID Required!');
				$('#error_member_ic').text(error_member_ic);
				member_ic = '';
			}
			else
			{
				error_member_ic = '';
				$('#error_member_ic').text(error_member_ic);
				member_ic = $('#member_ic').val();
			}

			if($('#member_limit').val() == '')
			{
				error_member_limit = '';
				$('#error_member_limit').text(error_member_limit);
				member_limit = '';
			}
			else
			{
				error_member_limit = '';
				$('#error_member_limit').text(error_member_limit);
				member_limit = $('#member_limit').val();
			}

			if($('#book_id').val() == '')
			{
				error_book_id = '';
				$('#error_book_id').text(error_book_id);
				$('#book_id').css('border-color', '');
				book_id = '';
			}
			else
			{
				error_book_id = '';
				$('#error_book_id').text(error_book_id);
				$('#book_id').css('border-color', '');
				book_id = $('#book_id').val();
			}

			if($('#book_code').val() == '')
			{
				error_book_code = alert('Book ID Required!');
				$('#error_book_code').text(error_book_code);
				$('#book_code').css('border-color', '');
				book_code = '';
			}
			else
			{
				error_book_code = '';
				$('#error_book_code').text(error_book_code);
				$('#book_code').css('border-color', '');
				book_code = $('#book_code').val();
			}

			if($('#book_tittle').val() == '')
			{
				error_book_tittle = '';
				$('#error_book_tittle').text(error_book_tittle);
				$('#book_tittle').css('border-color', '');
				book_tittle = '';
			}
			else
			{
				error_book_tittle = '';
				$('#error_book_tittle').text(error_book_tittle);
				$('#book_tittle').css('border-color', '');
				book_tittle = $('#book_tittle').val();
			}

			if($('#book_category').val() == '')
			{
				error_book_category = '';
				$('#error_book_category').text(error_book_category);
				$('#book_category').css('border-color', '');
				book_category = '';
			}
			else
			{
				error_book_category = '';
				$('#error_book_category').text(error_book_category);
				$('#book_category').css('border-color', '');
				book_category = $('#book_category').val();
			}

			if($('#book_author').val() == '')
			{
				error_book_author = '';
				$('#error_book_author').text(error_book_author);
				$('#book_author').css('border-color', '');
				book_author = '';
			}
			else
			{
				error_book_author = '';
				$('#error_book_author').text(error_book_author);
				$('#book_author').css('border-color', '');
				book_author = $('#book_author').val();
			}

			if(error_member_id != '' || error_member_ic != '' ||  error_member_limit != '' || error_book_id != '' || error_book_code != '' || error_book_tittle != ''|| error_book_category != '' || error_book_author != '')
			{
				return false;
			}
			else
			{
				if($('#save').text() == 'Save')
				{

					var dataRow = document.getElementById("user_data").rows.length;
					var dataLimit = (dataRow - 1);

					if (dataLimit < member_limit){

						count = count + 1;
						output = '<tr id="row_'+count+'">';
						output += '<input type="hidden" name="hidden_book_id'+count+'" id="book_id'+count+'" value="'+book_id+'" /><input type="hidden" name="hidcount" id="hidcount" value="'+count+'" />';
						output += '<td>'+book_code+'<input type="hidden" name="hidden_book_code[]" id="book_code'+count+'" class="book_code" value="'+book_code+'" /></td>';
						output += '<td>'+book_tittle+'<input type="hidden" name="hidden_book_tittle[]" id="book_tittle'+count+'" value="'+book_tittle+'" /></td>';
						output += '<td>'+book_category+'<input type="hidden" name="hidden_book_category[]" id="book_category'+count+'" value="'+book_category+'" /></td>';
						output += '<td>'+book_author+'<input type="hidden" name="hidden_book_author[]" id="book_author'+count+'" value="'+book_author+'" /></td>';
						output += '<input type="hidden" name="hidden_member_id" id="member_id'+count+'" value="'+member_id+'" />';
						output += '<input type="hidden" name="hidden_member_ic[]" id="member_ic'+count+'" value="'+member_ic+'" />';
						output += '<td align="center"><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'"><i class="fa fa-trash"></i></button></td>';
						output += '</tr>';

						$('#user_data').append(output);

					}else{
						alert ("Limit of Borrow Book!");
					}
				}
				else
				{
					var row_id = $('#hidden_row_id').val();
					output = '<td><input type="hidden" name="hidden_book_id[]" id="book_id'+row_id+'" value="'+book_id+'" /></td>';
					output = '<td>'+book_code+'<input type="hidden" name="hidden_book_code[]" id="book_code'+row_id+'" class="book_code" value="'+book_code+'" /></td>';
					output += '<td>'+book_tittle+'<input type="hidden" name="hidden_book_tittle[]" id="book_tittle'+row_id+'" value="'+book_tittle+'" /></td>';
					output += '<td>'+book_category+'<input type="hidden" name="hidden_book_category[]" id="book_category'+row_id+'" value="'+book_category+'" /></td>';
					output += '<td>'+book_author+'<input type="hidden" name="hidden_book_author[]" id="book_author'+row_id+'" value="'+book_author+'" /></td>';
					output += '<td>'+member_id+'<input type="hidden" name="hidden_member_id[]" id="member_id'+row_id+'" value="'+member_id+'" /></td>';
					output += '<td>'+member_ic+'<input type="hidden" name="hidden_member_ic[]" id="member_ic'+row_id+'" value="'+member_ic+'" /></td>';
					output += '<td align="center"><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'"><i class="fa fa-trash"></button></td>';

					$('#row_'+row_id+'').html(output);
				}
			}
		});

		$(document).on('click', '.remove_details', function(){
			var row_id = $(this).attr("id");
			if(confirm("Are you sure you want to remove this row data?"))
			{
				$('#row_'+row_id+'').remove();
			}
			else
			{
				return false;
			}
		});


		$('#user_form').on('submit', function(event){
			event.preventDefault();
			var count_data = 0;
			$('.book_code').each(function(){
				count_data = count_data + 1;
			});
			if(count_data > 0)
			{
				var form_data = $(this).serialize();
				$.ajax({
					url:"manage_issue_borrow_insert.php",
					method:"POST",
					data:form_data,
					success:function(data)
					{
						$('#user_data').find("tr:gt(0)").remove();

						alert("Data Inserted Successfully!");
						// window.location.reload(true);
					}
				})
			}
			else
			{
				alert("Please Add Atleast One Data!");
			}
		});
	});

	<!--On Keyup Book Return-->
	$(document).ready(function(){
	$("#book_return").keyup(function(){
		var bookCODE = $("#book_return").val();
		$.ajax({
			url: "manage_issue_return_book_ajax.php",
			type: "POST",
			dataType:"JSON",
			data:{
				book_return: bookCODE
			},
			cache: false,
			success: function(data){
					$("#return_id").val(data.return_id);
					$("#book_tittle").val(data.book_tittle);
					$("#book_category").val(data.book_category);
					$("#book_author").val(data.book_author);
					$("#borrow_date").val(data.borrow_date);
					$("#due_date").val(data.due_date);
					$("#penalty_rate").val(data.penalty_rate);
					$("#book_id").val(data.book_id);
				}
			});
		});
	});

	<!--Return Book-->
	$(document).ready(function(){
		var count = 0;

		$('#return').click(function(){

			$('#return_id').val('');
			$('#book_id').val('');
			$('#book_return').val('');
			$('#book_tittle').val('');
			$('#book_category').val('');
			$('#book_author').val('');
			$('#borrow_date').val('');
			$('#due_date').val('');
			$('#penalty_rate').val('');

			$('#error_return_id').text('');
			$('#error_book_id').text('');
			$('#error_book_return').text('');
			$('#error_book_tittle').text('');
			$('#error_book_category').text('');
			$('#error_book_author').text('');
			$('#error_borrow_date').text('');
			$('#error_due_date').text('');
			$('#error_penalty_rate').text('');

			$('#return_id').css('border-color', '');
			$('#book_id').css('border-color', '');
			$('#book_return').css('border-color', '');
			$('#book_tittle').css('border-color', '');
			$('#book_category').css('border-color', '');
			$('#book_author').css('border-color', '');
			$('#borrow_date').css('border-color', '');
			$('#due_date').css('border-color', '');
			$('#penalty_rate').css('border-color', '');

			$('#done').text('Done');

		});

		$('#done').click(function(){

			var return_id = '';
			var book_id = '';
			var book_return = '';
			var book_tittle = '';
			var book_category = '';
			var book_author = '';
			var borrow_date;
			var due_date;
			var penalty_rate;

			var error_return_id = '';
			var error_book_id = '';
			var error_book_return = '';
			var error_book_tittle = '';
			var error_book_category = '';
			var error_book_author = '';
			var error_borrow_date = '';
			var error_due_date = '';
			var error_penalty_rate = '';

			if($('#return_id').val() == '')
			{
				error_return_id = '';
				$('#error_return_id').text(error_return_id);
				$('#return_id').css('border-color', '');
				return_id = '';
			}
			else
			{
				error_return_id = '';
				$('#error_return_id').text(error_return_id);
				$('#return_id').css('border-color', '');
				return_id = $('#return_id').val();
			}

			if($('#book_id').val() == '')
			{
				error_book_id = '';
				$('#error_book_id').text(error_book_id);
				$('#book_id').css('border-color', '');
				book_id = '';
			}
			else
			{
				error_book_id = '';
				$('#error_book_id').text(error_book_id);
				$('#book_id').css('border-color', '');
				book_id = $('#book_id').val();
			}

			if($('#book_return').val() == '')
			{
				error_book_return = alert('Book ID Required!');
				$('#error_book_return').text(error_book_return);
				$('#book_return').css('border-color', '');
				book_return = '';
			}
			else
			{
				error_book_return = '';
				$('#error_book_return').text(error_book_return);
				$('#book_return').css('border-color', '');
				book_return = $('#book_return').val();
			}

			if($('#book_tittle').val() == '')
			{
				error_book_tittle = '';
				$('#error_book_tittle').text(error_book_tittle);
				$('#book_tittle').css('border-color', '');
				book_tittle = '';
			}
			else
			{
				error_book_tittle = '';
				$('#error_book_tittle').text(error_book_tittle);
				$('#book_tittle').css('border-color', '');
				book_tittle = $('#book_tittle').val();
			}

			if($('#book_category').val() == '')
			{
				error_book_category = '';
				$('#error_book_category').text(error_book_category);
				$('#book_category').css('border-color', '');
				book_category = '';
			}
			else
			{
				error_book_category = '';
				$('#error_book_category').text(error_book_category);
				$('#book_category').css('border-color', '');
				book_category = $('#book_category').val();
			}

			if($('#book_author').val() == '')
			{
				error_book_author = '';
				$('#error_book_author').text(error_book_author);
				$('#book_author').css('border-color', '');
				book_author = '';
			}
			else
			{
				error_book_author = '';
				$('#error_book_author').text(error_book_author);
				$('#book_author').css('border-color', '');
				book_author = $('#book_author').val();
			}

			if($('#borrow_date').val() == '')
			{
				error_borrow_date = '';
				$('#error_borrow_date').text(error_borrow_date);
				$('#borrow_date').css('border-color', '');
				borrow_date = '';
			}
			else
			{
				error_borrow_date = '';
				$('#error_borrow_date').text(error_borrow_date);
				$('#borrow_date').css('border-color', '');
				borrow_date = $('#borrow_date').val();
			}

			if($('#due_date').val() == '')
			{
				error_due_date = '';
				$('#error_due_date').text(error_due_date);
				$('#due_date').css('border-color', '');
				due_date = '';
			}
			else
			{
				error_due_date = '';
				$('#error_due_date').text(error_due_date);
				$('#due_date').css('border-color', '');
				due_date = $('#due_date').val();
			}

			if($('#penalty_rate').val() == '')
			{
				error_penalty_rate = '';
				$('#error_penalty_rate').text(error_penalty_rate);
				$('#penalty_rate').css('border-color', '');
				penalty_rate = '';
			}
			else
			{
				error_penalty_rate = '';
				$('#error_penalty_rate').text(error_penalty_rate);
				$('#penalty_rate').css('border-color', '');
				penalty_rate = $('#penalty_rate').val();
			}

			if(error_return_id != '' || error_book_id != '' || error_book_return != '' || error_book_tittle != ''|| error_book_category != '' || error_book_author != '' || error_borrow_date != '' || error_due_date != ''|| error_penalty_rate != '')
			{
				return false;
			}
			else
			{
				if($('#done').text() == 'Done')
				{

					//Months Value to Months Name
					var months = new Array(12);
					months[0] = "Jan";
					months[1] = "Feb";
					months[2] = "Mar";
					months[3] = "Apr";
					months[4] = "May";
					months[5] = "June";
					months[6] = "July";
					months[7] = "Aug";
					months[8] = "Septr";
					months[9] = "Oct";
					months[10] = "Nov";
					months[11] = "Dec";

					//Borrow Date
					var bstr = borrow_date;
					var bdate = new Date(bstr);
					var bday = bdate.getDate();
					var bmonth = (bdate.getMonth()+1);
					var bdmonth = bdate.getMonth();
					var byear = bdate.getFullYear();
					var borrowdate = (byear.toString() + "-" + bmonth.toString() + "-" + bday.toString());
					var borrowDate = (bday+" "+months[bdmonth]+" "+byear);

					//Due Date
					var dstr = due_date;
					var ddate = new Date(dstr);
					var dday = ddate.getDate();
					var dmonth = (ddate.getMonth()+1);
					var ddmonth = ddate.getMonth();
					var dyear = ddate.getFullYear();
					var duedate = (dyear.toString() + "-" + dmonth.toString() + "-" + dday.toString());
					var dueDate = (dday+" "+months[ddmonth]+" "+dyear);

					//Done Date
					var today = new Date();
					var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
					var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
					var done_date = date+' '+time;
					var dnday = today.getDate();
					var dnmonth = (today.getMonth()+1);
					var dndmonth = today.getMonth();
					var dnyear = today.getFullYear();
					var dnd = (dnyear.toString() + "-" + dnmonth.toString() + "-" + dnday.toString());
					var donedate = dnd;
					var doneDate = (dnday+" "+months[dndmonth]+" "+dnyear);

					 //Penalty Day
					 var try_due = duedate;
					 var try_return = donedate;
					 var dateDue = new Date(try_due);
					 var dateReturn = new Date(try_return);
					 var penaltyday = Math.abs(dateReturn.getTime() - dateDue.getTime());
					 var penalty_day = Math.ceil(penaltyday / (1000 * 3600 * 24));

					 //Penalty Amount
					 var penalty_amount = penalty_day*penalty_rate;
					 var penalty_amount = penalty_amount.toFixed(2);

					 var noPenalty = 0;

					if (dateReturn <= dateDue){

							count = count + 1;
							output = '<tr id="row_'+count+'">';
							output += '<input type="hidden" name="hidden_return_id'+count+'" id="return_id'+count+'" value="'+return_id+'" /><input type="hidden" name="returnID" value="'+return_id+'" />';
							output += '<input type="hidden" name="hidden_book_id'+count+'" id="book_id'+count+'" value="'+book_id+'" /><input type="hidden" name="hidcount" id="hidcount" value="'+count+'" />';
							output += '<td>'+book_return+' <input type="hidden" name="hidden_book_return[]" id="book_return" class="book_return" value="'+book_return+'" /></td>';
							output += '<td>'+book_tittle+' <input type="hidden" name="hidden_book_tittle[]" id="book_tittle" value="'+book_tittle+'" /></td>';
							output += '<td>'+borrowDate+' <input type="hidden" name="hidden_borrow_date[]" id="borrow_date" value="'+borrow_date+'" /></td>';
							output += '<td>'+dueDate+' <input type="hidden" name="hidden_due_date[]" id="due_date" value="'+due_date+'" /></td>';
							output += '<td>'+doneDate+' <input type="hidden" name="hidden_done_date'+count+'" id="done_date" value="'+done_date+'" /></td><input type="hidden" name="doneDate" value="'+done_date+'" />';
							output += '<td align="center"><p style="font-weight: bold;color:#000000;">No Penalty</p><input type="hidden" name="hidden_penalty_day'+count+'" id="penalty_day" value="'+noPenalty+'" /></td>';
							output += '<td align="center"><p style="font-weight: bold;color:#000000;">No Penalty</p><input type="hidden" name="hidden_penalty_amount'+count+'" id="penalty_amount" value="'+noPenalty+'" /></td>';
							output += '<td align="center"></i><input type="checkbox" class="form-check-input" name="checklist[]" value="'+book_id+'""></td>';
							output += '<td align="center"><button type="button" name="remove_info" class="btn btn-danger btn-xs remove_info" id="'+count+'"><i class="fa fa-trash"></i></button></td>';
							output += '</tr>';

							$('#return_data').append(output);
					 }
					 else {

							count = count + 1;
							output = '<tr id="row_'+count+'">';
							output += '<input type="hidden" name="hidden_return_id'+count+'" id="return_id'+count+'" value="'+return_id+'" /><input type="hidden" name="returnID" value="'+return_id+'" />';
							output += '<input type="hidden" name="hidden_book_id'+count+'" id="book_id" value="'+book_id+'" /><input type="hidden" name="hidcount" id="hidcount" value="'+count+'" />';
							output += '<td>'+book_return+' <input type="hidden" name="hidden_book_return[]" id="book_return" class="book_return" value="'+book_return+'" /></td>';
							output += '<td>'+book_tittle+' <input type="hidden" name="hidden_book_tittle[]" id="book_tittle" value="'+book_tittle+'" /></td>';
							output += '<td>'+borrowDate+' <input type="hidden" name="hidden_borrow_date[]" id="borrow_date" value="'+borrow_date+'" /></td>';
							output += '<td>'+dueDate+' <input type="hidden" name="hidden_due_date[]" id="due_date" value="'+due_date+'" /></td>';
							output += '<td>'+doneDate+' <input type="hidden" name="hidden_done_date'+count+'" id="done_date" value="'+done_date+'" /></td><input type="hidden" name="doneDate" value="'+done_date+'" />';
							output += '<td align="center"><b><p style="font-weight: bold;color:#d81515">'+penalty_day+' Days</p></b><input type="hidden" name="hidden_penalty_day'+count+'" id="penalty_day" value="'+penalty_day+'" /></td>';
							output += '<td align="center"><b><p style="font-weight: bold;color:#d81515">RM '+penalty_amount+'</p></b><input type="hidden" name="hidden_penalty_amount'+count+'" id="penalty_amount" value="'+penalty_amount+'" /></td>';
							output += '<td align="center"></i><input type="checkbox" class="form-check-input" name="checklist[]" value="'+book_id+'""></td>';
							output += '<td align="center"><button type="button" name="remove_info" class="btn btn-danger btn-xs remove_info" id="'+count+'"><i class="fa fa-trash"></i></button></td>';
							output += '</tr>';

							$('#return_data').append(output);
					 }

				}
				else
				{
					var row_id = $('#hidden_row_id').val();
					output = '<td><input type="hidden" name="hidden_book_id[]" id="book_id'+row_id+'" value="'+book_id+'" /></td>';
					output = '<td>'+book_return+' <input type="hidden" name="hidden_book_return[]" id="book_return'+row_id+'" class="book_return" value="'+book_return+'" /></td>';
					output += '<td>'+book_tittle+' <input type="hidden" name="hidden_book_tittle[]" id="book_tittle'+row_id+'" value="'+book_tittle+'" /></td>';
					output += '<td>'+borrowDate+' <input type="hidden" name="hidden_borrow_date[]" id="borrow_date'+row_id+'" value="'+borrow_date+'" /></td>';
					output += '<td>'+dueDate+' <input type="hidden" name="hidden_due_date[]" id="due_date'+row_id+'" value="'+due_date+'" /></td>';
					output += '<td>'+doneDate+' <input type="hidden" name="hidden_done_date[]" id="done_date'+row_id+'" value="'+done_date+'" /></td>';
					output += '<td align="center"><button type="button" name="remove_info" class="btn btn-danger btn-xs remove_info" id="'+row_id+'"><i class="fa fa-trash"></button></td>';

					$('#row_'+row_id+'').html(output);
				}
			}
		});

		$(document).on('click', '.remove_info', function(){
			var row_id = $(this).attr("id");
			if(confirm("Are you sure you want to remove this row data?"))
			{
				$('#row_'+row_id+'').remove();
			}
			else
			{
				return false;
			}
		});
	});

	<!--Data Table-->
	$(document).ready(function() {
		$('#bootstrap-data-table').DataTable();
	} );

	$(document).ready(function() {
		$('#bootstrap-data-table1').DataTable();
	} );

	$(document).ready(function() {
		$('#bootstrap-data-table2').DataTable();
	} );

	$(document).ready(function() {
		$('#bootstrap-data-table3').DataTable();
	} );

	$(document).ready(function() {
		$('#bootstrap-data-table4').DataTable();
	} );

	$(document).ready(function() {
		$('#bootstrap-data-table5').DataTable();
	} );

</script>

</body>
</html>
