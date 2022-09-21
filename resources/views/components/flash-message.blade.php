@if (session()->has('message'))
   <div class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3"
   x-data="{open: true}" x-show="open" x-init="setTimeout(()=> open = false, 3000)">
      <p>{{session('message')}}</p>
   </div>
@endif