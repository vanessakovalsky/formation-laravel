@extends('template')

@section('titre')
        Ma super liste de jeux :)
@endsection

@section('contenu')
        <table>
        @forelse($data as $jeux)
            @foreach($jeux as $jeu)
                <tr><td>{{ $jeu['nom'] }}</td></tr>
            @endforeach
        @empty
            Pas de jeux
        @endforelse
@endsection