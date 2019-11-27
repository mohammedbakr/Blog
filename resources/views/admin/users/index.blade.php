@extends('layouts.master')

@section('title')
    Users-List | Blog
@endsection

@section('content')
<div class="user">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3>Registered Users</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-lg">
                  <thead class="text-info">
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Roles</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
              
                      <tr>
                          <td>{{ $user->id }}</td>
                          <td><img src="{!! asset('/uploads/profilepics/'. $user->image) !!}" alt="{{ $user->image  }}"  height="50px;" class="img-circle"></td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray() ) }}</td>
                          <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm">EDIT</a>
                          </td>
                          <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                            </form>
                          </td>
                      </tr>

                    @endforeach
                  </tbody>
                </table>
                {{$users->links()}}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection