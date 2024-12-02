@extends('layouts.fontend_master')

@section('code', '500 😭')

@section('title', __('Internal Server Error'))

@section('image')

<div style="max-width: 300px;margin:0 auto">
    <h1>Error 500 — Internal Server Error
        <br>
        <br> Sorry, the page you are looking for could not be found</h1>
</div>

@endsection

@section('message', __('Sorry, the page you are looking for could not be found.'))