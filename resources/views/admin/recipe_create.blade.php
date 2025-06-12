<!DOCTYPE html>
<html>
  <header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ登録</title>
    {{ view('admin.admin_header') }}
  </header>
  <body>
    <div class="max-w-7xl max-auto px-6">
      <h1>レシピ登録</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
        <form method="post" action="{{ route('recipe.store') }}">
            @csrf
            @include('admin.recipe_form')
            <br>
            <button type="submit">登録</button>
        </form>
    </div>
  </body>
</html>


  