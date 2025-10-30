@extends('errors::minimal')

@section('title', __('Forbidden'))

@section('message')

    <span class="avatar avatar-lg rounded-circle" style="background-image: url({{ asset('images/logo.png') }})"></span>
    <div class="alert alert-warning m-4" role="alert">
        <div class="d-flex">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
          </div>
          <div>
            <h4 class="alert-title text-start">403 | Forbidden</h4>
            <div class="text-secondary">Sorry! You are not authorize to make this Action.</div>
          </div>
        </div>
    </div>



@endsection

