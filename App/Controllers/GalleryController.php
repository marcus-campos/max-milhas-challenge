<?php

namespace App\Controllers;


use App\Models\Gallery;
use Milhas\Controller\Controller;
use Milhas\Http\Request\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = new Gallery();

        $all = $gallery->all();

        return $this->render('layout', ['gallery' => true, 'photos' => $all]);
    }
}