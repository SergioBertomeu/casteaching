<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('videos.manage.index');
    }

    /**
     * Formulari de creació de vídeos
     */
    public function create()
    {
        //
    }

    /**
     * Guardara a la base de dades el vídeo creat
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * No llegirà el vídeo Individual però si el formulari per editar-lo
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Procesarà el formulari d'edició del vídeo i el guardarà a la base de dades
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Esborrarà el vídeo de la base de dades
     */
    public function destroy(string $id)
    {
        //
    }
}
