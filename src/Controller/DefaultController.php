<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function test()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>The response from AUTH SERVICE
            <p>Lucky number: '.$number.'</p></body></html>'
        );
    }
}