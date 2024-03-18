<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Dotenv\Validator;

class BookController extends Controller
{
    /**
     * Afficher une liste paginée de livres.
     *
     * @return \Illuminate\Http\Response
     */
    public function toutvoir()
    {
        $books = Book::paginate(10);
        return response()->json($books);
    }

    /**
     * Enregistrer un nouveau livre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'author' => 'required|string',
            'publication_year' => 'required|integer',
            'isbn' => 'required|string|unique:books,isbn',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    /**
     * Afficher les détails d'un livre spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voirlivre($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Livre non trouvé'], 404);
        }

        return response()->json($book);
    }

    /**
     * Mettre à jour les détails d'un livre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modifier(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Livre non trouvé'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'author' => 'string',
            'publication_year' => 'integer',
            'isbn' => 'string|unique:books,isbn,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $book->update($request->all());

        return response()->json($book, 200);
    }

    /**
     * Supprimer un livre.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function supression($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Livre non trouvé'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Livre supprimé avec succès']);
    }
}
