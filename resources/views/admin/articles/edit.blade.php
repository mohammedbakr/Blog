@extends('layouts.master')

@section('title')
    Edit-Article | Blog
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Article</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-group" action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ $article->title }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Body</label>
                                    <input type="text" name="body" value="{{ $article->body }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-form-label">Tag:</label>
                                    <select class="form-control tags" name="tags[]" id="tag" multiple="">
                                      @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->tag }}</option>                        
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" value="{{ $article->image }}" class="custom-file-input">
                                            <label class="custom-file-label">Choose Image</label>
                                        </div>
                                    </div>
                                </div>                                
                                <button type="submit" class="btn btn-success float-left">Update</button>
                            </form>
                            <form class="form-group" action="{{ route('admin.articles.index')}}" method="post">
                                @csrf
                                @method('get')
                                <button type="submit" class="btn btn-danger float-right">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
      $(document).ready(function() {
        $('.tags').select2().val({{ json_encode($article->tags()->get()->pluck('id')) }}).trigger('change');
      });
    </script>

@endsection