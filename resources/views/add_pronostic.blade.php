<form method="POST" action="{{ route('pronostic.store')}}">
  {{ csrf_field() }}
  <input type="text" name="score1" placeholder="Score 1" />
  <input type="text" name="score2" placeholder="Score 2" />
  <input type="submit" value="Enregistrer" />
</form>
