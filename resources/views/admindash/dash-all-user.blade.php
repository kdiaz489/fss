@extends('layouts.admindashlte')

@section('user-name')
 {{auth()->user()->name}}   
@endsection

@section('content')


<div class="container-fluid dashboard-container">

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


    <div class="row justify-content-center">
        <div class="col-md-12 ">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">
                        <div class="container dashboard-container">
                            <h3 class="font-weight-light mb-3">Manage Users</h3>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Access</th>
                                        <th scope="col"> Account Balance</th>
                                        <th scope="col">Credit</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{implode(', ', $user->roles()->pluck('name')->toArray())}}</td>
                                                                                <td>
                                            <form action="/user/accbal/update/{{$user->id}}" method="POST">
                                                @csrf
                                                {{method_field('PUT')}}
                                                <input type="text" name="accbal" class="text-center form-control form-control-sm" style="width:40%" value="{{number_format($user->account_balance,2)}}">
                                                <button type="submit" style=" margin-left: 1.25rem;"
                                                    class="btn btn-link text-success btn-sm m-0"><small>Update</small></button>
                                            </form>
                                        </td>
                                        
                                        <td>
                                            <form action=" /user/credit/update/{{$user->id}}" method="POST">
                                                @csrf
                                                {{method_field('PUT')}}
                                                <select name="credit_status">
                                                    <option value="" selected disabled>{{$user->credit}}</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Not Approved">Not Approved</option>
                                                </select>
                                                <button type="submit" style=" margin-left: 1.25rem;"
                                                    class="btn btn-link text-success btn-sm m-0"><small>Update</small></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                                <button class="btn btn-link text-primary btn-sm" type="button">Edit
                                                    Access</button>
                                            </a>
                                            <form action="{{route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="float-left">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit"
                                                    class="btn btn-link text-danger btn-sm">Delete</button>
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
                        </div>
            </div>
        </div>
    </div>

    @endsection