<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLivro;

class LivroUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserLivro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 		$request->validate([
            'user_id' => 'required',
            'livro_id' => 'required'
        ]);

        return UserLivro::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		return UserLivro::where('livro_id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($livro_id)
    {
        $user_livro =  UserLivro::where('livro_id', $livro_id)->where('reservado', false)->first();

		if (!$user_livro) {
			return response([
				"message" => "Nenhum livro disponível encontrado!"
			], 404);
		}

		$user_livro->reservado = true;
		$user_livro->save();

		return $user_livro;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
		$fields = $request->validate([
            'user_id' => 'required',
            'livro_id' => 'required'
        ]);
		$user_livro =  UserLivro::where('livro_id', $fields['livro_id'])->where('livro_id', $fields['livro_id'])->first();

		if (!$user_livro) {
			return response([
				"message" => "Relação User - Livro não encontrada"
			], 404);
		}

		return UserLivro::destroy($user_livro->id);
    }
}
