 
@extends('layouts.app')


@section('content')
 <div class="card" style="background: #EDECEC">
  <div class="card-header">
    Pridėti oro linija
  </div>
   <div class="card-body" >
     <form action="{{ route('airline.store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{-- @include('backend.partials.messages') --}}
      <div class="form-group">
    </div>
    <div class="form-group">
        <label for="name">Pavadinimas</label>
        <input type="text" value="" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Iveskite pavadinimą">
    </div>
    
    <label for="exampleInputPassword1">Pasirinkite šalį</label>
    <select class="form-control" name="country_id" >
      <option></option>
      @foreach($countrys as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
      
    </select>

  

  <button type="submit" class="btn btn-primary mt-2">Sukurti oro liniją</button>
</form>


   </div>
 </div>
      
      @endsection