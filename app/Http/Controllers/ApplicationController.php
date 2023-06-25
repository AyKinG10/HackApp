<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(Request $request){
        $allApp = Application::all();
        return view('application.index',['books'=>$allApp, 'categories' => Category::all()]);
    }

    public function create(){
        return view('application.create',['categories'=>Category::all()]);
    }

    public function store(Request $req){
        $validated = $req->validate([
           'title'=>'required|max:255',
            'desc'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required|numeric|exists: category,id'
        ]);
        Auth::user()->application()->create($validated);
        return redirect(route('application.index'));
    }
}
