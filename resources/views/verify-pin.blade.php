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
                          <form action="{{ route('verify-pin-code') }}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{ $id }}">
                              
                                  
                                 <div class="form-group"> <input type="text" name="pin" value="" class="form-control"></div>
                                  <button type="submit" class="btn btn-success">Verify</button>
                          </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
