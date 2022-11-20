<x-guest-layout>
<hr class="border-lime-500 border-b-4">

<div class="md:flex md:flex-row-reverse md:items-center
md:justify-center
            md:mt-36" >

<div class="mt-16 md:w-2/5">
  <img src="{{asset('logo/shrimp.png')}}"
  class="w-10/12 md:w-auto block mx-auto md:h-60">
</div>

      {{-- ↓ボタン設定 --}}
      <div class="md:w-2/5">
        <p class="text-5xl md:text-8xl font-bold ">
          <span class="text-red-600">★</span>Shrimp<span class="text-red-600">★</span>
        </p>
        <p>チャットアプリ</p>
      <p>最終更新日 2022/11/18(金)</p>
      <p>こちらのアプリはLaravel9をもちいまして、チャットができるようなアプリを作りました。</p>
<div class="w-10/12 block mx-auto mt-6">
        <a href="{{route('login')}}">
          <x-button class="btnsetb">
            ログイン
          </x-button>
        </a>
        </div>

        <div class="w-10/12 block mx-auto my-5">
        <a href="{{route('register')}}">
          <x-button class="btnsetg">
            ご登録はこちら
          </x-button>
        </a>
      </div>
    </div>
      {{-- ↑ボタン設定 --}}


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
        @2022 Shrimp by Hirayama
      </p>
  </div>
</div>
</div>
{{--↑プライバシーポリシーとcopyright --}}



</x-guest-layout>
