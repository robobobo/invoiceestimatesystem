<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/foundation.css" />
	<script src="js/vendor/modernizr.js"></script>
	<title>Vision Landscapes Estimates</title>
</head>
<body>
	<div class="row">
		<div class="medium-12 columns text-center">
			<h1>Vision Landscapes Invoice Estimate System</h1>
		</div>
	</div>
		<form action="save.php" method="post">
	<div class="row">
		<div class="medium-4 columns">
			Is this an invoice or an estimate?
		</div>
		<div class="medium-6 columns">

			<select name="type" id="type">
				<option value="estimate">Estimate</option>
				<option value="invoice">Invoice</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="medium-2 columns">
			<input type="text" name="date" id="" placeholder="Enter Date" value="<?php echo Date('dS M y');?>">
		</div>
		<div class="medium-8 columns text-center">
			<input type="text" name="clientName" placeholder="Clients Name">
		</div>
		<div class="medium-2 columns">
			&euro;
		</div>
	</div>
	<div class="row">
		<div class="medium-10 columns">Item description</div>
		<div class="medium-2 columns">Price</div>
	</div>
	<div class="row">
		<div class="medium-10 columns">
			<input type="text" name="description[]" placeholder="Item description">
		</div>
		<div class="medium-2 columns">
			<input type="text" name="price[]" class="last-element price" placeholder="Price">
		</div>
	</div>
	<div class="row">
		<div class="medium-4 columns">
			<a href="#" class="button" id="add-new">Add New Item</a>
		</div>
	</div>
	<div class="row" id="sub-total">
		<div class="medium-4 columns">
			Sub-total
		</div>
		<div class="medium-2 columns">
			<input type="text" name="sub-total-amount" id="sub-total-amount" readonly>
		</div>
	</div>
	<div class="row" id="vat">
		<div class="medium-4 columns">
			Vat @ 13.50%
		</div>
		<div class="medium-2 columns">
			
			<input type="text" name="vat" id="vat-amount" readonly>
		</div>
	</div>
	<div class="row" id="total">
		<div class="medium-4 columns">
			Total
		</div>
		<div class="medium-2 columns">
			<input type="text" name="total-amount" id="total-amount" readonly>
		</div>
	</div>
	<div class="row">
		<div class="medium-4 columns">
			<input type="submit" value="Save" class="button">
		</div>
	</div>
	</form>

	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
	$(document).foundation();
	$(document).ready(function(){
		var newRow = '<div class="row">\
				<div class="medium-9 columns"><input type="text" name="description[]" placeholder="Item description"></div>\
				<div class="medium-2 columns"><input type="text" name="price[]" class="last-element price" placeholder="Price"></div>\
				<div class="medium-1 columns"><input type="checkbox" name="remove[]" class="remove" /></div>\
				</div>';
		$("#add-new").on('click',function(){
			$(this).parent().parent().before(newRow); 
		})
		$(document).on('click','.remove',function(){
			$(this).parent().parent().remove();
		})
		$(document).on('keydown','.last-element',function(e){
			if(e.keyCode == 9){
				$(this).parent().parent().after(newRow); 
			$(this).removeClass("last-element")
			}
		})
		$(document).on('keyup','.price',function(){
			var prices = $(".price");
			var subTotal = 0;
			prices.each(function(i){
				subTotal += parseFloat($(this).val());
			})
			$("#sub-total-amount").val(subTotal.toFixed(2));
			var vat = parseFloat(subTotal*0.135)
			$("#vat-amount").val(vat.toFixed(2));
			var total = parseFloat(subTotal + vat);
			$("#total-amount").val(total.toFixed(2))
		})

	});
	</script>
</body>
</html>