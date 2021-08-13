$(document).ready(function () {
    sumItem($('.sum-qty'), $('#qtyTotal'));
    sumTotal($('.sum-subtotal'), $('#subTotal'));
    commisionCalc();
    grandTotal();
});

$('#bAddItem').on('click', function() {

    if (!$('#fAddItem')[0].checkValidity()){
        $('#fAddItem')[0].reportValidity();
    }else{
        $lRID = parseInt($('#orderSubTotal').prev('tr').find('.item-id').text());

        if (isNaN($lRID)){
            $nRID = 1;
        }else{
            $nRID = $lRID + 1;
        }

        $addDesc = $('#inputDescription').val();
        $addLink = $('#inputLink').val();
        
        if ($addLink == '') {
            $addClass = 'class="item-link no-link"';
        }else{
            $addClass = 'class="item-link"';
        }

        $addQty = $('#inputQuantity').val();
        $addPrice = $('#inputPrice').val();

        $intQty = parseInt($addQty);
        $flPrice = $addPrice.replace(/[$,]/g, "");
        $flPrice = parseFloat($flPrice);

        $qPNumber = $intQty * $flPrice

        $qXPrice = '$' + $qPNumber.toLocaleString( "en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        $('<tr class="list-item"><td class="align-middle item-id" scope="row">'+$nRID+'</td><td class="align-middle"><img class="item-image" src="" alt=""></td><td class="align-middle item-desc">'+$addDesc+'</td><td class="align-middle"><a href="'+$addLink+'" target="_blank" '+$addClass+'><i class="fas fa-external-link-alt fa-sm text-white-400"></i></a></td><td class="align-middle sum-qty item-qty">'+$addQty+'</td><td class="align-middle text-right item-price">$'+$addPrice+'</td><td class="align-middle text-right sum-subtotal item-qxp">'+$qXPrice+'</td><td class="align-middle text-center"><a class="cm-a-mrg edt-int-tel" href="" data-toggle="modal" data-target="#editItemModal" onclick="edtItm(this)"><i class="fas fa-user-edit"></i></a><a class="cm-a-mrg" href="" data-toggle="modal" data-target="#itemDeleteModal" onclick="dltItm(this)"><i class="fas fa-user-times"></i></a></td></tr>').insertBefore($('#orderSubTotal'));
        
        var preview = document.querySelectorAll('.item-image')[document.querySelectorAll('.item-image').length -1];
        var file    = document.getElementById('inputImage').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.width = 100;
            preview.height = 100;
          }
        
          if (file) {
            reader.readAsDataURL(file);
          } else {
            preview.src = "img/karitelocompra_menu_logo.png";
        }

        sumItem($('.sum-qty'), $('#qtyTotal'));
        sumTotal($('.sum-subtotal'), $('#subTotal'));
        commisionCalc();
        grandTotal();

        $('#addItemModal').modal('toggle');

        $('#fAddItem').trigger('reset');

    }


});

function edtItm($element) { //Click on the button, instead using classname we used the DOM element, otherwise will not get the click event
    
    $row = $($element).closest('tr');// Find the row, since $element is a DOM element and not a jQuery object we need to wrap it on $() to convert it to a jQuery object
    $imgSrc = $row.find('.item-image').attr('src'); // Find the img src text
    $desc = $row.find('.item-desc').text(); // Find the description text
    $link = $row.find('.item-link').attr('href'); // Find the link href text
    $qty = $row.find('.item-qty').text(); // Find the quantity text
    $prc = $row.find('.item-price').text(); // Find the quantity x price result text


    return{ //set all info on each form field
        first: $('#imgEditImage').attr({src: $imgSrc, width: '100', height: '100'}), //setting value of the input through its html id
        second: $('#inputEditDescription').val($desc), //setting value of the input through its html id
        third: $('#inputEditLink').val($link), //setting value of the input through its html id
        fourth: $('#inputEditQuantity').val($qty), //setting value of the input through its html id
        fifth: $('#inputEditPrice').val($prc.replace(/[$]/g, "")), //setting value of the input through its html id
    };

}

function edtImg() {
    $('#inputEditImage').click();
}

$('#inputEditImage').change(function() {

    var preview = document.querySelector('#imgEditImage');
    var file    = document.getElementById('inputEditImage').files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.width = 100;
        preview.height = 100;
      }
    
      if (file) {
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
    }

});

$('#bEditItem').on('click', function() {

    if (!$('#fEditItem')[0].checkValidity()){
        $('#fEditItem')[0].reportValidity();
    }else{

        $imgEdtSrc = $('#imgEditImage').attr('src'); // Find the img src text
        $edtDesc = $('#inputEditDescription').val(); // Find the description value
        $edtLink = $('#inputEditLink').val();

        if ($edtLink == '') {
            $row.find('.item-link').addClass('no-link');
        }else{
            $row.find('.item-link').removeClass('no-link');
        }

        $edtQty = $('#inputEditQuantity').val();
        $edtPrc = $('#inputEditPrice').val();  
        
        $intQty = parseInt($edtQty);
        $flPrice = $edtPrc.replace(/[$,]/g, "");
        $flPrice = parseFloat($flPrice);

        $qPNumber = $intQty * $flPrice

        $qXPrice = '$' + $qPNumber.toLocaleString( "en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        $row.find('.item-image').attr({src: $imgEdtSrc, width: '100', height: '100'}), //setting value of the input through its html id
        $row.find('.item-desc').text($edtDesc), //setting value of the input through its html id
        $row.find('.item-link').attr('href', $edtLink), //setting value of the input through its html id
        $row.find('.item-qty').text($edtQty), //setting value of the input through its html id
        $row.find('.item-price').text('$'+$edtPrc), //setting value of the input through its html id
        $row.find('.item-qxp').text($qXPrice), //setting value of the input through its html id

        sumItem($('.sum-qty'), $('#qtyTotal'));
        sumTotal($('.sum-subtotal'), $('#subTotal'));
        commisionCalc();
        grandTotal();

        $('#editItemModal').modal('toggle');

        $('#fEditItem').trigger('reset');

    }

});

function dltItm($element) { //Click on the button, instead using classname we used the DOM element, otherwise will not get the click event
    
    $row = $($element).closest('tr');// Find the row, since $element is a DOM element and not a jQuery object we need to wrap it on $() to convert it to a jQuery object
    $rowId = $row.find('.item-id').text(); // Find the img src text

    $('#deleteModalDiv').html("¿Estás seguro que quieres eliminar el item <b>#" + $rowId +"</b>?") //setting the html content within the invoked div

}

$('#bDltItem').on('click', function() {

    $row.remove();

    sumItem($('.sum-qty'), $('#qtyTotal'));
    sumTotal($('.sum-subtotal'), $('#subTotal'));
    commisionCalc();
    grandTotal();

    $('#itemDeleteModal').modal('toggle');

});

function sumItem($class, $itemTotal) {
    $numTotal = 0;
    
    $class.each(function() {
        $strText = $(this).text();
        
        $number = parseInt($strText);
        $numTotal += $number;
        
    });

    $itemTotal.text($numTotal);
}

function sumTotal($class, $subTotal) {
    $numTotal = 0;
    
    $class.each(function() {
        $strText = $(this).text();

        if($strText.indexOf('$') == 0) {
            $strText = $strText.replace(/[$,]/g, "");
            $number = parseFloat($strText);
            $numTotal += $number;
        }else{
            $number = parseInt($strText);
            $numTotal += $number;
        }
    });

    $strTotal = '$' + $numTotal.toLocaleString( "en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    $subTotal.text($strTotal);
}

function commisionCalc() {
    $subTotal = $('#subTotal').text();

    $subTotal = $subTotal.replace(/[$,]/g, "");
    $number = parseFloat($subTotal);

    $number = (10 / 100) * $number;

    $comm = '$' + $number.toLocaleString( "en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    $('#commPerc').text($comm);

}

function grandTotal() {
    $subTotal = $subTotal.replace(/[$,]/g, "");
    $subTotal = parseFloat($subTotal);
    
    $comm = $comm.replace(/[$,]/g, "");
    $comm = parseFloat($comm);

    $number = $subTotal + $comm;

    $gTotal = '$' + $number.toLocaleString( "en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    $('#gTotal').text($gTotal);
}

$('#bPlcLst').on('click', function() {
    $('.list-item').each(function(i, el) {
        
        var itDesc = $(el).children('.item-desc').text();
        var itPrice = $(el).children('.item-price').text();

        alert(JSON.stringify({description: tDesc, price: tPrice}));
        //$.ajax (do your AJAX call here using values of query and text
    });
});