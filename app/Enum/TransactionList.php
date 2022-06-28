<?php 
namespace App\Enum;

abstract class TransactionList {
    const JOURNAL = 1;
    const CONTRA  = 2;
    const CASHRECEIVE  = 3;
    const CASHPAYMENT  = 4;
    const BANKRECEIVE  = 5;
    const BANKPAYMENT  = 6;
}