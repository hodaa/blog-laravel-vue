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

use App\Repositories\Criteria\SearchByTitle;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Repositories\Criteria\Published;

class ArticleController
{
    private $articleRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        $articles= $this->articleRepository->getByCriteria(new Published())->all();
        $this->articleRepository->pushCriteria(new Published());
        if($request->input('q')){
            $searchQuery=$request->input('q');
            $this->articleRepository->pushCriteria(new SearchByTitle($searchQuery));
        }
        $articles = $this->articleRepository->all();

        return view('front.articles.index', ['articles' => $articles]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function show($id){
        $article=$this->articleRepository->findBy('id',$id);
        return view('front.articles.show', ['article' => $article]);
    }
}
