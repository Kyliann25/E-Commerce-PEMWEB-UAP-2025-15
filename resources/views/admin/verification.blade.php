<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Store Verification') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                
                @if($stores->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Store Name</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Owner</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Details</th>
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
                                            <p class="mb-1"><strong class="font-header uppercase text-xs">About:</strong> <span class="text-gray-600">{{ Str::limit($store->about, 50) }}</span></p>
                                            <p><strong class="font-header uppercase text-xs">Address:</strong> <span class="text-gray-600">{{ $store->address }}</span></p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex space-x-2">
                                                <form action="{{ route('admin.verification.approve', $store->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 border-2 border-transparent hover:bg-white hover:text-green-600 hover:border-green-500 transition-colors text-xs font-header font-bold uppercase">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.verification.reject', $store->id) }}" method="POST" onsubmit="return confirm('Reject and Delete Store?');">
                                                    @csrf
                                                    <button type="submit" class="bg-hubbub-pink text-white px-3 py-1 border-2 border-transparent hover:bg-white hover:text-hubbub-pink hover:border-hubbub-pink transition-colors text-xs font-header font-bold uppercase">Reject</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <p class="font-header text-xl font-bold uppercase text-gray-400">No pending verifications</p>
                        <p class="text-gray-500 mt-2">All stores are good to go.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
