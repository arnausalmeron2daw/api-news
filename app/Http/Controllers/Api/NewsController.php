<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //GET
    function index(){
        $post=Post::all();
        if($posts){
            return response()->json(['data'=>$posts],200);

        }else{
            return response()->json(['data'=>'No Posts'],404);
        }

    }

    //GET /id
    // GET /id
    public function show(Post $post)
    {
        // Devuelve el post solicitado en formato JSON
        return response()->json($post);
    }

    // POST
    public function store(Request $request)
    {
        // Valida los datos de la solicitud
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Crea un nuevo post con los datos validados
        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);

        // Devuelve el post creado en formato JSON con un código 201 (Created)
        return response()->json($post, 201);
    }

    // PUT /id
    public function update(Request $request, Post $post)
    {
        // Valida los datos de la solicitud
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        // Actualiza el post con los datos validados
        $post->update($validatedData);

        // Devuelve el post actualizado en formato JSON
        return response()->json($post);
    }

    // DELETE /id
    public function destroy(Post $post)
    {
        // Elimina el post
        $post->delete();

        // Devuelve una respuesta sin contenido con un código 204 (No Content)
        return response()->json(null, 204);
    }

}
