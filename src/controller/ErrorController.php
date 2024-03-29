<?php
namespace App\src\controller;
class ErrorController
{
    public function errorNotFound()
    {
        require '../templates/error404.php';
    }
    public function errorServer()
    {
        require '../templates/error500.php';
    }
}
