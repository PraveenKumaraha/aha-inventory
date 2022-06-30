@extends('layouts.app', ['page' => 'New Purchase', 'pageSlug' => 'purchase', 'section' => 'purchase'])

@section('content')

<style>
	.form-row {
		margin: 10px;
		margin-left: 20px;
	}

	.col-form-label1 {
		margin-right: 50px;
		padding-right: 40px;
	}

	.col-form-label12 {
		margin-right: 75px;
		padding-right: 40px;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Select2 JS -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
<div class="container-fluid mt--7">
	<!-- //test by dhana -->
	<form method="POST" action="{{ route('InvPurchase.store') }}" autocomplete="off">
		@csrf
		<div class="row">
			<div class="col-xl-12 order-xl-1">
				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">New Purchase</h3>
							</div>
							<!-- <div class="text">
							<a href="" class="btn">Back</a>
						</div>
						<div class="text">
							<a href="" class="btn y">Save</a>
						</div> -->
							<div class="col-4 text-right">
								<button type="button" class="btn btn-primary back">Back</button>
								<button type="reset" class="btn btn-danger reset">Reset</button>

								<button type="submit" class="btn btn-success save">Save</button>



							</div>
						</div>
					</div>
					<div class="card-body">
						
						<div class="container-sm" style="width:100%;border-style: solid;border-color: coral;">

							<div class="form-row">
								<label class=" col-form-label" for="name">Supplier Name:</label>
								<select class="form-control col-sm-2 " id="supplierselect" name="supplier_name">
									<option selected="selected" disabled>Select Supplier</option>
									<?php foreach ($pdtsupplierIds as $row) { ?> <option value="<?php echo ($row["id"]); ?>"><?php echo ($row["supplier_id"]); ?> | <?php echo ($row["supplier_name"]); ?></option>
									<?php } ?>
								</select>
								<!-- </div>
							<div class="form-row"> -->
								<label class=" col-form-label" for="name">Customer Number:</label>
								<input type="text" class="form-control col-sm-2" name="customer_name" id="name" />
							</div>
							<div class="form-row">
								<label class=" col-form-label1" for="name">GSTIN:</label>
								<input type="text" class="form-control col-sm-2" name="gstin" id="name" />
								<!-- </div>
							<div class="form-row"> -->
								<label class=" col-form-label12" for="name">Date:</label>
								<input type="date" class="form-control col-sm-2" name="date" id="name" />
							</div>
						</div>
						<table class="table table-bordered item-table">
							<thead class="thead-light">
								<th>item</th>

								<th>Quantity</th>
								<th>Price</th>
								<th>Tax</th>
								<th>Discount</th>
								<th>Total</th>
								<th>Action</th>
							</thead>
							<tbody>
								<div class="col-sm-12 rowInvoice1">
									<tr class="rowInvoice">

										<td data-select2-id="1">
											<div class="form-group">
												<select class="form-control	select2 item" style="width:150px;height:80px!important" id="product-name1" name="product_name[]">
													<option selected="selected" disabled>Select Product</option>
													<?php foreach ($pdtproductIds as $row) { ?> <option value="<?php echo ($row["id"]); ?>" a_price="<?php echo ($row['a_price']); ?>"><?php echo ($row["product_id"]); ?> | <?php echo ($row["product_name"]); ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
										<td>
											<input type="number" name="qty[]" id="qty1" min="1" class="form-control">
										</td>
										<td>
											<input type="text" name="rate[]" id="rate1" class="form-control">
										</td>
										<td data-select2-id="1">
											<div class="form-group">
												<select class="form-control	select2" style="width:150px;height:80px!important" id="tax-name1" name="tax[]">
													<option selected="selected" disabled>Select Tax</option>
													<?php foreach ($pdttaxids as $row) { ?> <option value="<?php echo ($row["id"]); ?>"><?php echo ($row["tax_name"]); ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
										<!-- <td>
											<input type="text" name="tax[]" id="tax" class="form-control">
										</td> -->
										<td>
											<input type="text" name="disc[]" id="disc1" value="0" class="form-control">
										</td>

										<td>
											<input type="text" name="total[]" id="total1" class="form-control">
										</td>
										<td>

											<a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons" style="color:red">&#xE872;</i></a>
										</td>
									</tr>
								</div>
							</tbody>
						</table>
						<button type="button" class="btn btn-primary add_field">add Pdt</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
@endsection

@push('js')

<script type="text/javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});

<<<<<<< HEAD
	
	var add_button = $(".add_field");
=======
	function addRow() {
		$("#addRowBtn").button("loading");

		var tableLength = $("#productTable tbody tr").length;
		console.log(tableLength);

		var tableRow;
		var arrayNumber;
		var count;
		if (tableLength > 0) {
			tableRow = $("#productTable tbody tr:last").attr('id');
			arrayNumber = $("#productTable tbody tr:last").attr('class');
			count = tableRow.substring(3);
			count = Number(count) + 1;
			arrayNumber = Number(arrayNumber) + 1;
			$("#addRowBtn").button("reset");
			var tr = '';
			tr += '<tr class=' + arrayNumber + ' id="row' + count + '">';
			tr += '<td data-select2-id="' + (count * 50) + '">' +
				'<div class="form-group">' +
				'<select class="form-control select2" style="width: 100%;" id="productName' + count + '" name="product_name[]" onchange="getProductData(' + count + ')">' +
				'<option  value="" selected="selected" disabled>Select Product</option>' + <?php foreach ($pdtproductIds as $row) { ?> '<option value="<?php echo ($row["id"]); ?>" a_price="<?php echo ($row["a_price"]); ?>"><?php echo ($row["product_id"]); ?> | <?php echo ($row["product_name"]); ?></option>' +
				<?php } ?> + '</select>' +
				'</div>' +
				'</td>';
			tr += '<td> <input type="text" name="quantity[]" id="quantity' + count + '"  class="form-control quantity' + count + '"></td>';
			tr += ' <td> <input type="text" name="rate[]" id="rate' + count + '"  class="form-control rate' + count + '"> </td>'
			tr += '<td data-select2-id="' + (count * 50) + '">' +
				'<div class="form-group">' +
				'<select class="form-control select2 tax' + count + '" style="width: 100%;" id="tax' + count + '" name="tax[]"  onchange="getTaxData(' + count + ')">' +
				'<option value="0" selected="selected" disabled>Select Tax</option>' +
				<?php foreach ($pdttaxids as $row) { ?> '<option value="<?php echo ($row["id"]); ?>" taxValue="<?php echo ($row["tax_value"]); ?>"><?php echo ($row["tax_name"]); ?></option>' +
				<?php } ?> '</select>' +
				'</div>' +
				'</td>';
			tr += '<td> <input type="text" name="discount[]" id="discount' + count + '" value="0" class="form-control discount' + count + '"> </td>';
			tr += '<td> <input type="text" name="total[]" id="total' + count + '" class="form-control total' + count + '"> </td>';
			//tr += '<td><a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons" style="color:red">&#xE872;</i></a></td> </tr>';
			tr += '<td><a class="delete" title="Delete" data-toggle="tooltip" onclick="removeProductRow(' + count + ')"><i class="material-icons" style="color:red">&#xE872;</i></a></td> </tr>';

			tr += '</tr>';
			$("#productTable tbody").append(tr);
			$('#' + 'productName' + count).select2();
			$('#' + 'tax' + count).select2();
		} else {
			alert("Please Select Product");
		}
	}

	function onSelectProduct1(row) {

		var actPriceValue = $('option:selected', row).attr('a_price');
		console.log(actPriceValue);
		var $row = row.closest('tr');
		$('.rate').val();
		$('#rate' + id).val();



		console.log($row);
		// var $rateField = $(this).closest('tr').find($('input[name="rate[]"]'));
		// console.log($rateField.val());
		// $rateField.val("");
		// $rateField.val(actPriceValue);
		// var rate = $(this).closest('tr').find('input[name=rate[]]').val();
		//console.log(rate);
	}
	$(".back").on("click", function() {
		var url = "{{ route('InvPurchase.index') }}";
		window.location.href = url;
	});


	var add_button = $(".add_field1");
>>>>>>> 76904c1980b123042466bc7cf6a9f52e82625d32
	var wrapper = $('.item-table > tbody:last-child');
	var x = 1;
	$(add_button).click(function() {
		var lastItem = $('tr:last td:first .select2').val();;


		var currentcount = $('table.item-table tr:last').index() + 1;



		if (lastItem) {
			var count = currentcount + 1;

			var html_code = '';
			html_code += '<tr id="row_id_' + count + '">';

			html_code += '<td data-select2-id="' + (count * 50) + '">' +
				'<div class="form-group">' +
				'<select class="form-control select2 item" style="width: 100%;" id="product-name' + count + '" name="product_name[]">' +
				'<option selected="selected" disabled>Select Product</option>' +
				<?php foreach ($pdtproductIds as $row) { ?> '<option value="<?php echo ($row["id"]); ?>" a_price="<?php echo ($row["a_price"]); ?>" ><?php echo ($row["product_id"]); ?> | <?php echo ($row["product_name"]); ?></option>' +
				<?php } ?> '</select>' +
				'</div>' +
				'</td>';
			html_code += '<td> <input type="text" name="rate[]" id="rate1"  class="form-control"> </td>';
			html_code += '<td> <input type="number" name="qty[]" id="qty1" min="1" class="form-control"> </td>';
			html_code += '<td data-select2-id="' + (count * 50) + '">' +
				'<div class="form-group">' +
				'<select class="form-control select2" style="width: 100%;" id="tax-name' + count + '" name="tax[]">' +
				'<option selected="selected" disabled>Select Tax</option>' +
				<?php foreach ($pdttaxids as $row) { ?> '<option value="<?php echo ($row["id"]); ?>"><?php echo ($row["tax_name"]); ?></option>' +
				<?php } ?> '</select>' +
				'</div>' +
				'</td>';
			html_code += '<td> <input type="text" name="disc[]" id="disc1" value="0" class="form-control"> </td>';
			html_code += '<td> <input type="text" name="total[]" id="total1" class="form-control"> </td>';
			html_code += '<td><a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons" style="color:red">&#xE872;</i></a></td> </tr>';

			wrapper.append(html_code);
			$('#' + 'product-name' + count, wrapper).select2();
			$('#' + 'tax-name' + count, wrapper).select2();

		} else {
			alert("Please Select Product");
		}

	});

	//var trow = "";
	// $(wrapper).append(

	// 	'<tr class="rowInvoice"><td><select id="selProduct1" style="width: 150px;" class="form-control">' + '<option value="">Choose Product</option>' + '<?php $cate = App\Category::where(["category_status" => 1])->get(); ?>@foreach ($cate as $key)<optgroup label="{!! $key->category_name !!}" style="color: green!important;"><?php $pro = App\InventoryItem::where(["category_id" => $key->id, "status" => 1])->get() ?>@foreach($pro as $r) <option value="{!! $r->id !!}" data-commission="" data-retail="{!! $r->s_price !!}">{!! $r->product_name !!}</option> @endforeach</optgroup>@endforeach </select></td> <td>	<input type="text" name="inv[1][commission]" class="comm form-control" placeholder="Commission (RM)" /></td> <td>	<input type="text" name="inv[1][commission]" class="comm form-control" placeholder="Commission (RM)" /></td> <td>	<input type="text" name="inv[1][commission]" class="comm form-control" placeholder="Commission (RM)" /></td> <td>	<input type="text" name="inv[1][commission]" class="comm form-control" placeholder="Commission (RM)" /></td> <td>	<input type="text" name="inv[1][commission]" class="comm form-control" placeholder="Commission (RM)" /></td><td><a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons" style="color:red">&#xE872;</i></a></td></tr>'
	// );
	//initailizeSelect2();
	// });

	// function initailizeSelect21() {
	// 	console.log("well");
	// 	if($(".select2_el").val()){
	// 	$(".select2_el").select2({

	// 		ajax: {
	// 			url: "{{url('getItemData')}}",
	// 			type: "post",
	// 			dataType: 'json',
	// 			delay: 250,
	// 			data: function(params) {
	// 				return {
	// 					_token: '{{csrf_token()}}',
	// 					searchTerm: params.term // search term
	// 				};
	// 			},
	// 			processResults: function(response) {
	// 				var data = response.data;
	// 				console.log(data.length);
	// 				$.each(data, function(key, value) {
	// 					$("#selProduct1").append("<option value='"+value.id+"' selected>"+value.product_name+"</option>");
	// 					$('#selProduct1').trigger('change');
	// 				});
	// 				// return {
	// 				// 	results: response
	// 				// };
	// 			},
	// 			cache: true
	// 		}
	// 	});
	// }
	// }
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#supplierselect').select2();
	});
	$('.item').on('change', function() {
		console.log("well");
		var a_price = $('option:selected', this).attr('a_price');
	
		var $rateField = $(this).closest('tr').find($('input[name="rate[]"]'));
		$rateField.val("");
		$rateField.val(a_price);

	});
</script>  
@endpush
 