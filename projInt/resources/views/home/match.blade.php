@extends('layouts.app')

@section('content')
<div>
  <img src="{{$team1->emblem}}" class="rounded float-start" style="width: 200px; max-height: auto; margin-left: 300px;">
  <img src="{{$team2->emblem}}" class="rounded float-end" style="width: 200px; max-height: auto; margin-right: 300px">
</div>
<div class="container fluid d-flex align-items-center border bg-light">
  <form action="{{Route('editStats', $match->id)}}" method="POST">
    @csrf
    <h3 class="text-center" style="margin-left: 100px">Gols
      <input type="number" class="form-label" name="goals1" placeholder="{{$match->stats->goals1}}">
      <input type="number" class="form-label" name="goals2" placeholder="{{$match->stats->goals2}}"> Gols</h3>
    <h3 class="text-center" style="margin-left: 100px">Chutes
      <input type="number" class="form-label" name="shots1" placeholder="{{$match->stats->shots1}}">
      <input type="number" class="form-label" name="shots2" placeholder="{{$match->stats->shots2}}"> Chutes</h3>
    <h3 class="text-center" style="margin-left: 86px">Posse de bola
      <input type="number" class="form-label" name="possesion1" placeholder="{{$match->stats->possesion1}}">
      <input type="number" class="form-label" name="possesion2" placeholder="{{$match->stats->possesion2}}"> Posse de bola</h3>
    <button type="submit" class="btn btn-primary">Criar</button>
  </form>
</div>
</div>
@endsection