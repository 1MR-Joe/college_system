<?php
declare(strict_types=1);

namespace App\Enums;

enum Semester: string
{
    case Fall = 'fall';
    case Winter = 'winter';
    case Spring = 'spring';
    case Summer = 'summer';
}