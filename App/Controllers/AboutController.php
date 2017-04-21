<?php

namespace App\Controllers;


use App\Models\Gallery;
use Milhas\Controller\Controller;
use Milhas\Http\Request\Request;

class AboutController extends Controller
{
    public function index()
    {
        return $this->render('layout', ['about' => true]);
    }
}