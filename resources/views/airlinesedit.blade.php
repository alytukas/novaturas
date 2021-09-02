 
@extends('layouts.app')


@section('content')
 <div class="card" style="background: #EDECEC">
  <div class="card-header">
    Redaguoti
  </div>
   <div class="card-body" >
     <form action="{{ route('airline.update', $airline->id) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{-- @include('backend.partials.messages') --}}
      <div class="form-group">
    </div>
    <div class="form-group">
        <label for="name">Pavadinimas</label>
        <input type="text" value="{{ $airline->name }}" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Iveskite kategorijos pavadinima">
    </div>
    
    <label for="exampleInputPassword1">Pasirinkite šalį</label>
    <select class="form-control" name="country_id" >
      <option></option>
      @foreach($countrys as $country)
        <option value="{{ $country->id }}"  @if($country->id == $airline->country_id) selected @endif>{{ $country->name }}</option>
      @endforeach
      
    </select>

  

  <button type="submit" class="btn btn-primary">Redaguoti oro liniją</button>
</form>


   </div>
 </div>
      
      @endsection