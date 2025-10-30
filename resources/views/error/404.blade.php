@extends('errors::minimal')

@section('title', __('Not Found'))

@section('message')

    <!-- <span class="avatar avatar-lg rounded-circle" style="background-image: url({{ asset('images/logo.png') }})"></span> -->

    <div class="alert alert-danger m-4" role="alert">
        <div class="d-flex">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
        </div>
          <div>
            <h4 class="alert-title text-start">404 | Page not Found</h4>
            <div class="text-secondary">Sorry! We could not find the page you were looking for.</div>
          </div>
        </div>
    </div>



@endsection
