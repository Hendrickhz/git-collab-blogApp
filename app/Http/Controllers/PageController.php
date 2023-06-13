<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

use Illuminate\Contracts\Database\Eloquent\Builder;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $articles = Article::when(request()->has("keyword"), function ($query) {

            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;
                $builder->where("title", "like", "%" . $keyword . "%");
                $builder->orWhere("description", "like", "%" . $keyword . "%");
            });
        })
            ->when(request()->has('category'),function($query){
                $query->where("category_id",request()->category);
            })
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy("title", $sortType);
            })
   
            ->latest("id")
            ->paginate(10)->withQueryString();

        return view("welcome", compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where("slug", $slug)->firstOrFail();

        return view('article-detail', compact('article'));
    }

    public function categorized($slug)
    {
        $category = Category::where("slug", $slug)->firstOrFail();
        $articles = Article::where("category_id", $category->id)->when(request()->has("keyword"), function ($query) {
            $keyword = request()->keyword;
            $query->where("title", "like", "%" . $keyword . "%");
            $query->orWhere("description", "like", "%" . $keyword . "%");
        })
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy("title", $sortType);
            })->

            latest("id")->paginate(7)->withQueryString();
        return view('categorized', compact('articles', 'category'));

    }
}
