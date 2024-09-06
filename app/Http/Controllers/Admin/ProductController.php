<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        dump(route('admin.products.index'));
        return 'admin products list';
    }

    public function create()
    {
        return 'admin product create';
    }
    public function store() // post
    {
        return 'admin product store';
    }

    public function show($product) //get
    {
        return 'admin product show: '.$product;
    }

    public function edit($product) //get
    {
        return 'admin product edit: '.$product;
    }

    public function update($product) //put/patch
    {
        return 'admin product update: '.$product;
    }

    public function destroy($product)//delete
    {
        return 'admin product delete: '.$product;
    }
}
