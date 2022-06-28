<?php 
namespace App\Enum;

abstract class TransactionTitle {
    const JOURNAL = 'Journal Voucher Create';
    const CONTRA  = 'Contra Voucher Create';
    const CASHRECEIVE  = 'Cash Receive';
    const CASHPAYMENT  = 'Cash Payment';
    const BANKRECEIVE  = 'Bank Receive';
    const BANKPAYMENT  = 'Bank Payment';
}