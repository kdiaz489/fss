@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding-top: 2%">
            <div class="card">
            <div class="card-header">Edit Storage Work Status</div>

                <div class="card-body">
                    
                <form action=" /stor/admin/update/{{$storage->id}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    
                        <div class="form-check">
                            <input type="checkbox" name="status_1" value="Complete">
                            <label>Complete</label>
                            <br>
                            <input type="checkbox" name="status_1" value="In Progress">
                            <label>In Progress</label>
                            <br>

                            <input type="checkbox" name="status_1" value="Cancelled">
                            <label>Cancelled</label>
                            <br>
                            
                        
                        </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
