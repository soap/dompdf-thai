<?php

namespace Soap\DompdfThai;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soap\DompdfThai\Skeleton\SkeletonClass
 */
class DompdfThaiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dompdf-thai';
    }
}
