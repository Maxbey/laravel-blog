<?php

namespace App\Http\Controllers;

use App\Services\ArticlesService\ArticlesService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    private $articlesService;

    /**
     * Set the service.
     * Set the middleware.
     * @param ArticlesService $service
     */
    public function __construct(ArticlesService $service)
    {
        $this->articlesService = $service;

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
        $allTags = Tag::lists('name', 'name')->toArray();

        return view('articles.create')->with([
            'article' => $article,
            'allTags' => $allTags
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
        $attributes = $request->all();
        $tags = $request->input('tags');

        $this->articlesService->create($attributes, (array)$tags);

        return redirect('blog/articles')->with([
            'message' => 'Article has been created'
        ]);
    }

    /**
     * Display the article.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $article = Article::published()->findOrFail($id);
        $tags = $article->tags()->lists('name', 'slug');

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
        $allTags = Tag::lists('name', 'name')->toArray();

        return view('articles.edit')->with([
            'article' => $article,
            'allTags' => $allTags
        ]);

    }

    /**
     * Update the article in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $input = $request->all();
        $tags = $request->input('tags');

        $article = $this->articlesService->update($id, $input, (array)$tags);

        return redirect('blog/articles/' . $article->id)->with([
            'message' => 'Article has been updated'
        ]);
    }

    /**
     * Remove the article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Article::destroy($id);
    }
}
