@extends('layouts.master')
@section('content')

<div class=" ">
    <h3>
        {{$article->title}}
    </h3>
    <div class=" mb-4">
    <span class=" badge bg-dark">{{$article->category?->title}}</span>
    <span class=" badge bg-dark">{{$article->created_at->format("D m Y")}}</span>
    <span class=" badge bg-dark">{{$article->user?->name}}</span>
    </div>
    <div class="mb-4 text-muted"  style="min-height: 500px">{{$article->description}}</div>
    <div class="">
        @include('layouts.comment')
    </div>
</div>
@endsection
