@extends('layouts.admindashlte')

@section('user-name')
{{auth()->user()->name}}
@endsection

@section('content')
<div class="container">
    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-top: 2%">
            <div class="card">
            <div class="card-header">Manage {{$user->name}} roles</div>

                <div class="card-body">
                <form action="{{route('admin.users.update',['user'=>$user->id])}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    @foreach($roles as $role)
                        <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{$role->id}}"
                            {{$user->hasAnyRole($role->name)?'checked':''}}>
                        <label>{{$role->name}}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
