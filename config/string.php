<?php

//Stocks
if(!defined("IN_STOCK"))
    define("IN_STOCK", "現貨");

if(!defined("FRAME"))
    define("FRAME", "FRAME");

if(!defined("NORMAL"))
    define("NORMAL", "NORMAL");

if(!defined("PRE_ORDER"))
    define("PRE_ORDER", "預購");

if(!defined("PENDING"))
    define("PENDING", "Pending");

//Order status
if(!defined("PROCESSING"))
    define("PROCESSING", "0");

if(!defined("COMPLETED"))
    define("COMPLETED", "1");

if(!defined("CANCELED"))
    define("CANCELED", "2");


if(!defined("ATTRIBUTES"))
    define("ATTRIBUTES", [
        "thickness" => "Thickness",
        "total_length" => "Length",
        "color" => "Color"
    ]);
if(!defined("NEWSLETTER_NONE"))
    define("NEWSLETTER_NONE", "0");

if(!defined("NEWSLETTER_NORMAL"))
    define("NEWSLETTER_NORMAL", "1");

if(!defined("NEWSLETTER_PRODUCT"))
    define("NEWSLETTER_PRODUCT", "2");

if(!defined("NEWSLETTER_ALL"))
    define("NEWSLETTER_ALL", "3");

//Delivering
if(!defined("WAITING"))
    define("WAITING", "0");

if(!defined("DELIVERING"))
    define("DELIVERING", "1");

if(!defined("DELIVERED"))
    define("DELIVERED", "2");

//Payment status
if(!defined("UNPAID"))
    define("UNPAID", "0");

if(!defined("PAID"))
    define("PAID", "1");

if(!defined("REFUNDING"))
    define("REFUNDING", "2");

if(!defined("REFUNDED"))
    define("REFUNDED", "3");
