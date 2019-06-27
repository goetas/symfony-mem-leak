<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/leak",name="getss")
     * @return Response
     */
    public function leak()
    {
        return new Response('hello');
    }


    public function noleak()
    {
        return new Response('hello');
    }
}
