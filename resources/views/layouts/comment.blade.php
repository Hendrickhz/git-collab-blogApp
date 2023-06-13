@auth
<div class="">
    <h4>Write a comment</h4>
    <form action="{{route('comment.store')}}" method="POST">
    @csrf
     <input type="hidden" name="article_id" value="{{$article->id}}">
     <textarea name="content" class=" form-control @error('content') is-invalid @enderror" id="" cols="30" rows="5" placeholder="say something about the article ....."></textarea>
     @error('content')
        <div class=" invalid-feedback">{{ $message }}</div>
    @enderror
     <p class=" text-muted">Commenting as {{Auth::user()->name}}</p>
     <button class=" btn btn-dark">Comment</button>
    </form>
</div>
@else
<div class=" text-center  card p-4">
    <h4 >To leave a comment, you need to login First.</h4>
    <a href="{{route('login')}}" class="my-2 btn btn-primary mx-auto ">Login</a>
</div>
@endauth
<div class="">
    <h4 class=" mt-4">Comments and Replies</h4>
    @forelse ($article->comments()->whereNull("parent_id")->latest("id")->get() as $comment)
    <div class="card mb-4">
        <div class="card-body">
            <div class="  d-flex  align-items-start ">
                <i class="bi bi-chat-left-dots-fill me-3"></i>
                <div class="">
                   <div class=" d-flex justify-content-between">
                    <p class="fw-bold">{{$comment->user->name}} <span class=" ms-3 text-muted">{{$comment->created_at->diffForHumans()}}</span></p>
                    @can('delete',$comment)
                    <form class="" action="{{route('comment.destroy',$comment->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class=" btn btn-sm" type="submit" ><i class=" bi bi-trash3"></i></button>

                    </form>
                    @endcan

                   </div>
                    <span>{{$comment->content}}</span>
                   @auth
                  <div class="">
                    <i class="bi bi-reply-fill reply-btn"></i>
                    <div class=" border p-3  d-none">
                     <p class=" fw-bold text-muted">Replying to {{$comment->user->name}}</p>
                     <form action="{{route('comment.store')}}" method="POST">
                     @csrf
                      <input type="hidden" name="article_id" value="{{$article->id}}">
                      <input type="hidden" name="parent_id" value="{{$comment->id}}">
                      <textarea name="content" class=" form-control @error('content') is-invalid @enderror" id="" cols="30" rows="2" placeholder="Say something ....."></textarea>
                      @error('content')
                         <div class=" invalid-feedback">{{ $message }}</div>
                     @enderror
                      <p class=" text-muted">Replying as {{Auth::user()->name}}</p>
                      <button class=" btn btn-dark btn-sm">Reply</button>
                     </form>
                  </div>
                  </div>
                  @endauth
                  @forelse ($comment->replies()->get() as $reply)
                  <div class=" d-flex ">
                      <p class="fw-bold">{{$reply->user->name}} <span class="  text-muted">{{$reply->created_at->diffForHumans()}}</span></p>
                      @can('delete',$reply)
                      <form class="" action="{{route('comment.destroy',$reply->id)}}" class="d-inline" method="POST">
                          @csrf
                          @method('DELETE')

                          <button class=" btn btn-sm" type="submit" ><i class=" bi bi-trash3"></i></button>

                      </form>

                      @endcan
                    </div>
                    <span>{{$reply->content}}</span>
                      @empty

                      @endforelse

                </div>



            </div>
        </div>
    </div>
   @empty
    <h5 class=" text-muted">There is no comment at the comment.</h5>
    @endforelse
</div>
@vite('resources/js/reply.js')
