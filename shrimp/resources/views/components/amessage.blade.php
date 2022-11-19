@props(['message'])
@if (isset($message))
<div class="border px-4 py-3
rounded relative
border-green-400text-green-700">
  {{$message}}
</div>
@endif
