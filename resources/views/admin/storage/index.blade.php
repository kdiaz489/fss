@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="display-3 mb-5">All Storage Requests</h1>
        @if(count($storage) > 0)
        <table class="table">
            <tr>
                <th>SKU</th>
                <th>Submitted On</th>
                
                <th></th>
            </tr>
            @foreach($storage as $item)
            <tr>
                <td>{{$item->sku}}</td>
                <td>{{$item->created_at}}</td>
                

                <td>
                        <div style="margin-left: 50%">
                                <a href="/stor/{{$item->id}}" class="float-left" style="margin-right:1%">
                                        <button class="btn btn-outline-secondary btn-sm" type="button">View</button>
                                    </a>
                                <form action="/stor/{{$item->id}}" method="POST" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn bg-frenchblue text-white btn-sm">Cancel</button>
                                </form>
                            </div>
                </td>


                </tr>
            @endforeach
        </table>
        @else
            <p>You have no posts.</p>
        @endif

    </div>
@endsection()