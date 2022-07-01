<?php 
namespace App\Enum;

abstract class TransactionList {
    const JOURNAL = 1;
    const CONTRA  = 2;
    const CASHRECEIVE  = 3;
    const BANKRECEIVE  = 4;
    const CASHPAYMENT  = 5;
    const BANKPAYMENT  = 6;
}