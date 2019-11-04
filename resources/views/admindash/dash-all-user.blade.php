@extends('layouts.app')

@section('content')


<div class="container-fluid bg-whitewash ">
    <div class="container dashboard-container pt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Shipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard/admin/users">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/admin/inventory">Inventory Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/admin/account">Account</a>
            </li>
        </ul>
    </div>

</div>


<div class="container-fluid dashboard-container">
    <div class="jumbotron bg-whitewash mt-5">
        <h1 class="display-4 text-break text-center">Admin Dashboard.</h1>
    </div>

    <!-- Flash Alerts Begin -->

    @include('partials.alerts')

    <!-- Flash Alerts Ends -->

</div>
<div class="container-fluid dashboard-container">


    <div class="row justify-content-center">
        <div class="col-md-12 " style="padding-top: 2%">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-lg-12 col-12">


                <!-- Tab panes -->
                <div class="tab-content">
                        <div class="container dashboard-container">
                            <h1 class="display-4">Manage Users</h1>
                            <br>
                            <p>*Feature under development</p>
                            <button type="button" class="adduser btn btn-outline-secondary" data-toggle="modal"
                                data-target="#editAdminModal" disabled>Add User</button>
                            <br>
                            <br>
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
                                                <input type="text" name="accbal" class="text-center" style="width:40%" value="{{$user->account_balance}}">
                                                <button type="submit" style=" margin-left: 1.25rem;"
                                                    class="btn btn-link text-success btn-sm">Update</button>
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
                                                    class="btn btn-link text-success btn-sm">Update</button>
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
    </div>

    @endsection