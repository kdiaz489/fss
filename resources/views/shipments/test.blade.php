@extends('layouts.app')

@section('content')
<form id="basic-form" action="" method="post">
    <p>
      <label for="name">Name <span>(required, at least 3 characters)</span></label>
      <input id="name" name="name">
    </p>
  <p>
      <label for="age">Your Age <span>(minimum 18)</span></label>
      <input id="age" name="age">
    </p>
    <p>
      <label for="email">E-Mail <span>(required)</span></label>
      <input id="email" name="email">
    </p>
  <p>
    <label for="weight">Weight <span>(required if age over 50)</span></label>
    <input id="weight" name="weight">
    </p>
    <p>
      <input class="submit" type="submit" value="SUBMIT">
    </p>
</form>
@endsection()