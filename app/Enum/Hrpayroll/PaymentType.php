<?php 
namespace App\Enum\Hrpayroll;
use App\Enum\Enumeration;

abstract class PaymentType extends Enumeration {
    const CASH = 'Cash';
    const BANK  = 'Bank';
}