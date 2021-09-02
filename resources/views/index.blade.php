@extends('layouts.app')

@section('content')
 <div class=" text-center mt-5 ">
        <h1>Oro uostų valdymas</h1>
    </div>
    <div class="container border p-2 bg-color mt-3 mb-3">
        <div class="mb-2">
            <a class="btn btn-primary" href="{{ route('create') }}">Pridėti oro uostą</a>
            <a class="btn btn-primary" href="{{ route('airlines.index') }}">Valdyti oro linijas</a>
        </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Pavadinimas</th>
                <th>Šalis</th>
                <th>Ilguma</th>
                <th>Platuma</th>
                <th>Oro linijos</th>
                <th>Veiksmai</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach ($airports as $airport)
            <tr>
                <td>{{$airport->name}}</td>
                <td>{{$airport->country->name}}</td>
                <td>{{$airport->longitude}}</td>
                <td>{{$airport->latitude}}</td>
                <td>
                    @foreach($airport->airline as $airline)
                    <li>{{$airline->name}}</li>
                    @endforeach
                </td>
                <td>
                    {{-- {{dd($airport->id)}} --}}
                    <a href="{{route('edit', $airport->id)}}" class="btn btn-success mb-3">Redaguoti</a>
                    <form action="{!! route('delete', $airport->id) !!}" method="post">
                      {{ csrf_field() }}
                     <button type="submit" class="btn btn-danger">Trinti</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Pavadinimas</th>
                <th>Šalis</th>
                <th>Ilguma</th>
                <th>Platuma</th>
                <th>Veiksmai</th>
                
            </tr>
        </tfoot>
    </table>
    {{$airports->links()}}
    </div>
    
    <div class="w-100 d-none d-md-block"></div>
    


{{-- <iframe src="https://maps.google.com/maps?q=Tangesir%20Dates%20Products&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" width=300 height=150 allowfullscreen></iframe> --}}
<div class="m-3" id='map' style='width: 600px; height: 300px;'></div>
<style>
 
</style>
<script>
let arra = JSON.parse('{!! json_encode($airports) !!}');
mapboxgl.accessToken = 'pk.eyJ1IjoiYWx5dHVrYXMiLCJhIjoiY2tzeGs5bTRvMjM5eTMxcG5zMnhqOWJjayJ9.MlF-qS6mjIJdl09GdfdaEw';


var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [arra.data[0]['longitude'], arra.data[0]['latitude']],
zoom: 4
});




var geojson = {
    type: 'FeatureCollection',
  features: [
  ]
}

for (let i = 0; i < arra.data.length; i++) {
    let marker_object = {};
    marker_object.type = 'Feature';
    marker_object.geometry = {
        type: 'Point',
        coordinates: [arra.data[i]['longitude'], arra.data[i]['latitude']]
    }
    marker_object.properties = {
        title: 'Mapbox',
        description: arra.data[i]['name']
    }
    geojson.features.push(marker_object);
}
 console.log(geojson.features);
// add markers to map
for (const { geometry, properties } of geojson.features) {
  // create a HTML element for each feature
  const el = document.createElement('div');
  el.className = 'marker';

  // make a marker for each feature and add to the map
  new mapboxgl.Marker(el).setLngLat(geometry.coordinates).addTo(map);
}

</script>
@endsection