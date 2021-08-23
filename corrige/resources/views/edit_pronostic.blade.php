<h1>Modification du pronostic</h1>
<form action={{ route('pronostic.update', $pronostic->id) }} method="POST">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <input value={{ $pronostic->score1 }} name="score1" type="text" />
  <input type="submit" value="Modifier" />
</form>
