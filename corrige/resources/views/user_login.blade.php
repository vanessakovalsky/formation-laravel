<?php


 ?>
 Bienvenue sur ma page de login.
 <form method="POST" action="{{ route('user.connect') }}">
   {{ csrf_field() }}
   <input type="text" name="login" />
   <input type="password" name="password" />
   <input type="submit" value="Se connecter" />
 </form>
