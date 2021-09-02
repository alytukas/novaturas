 
@extends('layouts.app')


@section('content')
 <div class="card" style="background: #EDECEC">
  <div class="card-header">
    Pridėti oro uostą
  </div>
   <div class="card-body" >
     <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @include('partials.messages')
      <div class="form-group">
        <label for="exampleInputPassword1">Pasirinkite šalį</label>
        <select class="form-control" name="country_id" >
          <option></option>
          @foreach($countrys as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
          
        </select>
      </div>
      <div class="form-group">
        <label class="form-check-label" for="airlinesCheck">Pasirinkite oro linija:</label>
        
        @foreach ($airlines as $airline)
        <div class="form-check">
        <input id="airlinesCheck" class="form-check-input" type="checkbox" name="airlines[]" value="{{ $airline->id}}">{{$airline->name}}</input>   
        </div>
        @endforeach
      </div>
  <div class="form-group">
    <label for="name">Pavadinimas</label>
    <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Įveskite pavadinimą">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Platuma</label>
    <input value="{{ old('latitude') }}" id="latitude" name="latitude" class="form-control" min="0" step="0.000001"></input>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Ilguma</label>
    <input value="{{ old('longitude') }}" id="longitude" name="longitude" class="form-control" min="0" step="0.000001"></input>
  </div>
<div class="m-3" id='map' style='width: 600px; height: 300px;'></div>

  

  <button type="submit" class="btn btn-primary mt-2">Pridėti oro uostą</button>
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