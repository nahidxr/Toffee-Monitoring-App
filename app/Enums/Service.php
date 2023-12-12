<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */

final class Service extends Enum
{
    const Toffee = 0;
    const Binge =  1;
    const Bioscope = 2;

 public static function getDescription($value): string
 {
     if ($value === self::Toffee) {
         return 'Toffee';
     }
     if ($value === self::Binge) {
         return 'Binge';
     }
     if ($value === self::Bioscope) {
        return 'Bioscope';
    }

     return parent::getDescription($value);
 }
}

