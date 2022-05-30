@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/tournament.css')}}">
<div class="container fluid d-flex align-items-center border mb-2 bg-light">
  <h1>{{$tournaments->name}}</h1>
</div>
@if ( $tournaments->teams->count() < $tournaments->number_teams)
  <div class="container fluid d-flex align-items-center border mb-2 bg-light">
    <div class="container">
      <div class="row mt-2 mb-2">
        <div class="col  p-1">
          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createTeam">Add Time
            na
            competição</button>
        </div>
      </div>
    </div>
    <!-- Modal Team-->
    <div class="modal fade" id="createTeam" tabindex="-1" role="dialog" aria-labelledby="createTeamtLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Time</h5>
          </div>
          <div class="modal-body">
            <h5>Criar time</h5>
            <div class="form-group">
              <form action="{{Route('createTeam', $tournaments->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" class="form-control" name="nameTeam" placeholder="Nome do time">
                <span>Emblema</span>
                <div class="form-group">
                  <input type="file" class="form-control-file" name="emblemTeam">
                </div>
                <input type="text" maxlength="3" class="form-control mt-1" name="abreviationTeam"
                  placeholder="Abreviação">
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Criar</button>
                </div>
              </form>
            </div>
            <h5>Criar time</h5>
            <div class="form-group">
              <form action="{{Route('includeTeam', $tournaments->id)}}" method="POST" id="teamForm">
                @csrf
                <select class="form-select" name="teamSelect">
                  @foreach ($teams as $team)
                  <option value="{{$team->id}}">{{$team->name}}</option>
                  @endforeach
                </select>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else

  <div class="container fluid d-flex align-items-center border mb-2 bg-light">
    <div class="container">
      <div class="row mt-2 mb-2">
        <div class="col  p-1">
          <form action="{{Route('sortPlayoff')}}" method="POST">
            @csrf
            @php $flag = 1;@endphp
            @foreach ($tournaments->teams as $team)
            <input type="hidden" name="team{{$flag++}}" value="{{$team->pivot->id}}">
            @endforeach
            <button type="submit" class="btn btn-outline-primary">Sortear
              playoffs</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  </div>
  @endif

  <div class="container fluid d-flex align-items-center border bg-light">
    <div class="card-body table-responsive p-0 mt-3">
      <h3>Times na competição</h3>
      <table class="table table-hover table-ligth">
        <thead>
          <tr>
            <th scope="col">Emblema</th>
            <th scope="col">Time</th>
            <th scope="col">Abreviação</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tournaments->teams as $team)
          <tr>
            <th scope="row"><img src="{{$team->emblem}}" width="24" height="30"></th>
            <td>{{$team->name}}</td>
            <td>{{$team->abreviation}}</td>
            @if ( $tournaments->teams->count() < $tournaments->number_teams)
            <td>
              <a href="{{Route('indexTeam', $team->id)}}"><button type="button" class="btn btn-dark">Ver</button></a>
              <form action="{{Route('deleteTeam', $tournaments->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="teamId" value="{{$team->id}}">
              <button type="submit" class="btn btn-danger">Del</button>
              </form>
            </td>
            @else
            <td>
              <a href="{{Route('indexTeam', $team->id)}}"><button type="button" class="btn btn-dark">Ver</button></a>
            </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  @if ($matchs->count() > 0)
  <div class="container fluid d-flex align-items-center border bg-light">
    <div class="card-body table-responsive p-0 mt-3">
      <h3>Partidas</h3>
      <table class="table table-hover table-ligth">
        <thead>
          <th></th>
          <th>Time</th>
          <th>Placar</th>
          <th>Time</th>
          <th></th>
          <th>Ver</th>
        </thead>
        <tbody>
          @foreach ($matchs as $match)
          @if ($match->team_tournament1->tournament_id == $tournaments->id)
          <tr>
            <td><img src="{{$match->team_tournament1->team()->first()->emblem}}" width="24" height="30"></td>
            <td>{{$match->team_tournament1->team()->first()->name}}</td>
            <td>{{$match->stats->goals1}} X {{$match->stats->goals2}}</td>
            <td>{{$match->team_tournament2->team()->first()->name}}</td>
            <td><img src="{{$match->team_tournament2->team()->first()->emblem}}" width="24" height="30"></td>
            <td>
              <a href="{{Route('indexMatch', $match->id)}}"><button type="button" class="btn btn-dark">Ver</button></a>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
  @endsection