@php
    $excos = [
        ['name' => 'AHLI 1', 'role' => 'EXCO PANTAI BARAT'],
        ['name' => 'AHLI 2', 'role' => 'EXCO PEDALAMAN'],
        ['name' => 'AHLI 3', 'role' => 'EXCO SANDAKAN'],
        ['name' => 'AHLI 4', 'role' => 'EXCO TAWAU'],
        ['name' => 'AHLI 5', 'role' => 'EXCO KUDAT'],
        ['name' => 'AHLI 6', 'role' => 'EXCO BEAUFORT'],
        ['name' => 'AHLI 7', 'role' => 'EXCO RANAU'],
        ['name' => 'AHLI 8', 'role' => 'EXCO KENINGAU'],
    ];
@endphp

<!-- Exco Sections -->
<div class="mb-20">
    <div class="text-center mb-20">
        <h2 class="text-2xl md:text-3xl font-black text-primary uppercase tracking-widest inline-block border-b-4 border-secondary pb-2">
            AHLI JAWATANKUASA EXCO (BAHAGIAN)
        </h2>
        <p class="mt-4 text-gray-400 font-bold uppercase tracking-widest text-xs">
            Mewakili Setiap Bahagian Di Seluruh Sabah
        </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-20 animate-fade-in-up">
        @foreach($excos as $index => $exco)
            <div class="animate-fade-in-up" style="animation-delay: {{ ($index + 1) * 100 }}ms">
                <x-member-card 
                    :name="$exco['name']" 
                    :role="$exco['role']" 
                    image="images/lelaki-pending.png"
                    posX="center"
                    posY="0"
                />
            </div>
        @endforeach
    </div>
</div>
