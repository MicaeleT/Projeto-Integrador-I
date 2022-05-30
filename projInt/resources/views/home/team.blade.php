@extends('layouts.app')
@section('content')

<div class="container fluid d-flex align-items-center border mb-2 bg-light">
  @foreach ($teams as $team)
  <h1>{{$team->name}}</h1>
  @endforeach
</div>

<div class="container fluid d-flex align-items-center border mb-2 bg-light">
  <div class="card-body table-responsive p-0 mt-3">
    <h2>Elenco</h2>
    <table class="table table-hover table-ligth">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Posição</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($players as $player)
        <tr>
          <th scope="row">{{$player->name}}</th>
          <td>{{$player->position}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection