<x-app-layout>
  <x-slot name="header">
    <p>
      「
      <span class="text-yellow-200">
      {{$user->name}}
      </span>
      」でログイン中2022/11/20
    </p>
    <div>
      <x-button class="ml-2 btnsetb" onclick="location.reload();">更新ボタン</x-button>
    </div>
  </x-slot>


  <div class="h-100 overflow-y-auto bg-indigo-400 rounded-xl" id="chat_area">

    @foreach ($chats as $chat)
      {{-- 第1if --}}
      @if($chat->message=="★1★2★3★4★5★6★7★")
      <p class="text-center text-xs mt-3">{{$chat->user->name}}</p>
      <div class="flex justify-center">
        <div>
          <img src="{{asset('storage/images/'.$chat->user->avatar)}}" class="h-12 pb-5 rounded-full">
        </div>
        <p class="text-xs text-center">{{$chat->updated_at->diffForHumans()}} に削除されたメッセージです。
                <br>投稿日:{{$chat->created_at}}</p>
      </div>
      {{-- 第1elseif --}}
      @elseif ($user->id==$chat->user->id)

      {{-- 第2if --}}
      @if($chat->message=="" && $chat->image=="")
      {{-- 第2elseif --}}
      @elseif($chat->message=="")
      <div class="flex items-center flex-row-reverse">
        <div><img src="{{ asset('storage/images/'.$chat->image)}}" class="ml-2 mr-auto max-h-28 mt-5
              border-2 borderml-1 inline border-lime-500">
        </div>
        <p class="text-xs text-right font-bold ml-1">
                      {{$chat->created_at}}<br>
                      {{$chat->created_at->diffForHumans()}}
                    </p>
      </div>
      <a href="{{route('chat.edit', $chat)}}">
        <x-button class="bg-red-600 float-right text-xs
                                          rounded-full" onClick="return confirm('本当に削除しますか？');">
          削除
        </x-button>
      </a>
      {{-- 第2else--}}
      @else
      <div class="flex mt-5 flex-row-reverse">
        <div>
          <img src="
          @if($chat->user->avatar!=='user_default.jpg')
                  {{asset('storage/images/'.$chat->user->avatar)}}
                @else
                  {{asset('logo/user_default.jpg')}}
                @endif
          " class="h-12 rounded-full">
        </div>
        <p class="ml-auto text-right mt-3 mr-1">
                                          <span class="bg-teal-200 rounded-full">
                                            {{$chat->user->name}}
                                          </span>
                                        </p>
      </div>
      <div class="flex">
        <div class="w-1/4 text-xs text-right mr-1 font-bold">
          {{$chat->created_at}}
          <br>
          {{$chat->created_at->diffForHumans()}}
        </div>
        <div class=" border-2 border-black
                              rounded-xl w-3/4 h-auto p-2 font-bold
                              ml-auto bg-teal-200">
          {{$chat->message}}
          {{-- 第3if--}}
          @if($chat->image!=="" && $chat->image!==null)
          <div>
            <img src="{{ asset('storage/images/'.$chat->image)}}" class="ml-auto max-h-28 border-2
                                    mr-1 mt-8">
          </div>
          {{-- 第3endif--}}
          @endif
        </div>
      </div>
      <div class="block">
        <a href="{{route('chat.edit', $chat)}}">
          <x-button class="bg-red-700 float-right text-xs
                              rounded-full" onClick="return confirm('本当に削除しますか？');">
            削除
          </x-button>
        </a>
      </div>
      {{--第2endif--}}
      @endif

      {{-- 第1else --}}
      @else

      {{-- 第2if --}}
      @if($chat->message=="" && $chat->image=="")
      {{-- 第2elseif --}}
      @elseif($chat->message=="")
      <div class="flex">
        <div>
          <img src="
          @if($chat->user->avatar!=='user_default.jpg')
                  {{asset('storage/images/'.$chat->user->avatar)}}
                @else
                  {{asset('logo/user_default.jpg')}}
                @endif
          " class="h-12 rounded-full">
        </div>
        <p class="mr-auto text-left mt-3 ml-1">
                              <span class="bg-white rounded-2xl">
                                {{$chat->user->name}}
                              </span>
                            </p>
      </div>
      <div class="flex items-center">
        <div><img src="{{ asset('storage/images/'.$chat->image)}}"
            class="ml-2 mr-auto max-h-28 border-2 borderml-1 inline">
        </div>
        <p class="text-xs text-left font-bold ml-1">
                      {{$chat->created_at}}<br>
                      {{$chat->created_at->diffForHumans()}}
                    </p>
      </div>

      {{-- 第2else--}}
      @else
      <div class="flex mt-5">
        <div>
          <img src="
          @if($chat->user->avatar!=='user_default.jpg')
                  {{asset('storage/images/'.$chat->user->avatar)}}
                @else
                  {{asset('logo/user_default.jpg')}}
                @endif
          " class="h-12 rounded-full">
        </div>
        <p class="mr-auto text-left mt-3 ml-1">
                                  <span class="bg-white rounded-2xl">
                                    {{$chat->user->name}}
                                  </span>
                                </p>
      </div>
      <div class="flex flex-row-reverse items-center">
        <div class="w-1/4 text-xs text-left ml-1 font-bold">
          {{$chat->created_at}}
          <br>
          {{$chat->created_at->diffForHumans()}}
        </div>
        <div class=" border-2 border-black
                                    rounded-xl w-3/4 h-auto p-2 font-bold
                                    ml-auto bg-white ">
          {{$chat->message}}
          {{-- 第3if--}}
          @if($chat->image!=="" && $chat->image!==null)
          <div>
            <img src="{{ asset('storage/images/'.$chat->image)}}" class="mr-auto max-h-28
                                        ml-1 mt-3">
          </div>
          {{-- 第3endif--}}
          @endif
        </div>
      </div>

      {{--第2endif--}}
      @endif

      {{-- 第1endif --}}
      @endif
    @endforeach
    <p id="chatEnd" class="pb-20 mt-2 text-center text-xs font-bold">
      -- ここが最新です({{date("Y年m月d日 H時i分")}})--
    </p>
  </div>

  <hr>
  <form action="{{route('chat.store')}}" method="post" enctype="multipart/form-data"
  class="fixed bottom-0 right-0  w-screen">
  @csrf

    <input type="text" class="w-full md:w-1/2 md:block md:mx-auto
              border-4 border-black rounded-xl" name="message">
    <div class="flex items-center justify-end mt-1 md:w-1/2 md:mx-auto">
      <label for="image"
      class="border border-black mr-3
      w-1/3 md:w-auto
      text-xs md:text-base text-white bg-slate-900 rounded-xl px-2
hover:border-slate-900 hover:bg-white hover:text-slate-900">
      画像ファイルを選択してください。
    </label>
        <input type="file" name="image" id="image"
        class="hidden">
        <span class="select-image w-1/3 text-xs md:text-base
      h-4 md:h-auto text-black md:text-white mr-1 px-2">
          選択されていません
        </span>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
$('input').on('change', function () {
//propを使って、file[0]にアクセスする
var file = $(this).prop('files')[0];
//text()で要素内のテキストを変更する
$('.select-image').text(file.name);
});
        </script>
      <x-button class="btnsetg md:mb-3 md:inline-block">
        送信
      </x-button>
    </div>
  </form>

  <script>
    window.addEventListener('DOMContentLoaded', function() {
      let chatArea = document.getElementById('chat_area'),
      chatAreaHeight = chatArea.scrollHeight;
      chatArea.scrollTop = chatAreaHeight;
    })
  </script>

</x-app-layout>
