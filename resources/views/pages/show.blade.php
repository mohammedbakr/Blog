@extends('layouts.app2')

@section('content')
	
<div id="colorlib-main">
	<section class="ftco-section ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row d-flex">
			<div class="col-xl-8 py-5 px-md-5">
				<div class="row pt-md-4">
					<div class="col-md-12">
						<div class="blog-entry ftco-animate d-md-flex">
							<a href=""><img class="img img-2" src="{!! asset('/uploads/articlepics/'. $article->image) !!}" alt="{{ $article->image }}"></a>
							<div class="text text-2 pl-md-4">
								<h3 class="mb-2"><a href="">{{$article->title}}</a></h3>
								<div class="meta-wrap">
									<p class="meta">
                                        <span><i class="icon-calendar mr-2"></i>{{$article->created_at->format('Y-m-d')}}</span>
                                        @foreach ($article->tags as $tag)
										<span><a href="{{route('pages.tags.show', $tag->id)}}"><i class="icon-folder-o mr-2"></i>{{$tag->tag}}</a></span>
										@endforeach
										<span><i class="icon-user mr-2"></i>{{$article->user->name}}</span>
										<span><i class="icon-comment2 mr-2"></i>{{$article->comments->count()}} Comment</span>
						  			</p>
					  			</div>
								  <p class="mb-4">{{$article->body}}</p>
							</div>
						</div>
						<hr>					
					</div>
					<div class="pt-5 mt-5">
						<h3 class="mb-5 font-weight-bold">{{$article->comments->count()}} Comments</h3>
						<ul class="comment-list">
							@foreach ($article->comments as $comment)	
							<li class="comment">
								<div class="vcard bio">
									<img src="{!! asset('/uploads/articlepics/'. $comment->image) !!}" alt="{{ $comment->image }}" alt="Image placeholder">
								</div>	
								<div class="comment-body">
									<h3>{{$comment->user->name}}</h3>
									<div class="meta">{{$comment->created_at->format('M d, Y  h:ia')}}</div>
									<p>{{$comment->body}}</p>
								</div>
							</li>
							@endforeach
						</ul>
						<div class="comment-form-wrap pt-5">
							<h3 class="mb-5">Leave a Comment</h3>
							@guest
							<div class="alert alert-danger">You must be logged in to comment</div>
							@else			
							<form action="{{route('pages.comments.store', $article->id)}}" method="POST" class="p-3 p-md-5 bg-light">
								@csrf
								<div class="form-group">
									<label for="body">Comment</label>
									<textarea name="body" id="body" cols="40" rows="2" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<input type="submit" value="Add Comment" class="btn py-3 px-4 btn-primary">
								</div>
							</form>
							@endguest
						</div>
					</div>
                </div><!-- END-->
			</div>
		</div>
    </div>
    </section>
</div>
@endsection