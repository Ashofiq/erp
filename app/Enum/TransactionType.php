<?php 
namespace App\Enum;

abstract class TransactionType {
    const JOURNAL = 'JV';
    const CONTRA  = 'CON';
    const CASHRECEIVE  = 'CR';
    const CASHPAYMENT  = 'CP';
    const BANKRECEIVE  = 'BR';
    const BANKPAYMENT  = 'BP';
}