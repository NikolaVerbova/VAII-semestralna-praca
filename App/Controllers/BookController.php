<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Katalóg kníh – zobrazí pohľad App/Views/Book/index.view.php
 */
class BookController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->html();
    }
}
