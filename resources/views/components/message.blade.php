@if (Session::has('success'))
<div class="bg-green-200 border-green-6OO p-4 rounded-sm shadow-sm">
  {{ Session::get('success') }}
</div>
@endif

@if (Session::has('error'))
<div class="bg-red-200 border-red-6OO p-4 rounded-sm shadow-sm">
  {{ Session::get('error') }}
</div>
@endif