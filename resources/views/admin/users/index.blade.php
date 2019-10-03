@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-3 my-5">Manage Users</h1>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{implode(', ', $user->roles()->pluck('name')->toArray())}}</td>
                                <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                    <button class="btn btn-primary btn-sm" type="button">Edit Access</button>
                                </a>
                            <form action="{{route('admin.users.destroy', $user->id) }}" method="POST" class="float-left">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <!---
                            <a href="{{ route('admin.impersonate', $user->id) }}" class="float-left">
                                <button class="btn btn-success btn-sm" type="button">Impersonate User</button>
                            </a>
                            --->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
