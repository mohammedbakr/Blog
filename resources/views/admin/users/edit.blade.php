@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-group" action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" value="{{ $user->image }}" class="custom-file-input">
                                            <label class="custom-file-label">Choose Image</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Roles</label>

                                        @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="checkbox" name="roles[]" value="{{$role->id}}" {{$user->hasAnyRole($role->name) ? 'checked' : ''}}>
                                        <label>{{$role->name}}</label>
                                    </div>
                                        @endforeach

                                </div>
                                
                                <button type="submit" class="btn btn-success float-left">Update</button>
                            </form>
                            <form class="form-group" action="{{ route('admin.users.index')}}" method="post">
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