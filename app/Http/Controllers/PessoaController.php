<?php

namespace App\Http\Controllers;
use App\Pessoa; 

use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index()
    {
        return view('index');
    }
     public function create()
    {
        return view('pessoas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $pessoa = Pessoa::create([
            'nome' => $request->input('nome'),
        ]);

        return response()->json([
            'message' => 'Pessoa cadastrada com sucesso!',
            'pessoa' => $pessoa,
        ]);
    }
    public function show()
    {
        $pessoas = Pessoa::all();
        return response()->json($pessoas);
    }
    
}
