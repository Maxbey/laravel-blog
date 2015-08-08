<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    /**
     * Create a new articles controller instance
     * Set the middleware.
     * Only admin can write and edit articles.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'edit']]);
        $this->middleware('admin', ['only' => ['create', 'edit']]);
    }

    /**
     * Display all articles.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::latest('published_at')->published()->get();

        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new article.
     *
     * @return Response
     */
    public function create()
    {
        $article = new Article();
        $allTags = Tag::lists('name', 'id');

        return view('articles.create')->with([
            'article' => $article,
            'allTags' => $allTags->toArray()
        ]);
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $this->createArticle($request);

        return redirect('blog')->with([
            'message' => 'Post has been created'
        ]);
    }

    /**
     * Display the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $article = Article::published()->findOrFail($id);
        $tags = $article->tags()->lists('name');

        return view('articles.show')->with([
            'article' => $article,
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for editing article.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $allTags = Tag::lists('name', 'id');

        return view('articles.edit')->with([
            'article' => $article,
            'allTags' => $allTags->toArray()
        ]);

    }

    /**
     * Update the specified article in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        $tagIds = $request->input('tags');

        if(is_null($tagIds))
        {
            $tagIds = [];
        }

        $this->syncTags($article, $tagIds);

        return redirect('blog' . $article->id);
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Sync up the list of tags in the database
     *
     * @param Article $article
     * @param array $tags
     */
    private function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);

    }

    /**
     * Save a new article.
     * @param ArticleRequest $request
     * @return Article
     */
    private function createArticle(ArticleRequest $request)
    {
        $article = \Auth::user()->articles()->create($request->all());
        $tagIds = $request->input('tags');
       // $this->checkTags($tagIds);

        $this->syncTags($article, $tagIds);

        return $article;
    }

    /**
     * Check request tags.
     * If given tag doesn`t contained in database, create it.
     * @param $sentTags
     */
    /*private function checkTags($sentTags)
    {
        $availableTags = Tag::lists('id');
        foreach($sentTags as $tag)
        {
            if(!$availableTags->contains((int) $tag))
            {
                Tag::create('name' => $sentTags);
            }
        }
    }*/
}
