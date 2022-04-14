
@if ($errors->any())
    <div class="alert alert-danger">
        <span class="fw-bold">There were errors with your submission:</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>        
            @endforeach
        </ul>
    </div>
@endif