<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>レシピ更新</title>
</head>

@include('admin.admin_header')

<body>
  <section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col px-6 w-full">
        <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">
          レシピ更新
        </h1>
        @if (session('message'))
          <div class="text-red-600 font-bold">
            {{ session('message') }}
          </div>
        @endif
      </div>
      <form method="post" action="{{ route('recipe.update', $recipe) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('admin.recipe_form')
        <br>
        <button type="submit">更新</button>
      </form>
    </div>
  </section>
</body>

</html>