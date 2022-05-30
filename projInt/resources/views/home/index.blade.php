@extends('layouts.app')

@section('content')

<div class="container fluid d-flex align-items-center border mb-2 bg-light">
  <div class="container">
    <div class="row mt-2 mb-2">
      <div class="col  p-1">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createTournament">Criar
          torneio</button>
      </div>
    </div>
  </div>
</div>

<div class="container fluid d-flex align-items-center border mb-2 bg-light">
  <h2>Torneios Criados</h2>
</div>

<div class="container fluid d-flex align-items-center border mt-1 bg-light">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Numero times</th>
        <th scope="col">Premiação</th>
        <th scope="col">infos</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tournaments as $tournament)
      <tr>
        <th scope="row">{{$tournament->name}}</th>
        <td>{{$tournament->number_teams}}</td>
        <td>{{$tournament->prize}}</td>
        <td> <a href="{{Route('indexTournament', $tournament->id)}}"><button type="button"
              class="btn btn-dark">Ver</button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


<!-- Modal Tournament-->
<div class="modal fade" id="createTournament" tabindex="-1" role="dialog" aria-labelledby="createTournamentLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Criar Torneio</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <form action="{{Route('createTournament')}}" method="POST">
            @csrf
            <input type="text" class="form-control" name="nameTournament" maxlength="50" placeholder="Nome do torneio">
            <textarea class="form-control" name="descTournament" rows="3" placeholder="Descrição"></textarea>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Numero de times</label>
              <select class="form-control" name="teamsTournament">
                <option>16</option>
                <option>32</option>
              </select>
            </div>
            <input type="number" class="form-control" name="prizeTournament" placeholder="Premiação" step=".01">
            {{-- <input type="text" class="form-control" name="sportTournament" placeholder="Esporte"> --}}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Criar</button>
      </div>
      </form>
    </div>
  </div>
</div>>
@endsection