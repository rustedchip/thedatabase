@extends('thedatabase::app')

@section('header')
    <h5 class="text-secondary">{{ __('tables') }}</h5>
@endsection

@section('slot')
    @foreach($tables as $table)
        <a class="btn btn-dark border-secondary" href="{{ route('thetablerows',$table)}}">{{$table}}</a>
    @endforeach
@endsection