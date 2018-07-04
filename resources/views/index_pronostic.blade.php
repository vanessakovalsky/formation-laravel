Index des pronostics

<table>
  <tn>
    <th>Score 1</th>
    <th>Score 2</th>
    <th>Voir</th>
    <th>Modifier</th>
    <th>Supprimer</th>
  </tn>
@foreach ($pronostics as $pronostic)
<tr>
 <td>{{ $pronostic->score1 }}</td>
 <td>{{ $pronostic->score2 }}</td>
 <td><a href="{{ route('pronostic.show', $pronostic->id)}}">Voir</a></td>
 <td><a href="{{ route('pronostic.edit', $pronostic->id)}}">Modifier</a></td>
 <td><a href="{{ route('pronostic.delete', $pronostic)}}">Supprimer</a></td>
</tr>
@endforeach
</table>
