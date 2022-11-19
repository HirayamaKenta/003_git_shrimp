<x-app-layout>
  <x-slot name="header">
    投稿の詳細表示
  </x-slot>

  <div class="px-4 md:px-10 mt-4 sm:p-8">

    <div class="bg-white w-full  rounded-2xl
        px-10 py-8 shadow-lg hover:shadow-2xl
        transition duration-500">
      <div class="mt-4">
        <div class="flex">
          <div class="rounded-full w-12 h-12">
            {{-- アバター表示 --}}
            <img src="
            @if($post->user->avatar!=='user_default.jpg')
                  {{asset('storage/images/'.$post->user->avatar)}}
                @else
                  {{asset('logo/user_default.jpg')}}
                @endif
            " class="h-12">
          </div>
          <h1 class="text-lg text-gray-700
          font-semibold float-left pt-4">
          {{ $post->title }}
          </h1>
        </div>
        <hr class="w-full">
      </div>
      {{-- ↓ボタン --}}
      <div class="flex justify-end mt-4">
        @can('update', $post)
        {{-- ↓policyの適用 --}}
        <a href="{{route('post.edit', $post)}}">
          <x-button class="btnsetb float-right">
            編集
          </x-button>
        </a>
        {{-- ↑policyの適用 --}}
        @endcan

        @can('delete', $post)
        {{-- ↓policyの適用 --}}
        <form method="post" action="{{route('post.destroy', $post)}}">
          @csrf
          @method('delete')
          <x-button class="btnsetr float-right ml-4" onClick="return confirm('本当に削除しますか？');">
            削除
          </x-button>
        </form>
        {{-- ↑policyの適用 --}}
        @endcan
      </div>
      {{-- ↑ボタン --}}
      <div>
        <p class="mt-4 text-gray-600 py-4">{{$post->body}}</p>
        {{-- ↓画像出力コード --}}
        @if ($post->image)
        <div>
          {{-- (画像ファイル：{{$post->image}}) --}}
        </div>
        <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
        @endif
        {{-- ↑画像出力コード --}}
        <div class="text-sm font-semibold flex flex-row-reverse">
          <p> {{ $post->user->name ?? "削除されたユーザー"}} <br>
              {{-- {{$post->created_at->diffForHumans()}} --}}
              初回投稿日:{{$post->created_at->format("Y/m/d H:i:s")}}<br>
              最新更新日:{{$post->updated_at->format("Y/m/d H:i:s")}}
                </p>
        </div>
      </div>
    </div>
    {{-- ↓過去コメント表示 --}}
    @foreach ($post->comments as $comment)
    <div class="bg-white w-full  rounded-2xl px-10 py-8
shadow-lg hover:shadow-2xl transition duration-500 mt-8">
      {{$comment->body}}
      <div class="text-sm font-semibold flex flex-row-reverse">
        <p> {{ $comment->user->name ?? "削除されたユーザー"}}
      • {{$comment->created_at->diffForHumans()}}
    </p>
    <span class="rounded-full w-12 h-12">
      <img src="
      @if($comment->user->avatar!=='user_default.jpg')
                  {{asset('storage/images/'.$comment->user->avatar)}}
                @else
                  {{asset('logo/user_default.jpg')}}
                @endif
      ">
    </span>
      </div>
    </div>
    @endforeach
    {{-- ↑過去コメント表示 --}}
    {{-- ↓コメント --}}
    <div class="mt-4 mb-12">
      <form method="post" action="{{route('comment.store')}}">
        @csrf
        <input type="hidden" name='post_id' value="{{$post->id}}">
        <textarea name="body" class="bg-white w-full  rounded-2xl px-4
      mt-4 py-4 shadow-lg hover:shadow-2xl transition
      duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">
      {{old('body')}}
    </textarea>
        <x-button class="btnsetg float-right mr-4 mb-12 leading-5">
          コメントする
        </x-button>
      </form>
    </div>
    {{-- ↑コメント --}}
  </div>
</x-app-layout>
