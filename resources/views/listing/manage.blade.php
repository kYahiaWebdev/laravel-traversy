@extends('layout')
@section('content')


<x-card class="p-10">
   <header>
      <h1 class="text-3xl text-center font-bold my-6 uppercase">
         Manage Projects
      </h1>
   </header>

   <table class="w-full table-auto rounded-sm">
      <tbody>

         @unless (count($listings) == 0)
         @foreach ($listings as $listing)
            <tr class="border-gray-300">
               <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <a href="/listing/{{$listing->id}}">
                     {{$listing->title}} - <span class="font-bold">{{$listing->company}}</span>
                  </a>
               </td>
               <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <a href="/listing/{{$listing->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i>
                     Edit</a>
               </td>
               <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <form action="/listing/{{$listing->id}}" method="post">
                     @csrf
                     @method('DELETE')
         
                     <button class="text-red-600">
                        <i class="fa-solid fa-trash-can"></i>
                        Delete
                     </button>
                  </form>
               </td>
            </tr>
         @endforeach

         @else
            <tr class="border-gray-300">
               <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <p class="text-center">No project found for this user</p>
               </td>
            </tr>
             
         @endunless

         
      </tbody>
   </table>
</x-card>


@endsection