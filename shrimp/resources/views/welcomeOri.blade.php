<x-guest-layout>
  <div class="container  md:px-32
  flex flex-col md:flex-row items-center
  bg-teal-50 mx-auto justify-between">
    {{-- ↓左側 --}}
    <div class="md:w-3/5">
      <h1 class="my-4 text-3xl md:text-5xl text-stone-800
        font-bold leading-tight text-center
        md:text-left slide-in-bottom-h1">
        app learn
      </h1>
      <p class="leading-normal text-base md:text-2xl
      mb-8 text-center md:text-left
      slide-in-bottom-subtitle">
                Laravel学習の作成物です。
            </p>

      <p class="text-blue-400 font-bold pb-8 lg:pb-6
      text-center md:text-left fade-in">
                初期画面 最終更新日 2022/11/03
            </p>
      {{-- ↓ボタン設定 --}}
      <div class="md:flex w-full justify-center
      md:justify-start md:pb-8 fade-in">
        <a href="{{route('login')}}">
          <x-button class="btnsetb">
            ログイン
          </x-button>
        </a>
        <a href="{{route('register')}}">
          <x-button class="btnsetg">
            ご登録はこちら
          </x-button>
        </a>
      </div>
      <div class="text-center md:text-left">
        <a href="{{route('contact.create')}}" class="text-center">
          <x-button class=" mt-14 ml-10">
            お問い合わせ
          </x-button>
        </a>
      </div>
      {{-- ↑ボタン設定 --}}
    </div>
    {{-- ↑左側 --}}

    {{-- ↓右側 --}}
    <div class="w-full md:w-2/5 py-6">
      <img class="w-5/6 mx-auto slide-in-bottom
      rounded-lg shadow-xl" src="{{asset('logo/goodBoy.png')}}">
    </div>
    {{-- ↑右側 --}}
  </div>

  {{-- ↓プライバシーポリシーとcopyright --}}
  </div>
  <div class="container pt-10 md:pt-18 px-6 mx-auto
  flex flex-wrap flex-col md:flex-row items-center">
    <div class="w-full text-sm text-center
    md:text-left fade-in border-2 p-4 text-red-800
    leading-8 mb-8">
      <P> プライバシーポリシーを記述します。<br>
        ユーザーの情報を責任をもって正しく扱うことを記述します。</p>
    </div>
    <!--フッタ-->
    <div class="w-full pt-10 pb-6 text-sm
    md:text-left fade-in">
      <p class="text-gray-500 text-center">
        @2022 app learn by Hirayama
      </p>
    </div>
  </div>
  </div>
  {{--↑プライバシーポリシーとcopyright --}}
</x-guest-layout>
