<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Location extends Enum
{
    const BLDC =   0;
    const NDDC =   1;

 public static function getDescription($value): string
 {
     if ($value === self::BLDC) {
         return 'BLDC';
     }
     if ($value === self::NDDC) {
         return 'NDDC';
     }

     return parent::getDescription($value);
 }
}
