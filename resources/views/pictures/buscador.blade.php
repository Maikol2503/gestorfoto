@extends('layout')
	
@section('content')

<div class="row mb-5">
    <button id="newPicture" class="btn btn-success offset-10 col-2" onclick="openModal('create')">Añadir</button>
</div>
<div id="pictures1">

</div>
<section id="pictures" class="row g-3 d-flex justify-content-center">
    @if(!count($pictures))
        <h2>¡Ningun Resultado!</h2>
    @else
        @foreach($pictures as $picture)
            <div class="card col-md-3 col-sm-6 col-12 col-m-10 m-3" id="img-{{$picture->id}}">
                <img src="{{route('get-picture',['picture'=>$picture->picture_url])}}" class="card-img-top">
                <div class="card-body">
                    <h5 id="cardTitle{{$picture->id}}">{{$picture->picture_name}}</h5>
                    <p id="fecha">{{$picture->created_at}}</p>
                    <div id="starsContainer{{$picture->id}}">
                        <select class="star-rating" id="cardRating{{$picture->id}}" disabled="">
                            <option></option>
                            <option value="1" @selected("1" == $picture->rating)></option>
                            <option value="2" @selected("2" == $picture->rating)></option>
                            <option value="3" @selected("3" == $picture->rating)></option>
                            <option value="4" @selected("4" == $picture->rating)></option>
                            <option value="5" @selected("5" == $picture->rating)></option>
                        </select>
                    </div>
                    <div class="row mt-3">
                        <button class="btn btn-primary col-md-5 col-sm-6 col-12" onclick="openModal('edit',{{$picture->id}})">Editar</button>
                        <button class="btn btn-danger col-md-5 col-sm-6 col-12 offset-md-2" onclick="confirmDeletion({{$picture->id}})">Borrar</button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif		
</section>
@section('scripts')





    
    {{-- <script type="text/javascript" src="{{asset('js/buscador.js')}}"></script> --}}
{{-- @endsection --}}
{{-- <script>
    window.addEventListener("load", function(){
    document.getElementById("buscador").addEventListener("keyup", function(){
        fetch(`/buscador?buscador=${document.getElementById("buscador").value}`, 
        {method: "get"})
        .then(response => response.text())
        .then(html => {
            document.getElementById("pictures1").innerHTML = html;
        })
    })
})
</script> --}}


