@extends('layouts.app2')

@section('content')
	
<div id="colorlib-main">
	<section class="ftco-section ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row d-flex">
			<div class="col-xl-8 py-5 px-md-5">
                <h2>Articles Tagged {{ $tag->tag }}</h2>
				<div class="row pt-md-4">
					@foreach ($tag->articles as $article)
					<div class="col-md-12">
						<div class="blog-entry ftco-animate d-md-flex">
							<a href="{{route('pages.index.show', $article->id)}}"><img class="img img-2" src="{!! asset('/uploads/articlepics/'. $article->image) !!}" alt="{{ $article->image }}"></a>
							<div class="text text-2 pl-md-4">
								<h3 class="mb-2"><a href="{{route('pages.index.show', $article->id)}}">{{$article->title}}</a></h3>
								<div class="meta-wrap">
									<p class="meta">
										<span><i class="icon-calendar mr-2"></i>{{$article->created_at->format('Y-m-d')}}</span>
										<span><i class="icon-user mr-2"></i>{{$article->user->name}}</span>
										<span><i class="icon-comment2 mr-2"></i>{{$article->comments->count()}} Comment</span>
						  			</p>
					  			</div>
					  			<p class="mb-4">{{$article->body}}</p>
					  			<p><a href="{{route('pages.index.show', $article->id)}}" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a></p>
							</div>
						</div>
					</div>
					@endforeach
                </div><!-- END-->
            </div>
        </div>
    </div>
    </section>
</div>
@endsection