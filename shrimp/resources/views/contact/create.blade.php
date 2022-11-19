<x-app-layout>
<x-slot name="header">
  <p class="text-white">お問い合わせ</p>
</x-slot>
<div class="h-10"></div>
  <div class="duration-300 hover:shadow-black hover:shadow-2xl
              max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-slate-100
              h-auto rounded-xl">
    <div class="mx-4 sm:p-8">
      <h1 class="text-xl text-gray-700 font-semibold hover:underline cursor-pointer">
                    制作者に直で繋がります
                </h1>
      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <x-message :message="session('message')" />

      <form method="post" action="{{route('contact.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
            <label for="title"
            class="font-semibold leading-none mt-4">
            件名
          </label>
            <input type="text" name="title"
            class="w-auto py-2 placeholder-gray-300
            border border-gray-300 rounded-md"
              id="title" value="{{old('title')}}"
              placeholder="Enter Title">
          </div>
        </div>

        <div class="w-full flex flex-col">
          <label for="body" class="font-semibold
          leading-none mt-4">
          本文
        </label>
          <textarea name="body" class="w-auto py-2
          placeholder-gray-300 border border-gray-300
          rounded-md" id="body"
            cols="30" rows="10">
            {{old('body')}}
          </textarea>
        </div>

        <div class="md:flex items-center">
          <div class="w-full flex flex-col">
            <label for="email" class="font-semibold
            leading-none mt-4">
            メールアドレス
          </label>
            <input type="text" name="email"
            class="w-auto py-2 placeholder-gray-300
            border border-gray-300 rounded-md"
              id="email" value="{{old('email')}}"
              placeholder="Enter Email">
          </div>
        </div>
        <x-button class="mt-4 btnsetg">
          送信する
        </x-button>

      </form>
    </div>
  </div>
</x-app-layout>
