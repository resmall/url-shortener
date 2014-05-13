@extends('master')


@section('container')
  <h1>Aqui esta a sua url encurtada</h1>
  {{ HTML::link($shortened, "url.dev/$shortened") }}

@stop