Index des pronostics

<table>
  <tn>
    <th>Score 1</th>
    <th>Score 2</th>
  </tn>
@foreach ($pronostics as $pronostic)
<tr>
 <td>{{ $pronostic->score1 }}</td>
 <td>{{ $pronostic->score2 }}</td>
</tr>
@endforeach
</table>
