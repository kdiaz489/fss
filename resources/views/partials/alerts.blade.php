@if(session('success'))
        <div class="alert alert-warning text-center" role="alert">
            {{session('success')}}
        </div>
@endif

@if(session('warning'))
    
    <div class=" alert alert-warning text-center" role="alert">
        {{session('warning')}}
    </div>
    
@endif