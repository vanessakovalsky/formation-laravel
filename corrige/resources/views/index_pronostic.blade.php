@extends('layouts.app')

@section('content')
@toto('Index des pronostics')

<table>
  <tn>
    <th>Score 1</th>
    <th>Score 2</th>
    <th>Match</th>
    <th>Voir</th>
    <th>Modifier</th>
    <th>Supprimer</th>
  </tn>
@foreach ($pronostics as $pronostic)
<tr>
 <td>{{ $pronostic->score1 }}</td>
 <td>{{ $pronostic->score2 }}</td>
 <td>{{ $pronostic->game_id }}</td>
 <td><a href="{{ route('pronostic.show', $pronostic->p_id)}}">Voir</a></td>
 <td><a href="{{ route('pronostic.edit', $pronostic->p_id)}}">Modifier</a></td>
 <td><a href="{{ route('pronostic.delete', $pronostic->p_id)}}">Supprimer</a></td>
</tr>
@endforeach
</table>
@endsection
