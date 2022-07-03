    function myFunction(id_arr,type) {
        id = id_arr.split("_");
        x = $(type + id[1]).val();
        // If x is Not a Number or less than one
        if (isNaN(x) || x < 1) {
            text = "Input not valid";
            //  alert(text);
            $(type + id[1]).val('');
        }
    }

    // this funciton is for summation of Debit amount
  $(document).on('change keyup blur', '.changesDebit', function () {
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    console.log( id[1]);
    myFunction(id_arr,'#debit_');
    debit = $('#debit_' + id[1]).val();
    credit = $('#credit_' + id[1]).val();
    if(credit != '' && parseFloat(credit) > 0){
      $('#debit_' + id[1]).val('');
    }
    totalAmount();
  });

   // this funciton is for summation of Credit amount
   $(document).on('change keyup blur', '.changesCredit', function () {

    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    myFunction(id_arr,'#credit_');
    debit = $('#debit_' + id[1]).val();
    credit = $('#credit_' + id[1]).val();
    if(debit != '' && parseFloat(debit) > 0){
      $('#credit_' + id[1]).val('');
    }
    totalAmount();

  });

  function totalAmount()
  {
      // for Debit Amount
      var total_debitamount = 0;
      $('.changesDebit').each(function(){
          if(parseFloat($(this).val())>0)
              total_debitamount += parseFloat($(this).val());
      })

      $('#total_debit').text(total_debitamount.toFixed(2));
      $('#total_debit_in').val(total_debitamount.toFixed(2));

      // for Credit Amount
      var total_creditamount = 0;
      $('.changesCredit').each(function(){
          if(parseFloat($(this).val())>0)
              total_creditamount += parseFloat($(this).val());
      })
      $('#total_credit').text(total_creditamount.toFixed(2));
      $('#total_credit_in').val(total_creditamount.toFixed(2));

  }

  function removeRow (el) {
    $(el).parents("tr").remove()
    totalAmount()
  }