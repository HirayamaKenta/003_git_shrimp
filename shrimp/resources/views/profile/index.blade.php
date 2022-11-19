<x-app-layout>
  <x-slot name="header">
    User 一覧
  </x-slot>

  <div class=" md:max-w-7xl
  mx-auto px-4 sm:px-6 lg:px-8">
    <div class="my-6 ">
      <table class="text-left w-full border-collapse mt-8
                    overflow-x-auto block md:table">
        <tr class="bg-green-500">
          <th class="p-3 text-left text-white">ID</th>
          <th class="p-3 text-left text-white">name</th>
          <th class="p-3 text-left text-white">Email</th>
          <th class="p-3 text-left text-white">アバター</th>
          <th class="p-3 text-left text-white">編集</th>
          <th class="p-3 text-left text-white">削除</th>

        </tr>
        @foreach ($users as $user)
        <tr class="bg-white">
          <td class="border-gray-light
border hover:bg-gray-100 p-3">
            {{$user->id}}</td>
          <td class="border-gray-light
border hover:bg-gray-100 p-3">
            {{$user->name}}</td>
          <td class="border-gray-light
  border hover:bg-gray-100 p-3">
            {{$user->email}}</td>
          {{-- ↓avatarイメージ画像追加 --}}
          <td class="border-gray-light
      border hover:bg-gray-100 p-3">
            <div class="rounded-full w-12 h-12">
              <img class="h-14" src="
                @if($user->avatar!=='user_default.jpg')
                  {{asset('storage/images/'.$user->avatar)}}
                @else
                  {{asset('logo/user_default.jpg')}}
                @endif
                ">


            </div>
          </td>
          {{-- ↑avatarイメージ画像追加 --}}
          {{-- ↓ボタン追加--}}
          <td class="border-gray-light border hover:bg-gray-100 p-3">
            <a href="{{route('profile.edit', $user)}}">
              <x-button class="btnsetb">編集</x-button>
            </a>
          </td>
          <td class="border-gray-light border hover:bg-gray-100 p-3">
            <form method="post" action="{{route('profile.delete', $user)}}">
              @csrf
              @method('delete')
              <x-button class="btnsetr" onClick="return confirm('本当に削除しますか？');">削除</x-button>
            </form>
          </td>
          {{-- ↑ボタン追加 --}}
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</x-app-layout>
