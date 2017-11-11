<?php

namespace AppBundle\Enum;

/**
 * Class InvoiceIvaTypeEnum.
 *
 * @category Enum
 *
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class InvoiceIvaTypeEnum
{
    const IVA_REDUCED_TYPE_1 = 0;
    const IVA_REDUCED_TYPE_2 = 1;
    const IVA_GENERAL_TYPE = 2;

    /**
     * @return array
     */
    public static function getEnumArray()
    {
        return array(
            self::IVA_REDUCED_TYPE_1 => 4,
            self::IVA_REDUCED_TYPE_2 => 10,
            self::IVA_GENERAL_TYPE => 21,
        );
    }
}
