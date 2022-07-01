<?php 
namespace App\Enum;

abstract class TransactionTitle {
    const JOURNAL = 'Journal Voucher';
    const CONTRA  = 'Contra Voucher';
    const CASHRECEIVE  = 'Cash Receive';
    const CASHPAYMENT  = 'Cash Payment';
    const BANKRECEIVE  = 'Bank Receive';
    const BANKPAYMENT  = 'Bank Payment';
}