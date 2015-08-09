<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;

use App\Repositories\ArticlesRepository\ArticlesRepository;

class ArticlesController extends Controller
{
    private $repository;

    /**
     * Set the repository.
     * Set the middleware.
     *
     * @param ArticlesRepository $repository
     */
    public function __construct(ArticlesRepository $repository)
    {
        $this->repository = $repository;

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
        $attributes = $request->all();
        $tags = $request->input('tags');

        $this->repository->create($attributes, $tags);

        return redirect('blog/articles')->with([
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
        $input = $request->all();
        $tags = $request->input('tags');

        $article = $this->repository->update($id, $input, (array)$tags);

        return redirect('blog/articles/' . $article->id);
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Article::destroy($id);
    }
}
