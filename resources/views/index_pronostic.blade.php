Index des pronostics

<table>
  <tn>
    <th>Score 1</th>
    <th>Score 2</th>
    <th>Match</th>
    <th>Voir</th>
    <th>Modifier</th>
    <th>Supprimer</th>
  </tn>
@foreach ($prono_match as $pronostic)
{{ $pronostic->match->created_at }}
<tr>
 <td>{{ $pronostic->score1 }}</td>
 <td>{{ $pronostic->score2 }}</td>
 <td>{{ $pronostic->game_id }}</td>
 <td><a href="{{ route('pronostic.show', $pronostic->id)}}">Voir</a></td>
 <td><a href="{{ route('pronostic.edit', $pronostic->id)}}">Modifier</a></td>
 <td><a href="{{ route('pronostic.delete', $pronostic)}}">Supprimer</a></td>
</tr>
@endforeach
</table>
