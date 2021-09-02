@extends('layouts.app')

@section('content')
<div class="container"> <div class=" text-center mt-5 ">
        <h1>Oro linijos</h1>
    </div>
    <div class="container border p-2 bg-color mt-3 mb-3">
            <a class="btn btn-primary" href="{{ route('airline.create') }}">Pridėti oro linija</a>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Pavadinimas</th>
                <th>Veiksmai</th>
              
            </tr>
        </thead>
        <tbody>
            @if($airlines)
            @foreach ($airlines as $airline)
            <tr>
                <td>{{$airline->name}}</td>
                <td>
                    {{-- {{dd($airline->name)}} --}}
                    <a href="{{route('edit.airline', $airline->id)}}" class="btn btn-success">Redaguoti</a>
                    <form action="{!! route('airline.delete', $airline->id) !!}" method="post">
                      {{ csrf_field() }}
                     <button type="submit" class="btn btn-danger">Trinti</button>
                    </form>
                  
                </td>
                
            </tr>
            @endforeach
            @else
            @endif
             </tbody>
        <tfoot>
            <tr>
               <th>Pavadinimas</th>
                <th>Veiksmai</th>
            </tr>
        </tfoot>
    </table>
   
    
    <div class="w-100 d-none d-md-block"></div>
    
  
</div>


@endsection