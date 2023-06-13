<div class="">
    <div class=" ">
        <h6>Search Articles</h6>
        <form action="{{ route('page.index') }}" method="get">
        <div class=" input-group ">
            <input type="text" class=" form-control" name="keyword"
                @if (request()->has('keyword')) value="{{ request()->keyword }}" @endif>
            @if (request()->has('keyword'))
                <a href="{{ route('page.index') }}" class="btn btn-danger"><i class=" bi bi-x"></i></a>
            @endif
            <button class=" btn btn-primary"><i class=" bi bi-search"></i></button>
        </div>
    </form></div>
    <div class="my-4 card">
        <div class="card-body">
            <ul class=" list-group ">
                <a href="{{route('page.index')}}" class=" list-group-item list-group-item-action">All Categories</a>
                @foreach (App\Models\Category::all() as $category)
                <a href="{{route('page.categorized',["slug"=>$category->slug])}}" class=" list-group-item list-group-item-action">{{$category->title}}</a>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="my-4 card">
        <div class="card-body">
            <ul class=" list-group ">
                <p>Recent Articles</p>
                @foreach (App\Models\Article::latest("id")->limit(5)->get() as $article)
                <a href="{{route('page.show',["slug"=>$article->slug])}}" class=" list-group-item list-group-item-action">{{$article->title}}</a>
                @endforeach
            </ul>
        </div>
    </div>

</div>
