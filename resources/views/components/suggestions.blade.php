@php
    $suggestions = [
        ['username' => 'dian_photoworks', 'name' => 'Dian Larasati'],
        ['username' => 'budi_explorer', 'name' => 'Budi Santoso'],
        ['username' => 'citra_art', 'name' => 'Citra Dewi'],
    ];
@endphp

<aside class="hidden lg:flex flex-col gap-4 h-fit sticky top-6">

    <div class="bg-white border border-[#76838F]/30 rounded-2xl p-4 shadow-md">
        <div class="flex items-center justify-between mb-4">
            <p class="text-md font-bold tracking-wide text-[#0A2947]/50">SARAN PENGGUNA</p>
            <button type="button" class="text-xs font-medium text-[#76ABAE] hover:text-[#5CADB1]">Lihat Semua</button>
        </div>

        <div class="flex flex-col gap-3">
            @foreach ($suggestions as $user)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-[#76ABAE] p-0.5">
                            <div class="w-full h-full rounded-full bg-[#ECF0F3]"></div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-[#0A2947]">&#64;{{ $user['username'] }}</p>
                            <p class="text-xs text-[#0A2947]/50">{{ $user['name'] }}</p>
                        </div>
                    </div>

                    <button type="button"
                        class="text-xs font-semibold text-[#76ABAE] hover:text-[#5CADB1]">Ikuti</button>
                </div>
            @endforeach
        </div>
    </div>

</aside>
