@extends('layouts.fontend_master')

@section('code', '404 😭')

@section('title', __('Page Not Found'))

@section('image')

<div style="max-width: 300px;margin:0 auto">
    <h1>Error 404 — Not Found 
        <br>
        <br>
        Sorry, the page you are looking for could not be found</h1>
</div>

@endsection

@section('message', __('Sorry, the page you are looking for could not be found.'))