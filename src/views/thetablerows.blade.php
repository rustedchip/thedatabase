@extends('thedatabase::app')

@section('header')
    <h5 class="text-secondary"><a href="{{ route('thedatabasetables') }}">{{ __('tables') }}</a> - {{ $table }} </h5>
@endsection

@section('slot')

    <div>
        <form action="{{route('thetablerows',$table)}}" method="GET">
        

        <div class="input-group mb-3">
            <span class="input-group-text bg-dark text-light  border-secondary" id="basic-addon1"><span class="icon-magnifier"></span></span>
            <input class="form-control bg-dark text-light border-secondary" type="text" name="search" value="{{$search ?? '. . .'}} " >
          </div>

        
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    @foreach($columns as $column)

                    @if($loop->first)
                    @php $first_column = $column @endphp
                    @endif
                   
                        <th>{{ $column }}</th>
                    @endforeach
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="{{route('tablerowinsert',$table)}}" method="POST">
                        @csrf
                    @foreach($columns as $column)
                    <td><input @if( in_array($column, $protected_fields)) readonly @endif class="form-control text-light border-secondary @if( in_array($column, $protected_fields)) bg-secondary @else  bg-dark @endif" type="text"  name="{{$column}}"></td>
                    @endforeach
                    <th><button type="submit" class="btn btn-primary"><span class="icon-pencil"></span></button></th>
                    </form>
                </tr>

                @foreach($rows as $row)


                        <form action="{{route('tablerowupdate',[$table,$row->$first_column])}}" method="POST">
                            @csrf
                            @method('PUT')
                        @foreach($columns as $column)
                        <td><input @if( in_array($column, $protected_fields)) readonly @endif class="form-control  border-secondary text-light @if( in_array($column, $protected_fields)) bg-secondary @else  bg-dark @endif" type="text" value="{{$row->$column}}" name="{{$column}}"></td>
                        @endforeach
                        <td>
                            <div style="width:90px !important;">
                            <button type="submit" class="btn btn-warning"><span class="icon-note"></span></button>
                            <a href="{{ route('tablerowdelete',[$table,$row->$first_column])}}" class="btn btn-danger"><span class="icon-trash"></span></a>
                            </div>
                        </td>
                        </form>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $rows->links('thedatabase::paginator') }}
    </div>
    @endsection
