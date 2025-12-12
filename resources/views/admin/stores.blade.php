<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Manage Stores') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Store Details</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Owner</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Status</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Joined</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stores as $store)
                                <tr class="hover:bg-pink-50 transition-colors">
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="font-header font-bold uppercase text-lg text-hubbub-black">{{ $store->name }}</div>
                                        <div class="text-xs text-gray-500 font-sans uppercase tracking-wide">{{ $store->city }}</div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="font-bold text-gray-900">{{ $store->user->name }}</div>
                                        <span class="text-xs text-gray-500 font-mono">{{ $store->user->email }}</span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        @if($store->is_verified)
                                            <span class="px-2 py-1 text-xs font-header font-bold uppercase leading-5 text-green-800 bg-green-100 rounded-sm">Verified</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-header font-bold uppercase leading-5 text-yellow-800 bg-yellow-100 rounded-sm">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm font-sans text-gray-500">
                                        {{ $store->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this store? This will also delete all products associated with it.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold font-header uppercase text-xs">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200 bg-gray-50">
                    {{ $stores->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
