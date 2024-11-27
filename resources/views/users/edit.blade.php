<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Users / Edit
      </h2>
      <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md  text-white px-3 py-2">Back</a>
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    <div>
                      <label for="name" class="text-lg font-medium">Name</label>
                      <div class="my-3">
                        <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-dark-300 text-black"
                                name="name" id="name" placeholder="Enter Name" value="{{ old('name', $user->name) }}">
                        @error('name')
                          <p class="text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                      </div>
                      <label for="emaili" class="text-lg font-medium">Email</label>
                      <div class="my-3">
                        <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-dark-300 text-black"
                                name="email" id="email" placeholder="Enter Email" value="{{ old('email', $user->email) }}">
                        @error('email')
                          <p class="text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="grid grid-cols-4 mb-3">
                        @if ($roles->isNotEmpty())
                          @foreach ($roles as $role)
                            <div class="mt-3">
                               <input {{ $hasRoles->contains($role->id) ? 'checked' : '' }} type="checkbox" class="rounded" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}">
                              <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                          @endforeach
                        @endif

                      </div>
                      <button class="bg-slate-700 text-sm rounded-md hover:bg-slate-600  text-white px-5 py-3">Update</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
