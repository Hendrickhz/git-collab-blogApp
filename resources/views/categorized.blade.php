@extends('layouts.master')
@section('content')
@if (request()->has('keyword') )
    <div class=" mb-4 d-flex justify-content-between">
        <h5 class=" mb-0">Search results by keyword '{{request()->keyword}}' in Category {{$category->title}}</h5>
        <a href="{{route('page.index')}}" class=" text-dark">See All</a>
    </div>
@else
<div class=" mb-4 d-flex justify-content-between">
    <h5 class=" mb-0">Categorized by '{{$category->title}}'</h5>
    <a href="{{route('page.index')}}" class=" text-dark">See All</a>
</div>
@endif
@forelse ($articles as $article)
<div class="card mb-4">
    <div class="card-body">
        <h3>
                <a href="{{route('page.show',["slug"=>$article->slug])}}"  class=" text-decoration-none text-black ">
                {{$article->title}}
            </a>
            </h3>
        <div class=" mb-4">
            <span class=" badge bg-dark">{{$article->category?->title}}</span>
            <span class=" badge bg-dark">{{$article->created_at->format("D m Y")}}</span>
            <span class=" badge bg-dark">{{$article->user?->name}}</span>
        </div>
        <div class="mb-4 text-muted">{{$article->excerpt}}</div>
        <a href="{{route('page.show',["slug"=>$article->slug])}}" class=" btn btn-dark">See Details</a>
    </div>
</div>
@empty
 <div class="card">
    <div class="card-body">
        <p>There is no article at the moment</p>
        <a href="{{route('register')}}" class=" btn btn-dark">Try Now</a>
    </div>
 </div>
@endforelse
{{$articles->links()}}
@endsection
