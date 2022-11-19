<x-app-layout>

  <x-slot name="header">
    投稿の新規作成
  </x-slot>

    <div class="mx-4 sm:p-8">
      <form method="post" action="{{route('post.store')}}"
      enctype="multipart/form-data">
        @csrf
        <div class="md:flex items-center mt-4">
          <div class="w-full flex flex-col">
            <label for="title" class="font-semibold leading-none mt-4">件名</label>
            <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md"
              id="title" placeholder="Enter Title" value="{{old('title')}}">
          </div>
        </div>

        <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">本文</label>
          <textarea name="body" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body"
            cols="30" rows="10">{{old('body')}}</textarea>
        </div>

        <div class="w-full flex flex-col">
          <label for="image" class="font-semibold leading-none mt-4">画像(1MBまで) </label>
          <div>
            <input id="image" type="file" name="image">
          </div>
        </div>

        <x-button class="mt-4 btnsetg">
          送信する
        </x-button>

      </form>
    </div>
</x-app-layout>
