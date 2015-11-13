@extends('layouts.master')

@section('title')
    Delete {{ $book->title }}
@stop

@section('content')

    <h1>Do you really want to delete {{ $book->title }}?</h1>
    <a href='/books' class="btn btn-primary">Get me out of here!</a>
    <form method='POST' action='/books/delete'>
   		<input type='hidden' value='{{ csrf_token() }}' name='_token'>
   		<input type='hidden' name='id' value='{{ $book->id }}'>
    	<button type="submit" class="btn btn-danger">Delete!</button>
    </form>

@stop