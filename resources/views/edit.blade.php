 
@extends('layouts.app')


@section('content')
 <div class="card" style="background: #EDECEC">
  <div class="card-header">
    Redaguoti
  </div>
   <div class="card-body" >
     <form action="{{ route('update', $airport->id) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{-- @include('backend.partials.messages') --}}
      <div class="form-group">
        <label for="exampleInputPassword1">Pasirinkite šalį</label>
        <select class="form-control" name="country_id" >
          <option></option>
          @foreach($countrys as $country)
            <option value="{{ $country->id }}" @if($country->id == $airport->country_id) selected @endif>{{ $country->name }}</option>
          @endforeach
          
        </select>
      </div>
      {{-- <div class="form-group">
        <label for="exampleInputPassword1">Pasirinkite oro linija</label>
        <select class="form-control" name="airline_id" >
          <option></option>
          @foreach($airlines as $airline)
            <option value="{{ $airline->id }}">{{ $airline->name }}</option>
          @endforeach
          
        </select>
      </div> --}}
      <div class="form-group">
        <label for="exampleInputPassword1">Pasirinkite oro linija</label>
        {{-- <select class="form-control" name="airline_id" >
          <option></option>
          @foreach($airlines as $airline)
      
            <option value="{{ $airline->id }}">{{ $airline->name }}</option>
          @endforeach
          
        </select> --}}
        @foreach ($airlines as $airline)
        
         <input type="checkbox" name="airlines[]" value="{{ $airline->id}}">{{$airline->name}}</input>   
        @endforeach
      </div>
  <div class="form-group">
    <label for="name">Pavadinimas</label>
    <input type="text" value="{{ $airport->name }}" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Iveskite kategorijos pavadinima">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Platuma</label>
    <input value="{{ $airport->latitude }}" id="latitude" name="latitude" class="form-control" min="0" step="0.000001"></input>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Ilguma</label>
    <input value="{{$airport->longitude}}" id="longitude" name="longitude" class="form-control" min="0" step="0.000001"></input>
  </div>
<div class="m-3" id='map' style='width: 600px; height: 300px;'></div>
  

  <button type="submit" class="btn btn-primary">Redaguoti oro uostą</button>
</form>


   </div>
 </div>
        <script>
          mapboxgl.accessToken = 'pk.eyJ1IjoiYWx5dHVrYXMiLCJhIjoiY2tzeGs5bTRvMjM5eTMxcG5zMnhqOWJjayJ9.MlF-qS6mjIJdl09GdfdaEw';
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [25.279652, 54.687157],
  zoom: 5.5
});
map.on('style.load', function() {
  map.on('click', function(e) {
    var coordinates = e.lngLat;
    new mapboxgl.Popup()
      .setLngLat(coordinates)
      .setHTML(coordinates)
      .addTo(map);
      document.getElementById("latitude").value = coordinates.lat;
      document.getElementById("longitude").value = coordinates.lng;
  });
});
      </script>
      @endsection