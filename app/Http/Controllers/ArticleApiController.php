<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::with(['tag'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageBase64 = $request->input('image');
        $extension = explode('/', explode(':', substr($imageBase64, 0, strpos($imageBase64, ';')))[1])[1];
        $imageEncode = substr($imageBase64, 0, strpos($imageBase64, ',') + 1); 
        $image = str_replace($imageEncode, '', $imageBase64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = Str::random(10) . '.' . $extension;

        Storage::disk('public')->put($imageName, base64_decode($image));

        $article = Article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imageName,
            'tag' => (array)$request->input('tag')
        ]);
        $article->tag()->sync((array)$request->input('tag'));

        return $article;
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function show($article)
    {
        return Article::with(['tag'])
            ->where('id', $article)
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function getArticleByTag($id)
    {
        return Article::with(['tag'])
            ->whereHas('tag', function ($query) use($id) {
                $query->where('tag_id', $id);
            })
            ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        $article->tag()->sync((array)$request->input('tag'));

        return [
            'success' => (boolean)$article
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        return [
            'success' => $article->delete()
        ];
    }
}
