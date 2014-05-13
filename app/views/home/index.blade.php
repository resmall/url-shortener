@extends('master')

@section('container')
	<h1>Encurtador de URL</h1>
	{{ Form::open( array('url'=> '/', 'method'=>'post') ) }}
		{{-- Form::label('URL longa') --}}
		{{ Form::text('url') }}
	{{ Form::close() }}
	{{ $errors->first('url', '<p class="error">:message</p>') }}
@stop