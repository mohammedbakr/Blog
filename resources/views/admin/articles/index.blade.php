@extends('layouts.master')

@section('title')
    Article-List | Blog
@endsection

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Articles Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="user_id" display="none" name="user_id">
            <div class="modal-body">
                <div class="form-group">
                  <label for="title" class="col-form-label">Title:</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                  <label for="body" class="col-form-label">Body:</label>
                  <textarea rows="10" cols="50" class="form-control" id="body" name="body"></textarea>
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
                  <label for="image" class="col-form-label">Image:</label>
                  <div class="input-group">
                      <div class="custom-file">
                          <input type="file" name="image" class="custom-file-input">
                          <label class="custom-file-label">Choose Image</label>
                      </div>
                  </div>
              </div>                
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Add</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h3 class="float-left"> Articles List</h3>
            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal">Add Article</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
                <thead class="text-info">
              {{-- <thead class="text-secondary"> --}}
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Body</th>
                <th>Published_At</th>
                <th>Edit</th>
                <th>Delete</th>

              </thead>
              <tbody>
                @foreach ($articles as $article)
                    
                <tr>
                  <td>{{$article->id}}</td>
                  <td><img src="{!! asset('/uploads/articlepics/'. $article->image) !!}" alt="{{ $article->image }}"  width="100px;" height="100px;"></td>
                  <td>{{$article->title}}</td>
                  <td>{{str_limit(strip_tags($article->body), 200)}}</td>
                  <td>{{$article->created_at->format('Y-m-d')}}</td>
                  <td>
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-success btn-sm">EDIT</a>
                  </td>
                  <td>
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$articles->links()}}
          </div>
        </div>
      </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
      $(document).ready(function() {
        $('.tags').select2();
      });
    </script>

@endsection