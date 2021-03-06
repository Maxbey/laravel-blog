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

        $this->middleware('auth', ['only' => ['create', 'edit', 'destroy', 'restore']]);
        $this->middleware('admin', ['only' => ['create', 'edit', 'destroy', 'restore']]);
        $this->middleware('ajax', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Display all articles.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return Article::withTrashed()->get();
        }

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

        return redirect('blog')->with([
            'success-message' => 'Article has been created'
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
        $article = Article::withTrashed()->findOrFail($id);
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
        $url = $article->isPublished() ? 'blog/articles/' . $article->id : 'admin/articles_control';

        return redirect($url)->with([
            'success-message' => 'Article has been updated'
        ]);
    }

    /**
     * Remove the article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $article = Article::findOrFail($request['id']);
        $article->delete();

        return response('Article (' . $article->title . ') has been deleted', 202);
    }

    /**
     * Restore article.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request)
    {
        $article = Article::onlyTrashed()->findOrFail($request['id']);
        $article->restore();

        return response('Article (' . $article->title . ') has been restored', 202);
    }
}
