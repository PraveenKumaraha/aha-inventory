
$(document).ready(function() {
    $('.select2').select2();
});

 function getProductData(rowId = null) {
    if (rowId) {

       var productId = $("#productName" + rowId).val();
       var actualPrice = $("#productName" + rowId).find("option:selected").attr('a_price');
       $("#rate" + rowId).val("");
       $("#rate" + rowId).val(actualPrice);
       $("#quantity" + rowId).val("");
       $("#quantity" + rowId).val(1);
       $("#total" + rowId).val("");
       var total = Number(actualPrice) * 1;

       total = total.toFixed(2);
       $("#total" + rowId).val(total);
       var taxId = $("#tax" + rowId).val();
       if (taxId) {
          getTaxData(rowId);
       }
    } else {
       alert('no row !! please refresh the page');
    }

 }
 function removeProductRow(row = null) {
    var tableLength = $("#productTable tbody tr").length;
    console.log(tableLength);
    if (tableLength != 1) {
       if (row) {
          $("#row" + row).remove();


          //subAmount();
       } else {
          alert('error! Refresh the page again');
       }
    } else {
       alert('Attention! Minimum On Product Select');
    }
 }
 function getTaxData(row = null) {
    var productId = $("#productName" + row).val();
    if (productId) {
       var actualPrice = $("#productName" + row).find("option:selected").attr('a_price');
       var quantity = $("#quantity" + row).val();
       var rate =$("#rate" + row).val();
       var price = Number(rate) * Number(quantity);
       var taxValue = $("#tax" + row).find("option:selected").attr('taxValue');
       var totaltaxvalue = Number(taxValue) / 100;
       var taxAmount = price * totaltaxvalue;
       $("#total" + row).val("");
       var total = Number(price) + Number(taxAmount);
       total = total.toFixed(2);
       $("#total" + row).val(total);


       console.log('row' + row);
       console.log('actualPrice' + actualPrice);
       console.log('quantity' + quantity);
       console.log('actualPrice*quantity->price =' + price);
       console.log('taxValue' + taxValue);
       console.log('totaltaxvalue' + totaltaxvalue);
       console.log('price*totaltaxvalue ->taxAmount' + taxAmount);
       console.log('price*totaltaxvalue ->total' + total);

    } else {
       alert('Attention!,First Select Product');

    }
 }

 function getQtyData(row = null) {
    var productId = $("#productName" + row).val();
    if (productId)  {
       var actualPrice = $("#productName" + row).find("option:selected").attr('a_price');
       var quantity = $("#quantity" + row).val();
       var price = Number(actualPrice) * Number(quantity);
       $("#total" + row).val("");
       var total = Number(quantity) * Number(actualPrice);
       total = total.toFixed();
       $("#total" + row).val(total);

       console.log('row' + row);
       console.log('actualPrice' + actualPrice);
       console.log('quantity' + quantity);
       console.log('actualPrice*quantity->price =' + price);
       console.log('quantity*actualPrice->total =' + total);

    }else {
       alert('no row !! please refresh the page');
    }
 }

 function  getRateData(row = null) {
    var productId = $("#productName" + row).val();
    if(productId) {
       var actualPrice = $("#productName" + row).find("option:selected").attr('a_price');
       var quantity = $("#quantity" + row).val();
       var rate =$("#rate" + row).val();

       $("#total" + row).val("");
       var total = Number(quantity) * Number(rate);
       total = total.toFixed();
       $("#total" + row).val(total);

       console.log('row' + row);
       console.log('actualPrice' + actualPrice);
       console.log('rate' + rate);
    }
 }
