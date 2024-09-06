<?php

namespace App\Http\Controllers;

/*
 * снингл контроллер. тестовий контроллер
 */
class SingleTestController extends Controller
{
    public function __invoke()
    {
        return 'single controller test';
    }
}
