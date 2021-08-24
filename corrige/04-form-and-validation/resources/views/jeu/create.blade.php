@extends('template')
 
@section('contenu')
    <form action="{{ url('/jeu') }}" method="POST">
        @csrf
        <label for="nom">Entrez le nom du jeu : </label>
        <input type="text" name="nom" id="nom">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="editeur">Entrez l éditeur du jeu : </label>
        <input type="text" name="editeur" id="editeur">
        @error('editeur')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="year">Entrez l année du jeu : </label>
        <input type="number" name="year" id="year">
        @error('year')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="categorie">Entrez la catégorie du jeu : </label>
        <input type="text" name="categorie" id="categorie">
        @error('categorie')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <input type="submit" value="Envoyer !">
    </form>
@endsection