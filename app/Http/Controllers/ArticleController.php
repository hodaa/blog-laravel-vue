<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace  App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Criteria\Published;
use App\Repositories\Criteria\SearchByTitle;
use Illuminate\Http\Request;

class ArticleController
{
    private $articleRepository;
    private $commentRepository;

    /**
     * ArticleController constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->articleRepository->pushCriteria(new Published());
        if ($request->input('q')) {
            $searchQuery = $request->input('q');
            $this->articleRepository->pushCriteria(new SearchByTitle($searchQuery));
        }
        $articles = $this->articleRepository->paginate(10);

        return view('front.articles.index', ['articles' => $articles]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $article = $this->articleRepository->find($id);
        $article = new ArticleResource($article);

        return view('front.articles.show', ['article' => $article]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Laravel\Lumen\Http\Redirector
     */
    public function comment(Request $request)
    {
        $data = $request->all();
        $this->commentRepository->create($data);
        $article_id=$request->article_id;
        return redirect('/articles/'.$article_id);
    }
}
