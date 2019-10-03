@extends('layouts.app')

@section('content')
    <div class="container py-5">
    <h1 class="display-3 mb-5">All Shipments</h1>
    
    @if(count($shipments) > 0)
    <table class="table">
        <tr>
            <th>Shipment Destination</th>
            <th>Submitted On</th>
            <th></th>
        </tr>
        @foreach($shipments as $shipment)
        <tr>
            <td>{{$shipment->dest_company}}</td>
            <td>{{$shipment->created_at}}</td>
            <td>
                <div style="margin-left: 50%">
                    <a href="/ship/{{$shipment->id}}" class="float-left" style="margin-right:1%">
                            <button class="btn btn-outline-secondary btn-sm" type="button">View</button>
                        </a>
                    <form action="{{route('admin.users.destroy', $shipment->id) }}" method="POST" class="float-left">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn bg-denim text-white btn-sm">Cancel</button>
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