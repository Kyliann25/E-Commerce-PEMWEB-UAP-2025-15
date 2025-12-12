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


            </div>
        </div>
    </div>
</x-app-layout>
