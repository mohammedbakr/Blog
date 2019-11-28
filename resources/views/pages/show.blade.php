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
					</div>
                </div><!-- END-->
            </div>
        </div>
    </div>
    </section>
</div>
@endsection