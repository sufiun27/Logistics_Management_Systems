<div>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif

</div>
