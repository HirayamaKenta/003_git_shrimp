<x-app-layout>
  <x-slot name="header">
    コメントした投稿の一覧
  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  @if (count($comments)==0)
  <p class="mt-4">
      あなたはまだコメントしてません。
    </p>
  @else
  @foreach ($comments->unique("post_id") as $comment)
  @php
  //↓ コメントをした投稿
  $post=$comment->post;
  //↑コメントをした投稿
  @endphp
  <a href="{{route('post.show',$post)}}">
    <div class="mx-4 sm:p-8">
      <div class="mt-4">
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
              font-semibold hover:underline cursor-pointer
              float-left pt-2 md:pl-5">
                {{ $post->title }}
              </h1>
            </div>
            <hr class="w-full">
            <p class="mt-4 text-gray-600 py-4">
              {{-- {{$post->body}} --}}
              {{-- ↓100文字以下は...で表す --}}
              {{Str::limit($post->body,100,"...")}}
              {{-- ↑100文字以下は...で表す --}}
            </p>
            {{-- ↓画像出力コード --}}
            @if ($post->image)
            <div>
              {{-- (画像ファイル：{{$post->image}}) --}}
            </div>
            <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
            @endif
            {{-- ↑画像出力コード --}}
            <div class="text-sm font-semibold
            flex flex-row-reverse">
              <p>{{$post->user->name ?? "削除されたユーザー"}} •
                {{$post->created_at->diffForHumans()}}
              </p>
            </div>
            {{-- ↓バッジ追加 --}}
            <hr class="w-full mb-2">
            @if ($post->comments->count())
            <span class="badge">
              返信 {{$post->comments->count()}}件
            </span>
            @else
            <span class="text-xs">コメントはまだありません。</span>
            @endif
            <a href="{{route('post.show', $post)}}" style="color:white;">
              <x-button class="float-right btnsetg">
                コメントする
              </x-button>
            </a>
            {{-- ↑バッジ追加 --}}
          </div>
        </div>
      </div>
    </div>
  </a>
  @endforeach
  @endif
</x-app-layout>
