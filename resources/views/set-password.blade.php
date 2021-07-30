@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card text-center">
              
                        <div class="card-body">
                          <form action="{{ route('crete.password') }}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $user->id }}">
                              <div class="form-group">  <input type="text" value="{{ $user->name }}" class="form-control"></div>
                                 <div class="form-group">
          
                                  <input type="text" value="{{ $user->email }}" class="form-control">
                                 </div>
                                  
                                 <div class="form-group"> <input type="text" name="password" value="" class="form-control"></div>
                                  <button type="submit" class="btn btn-success">Create</button>
                          </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
