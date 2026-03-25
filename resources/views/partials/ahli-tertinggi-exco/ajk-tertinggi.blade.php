@php
    $president = [
        'name' => 'TUAN SHAHRIL LIWANGSA',
        'role' => 'PRESIDEN',
        'image' => 'images/lelaki-pending.png',
        'posY' => '0'
    ];

    $timbalan = [
        'name' => 'TUAN ADENAN EMPI',
        'role' => 'TIMBALAN PRESIDEN',
        'image' => 'images/lelaki-pending.png',
        'posY' => '0'
    ];

    $naibPresidents = [
        ['name' => 'TUAN YUSDY ROSLE', 'role' => 'SETIAUSAHA AGUNG', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        ['name' => 'PUAN DG. JUANITA', 'role' => 'BENDAHARI AGUNG', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        
    ];


    $Setiausahas = [
        
    ];

    $bendaharis = [
        
    ];
@endphp

<!-- Peringkat Tertinggi (Pucuk Pimpinan) -->
<div class="mb-32">
    <div class="text-center mb-16">
        <h2 class="text-2xl md:text-3xl font-black text-primary uppercase tracking-widest inline-block border-b-4 border-secondary pb-2">
            AHLI JAWATANKUASA TERTINGGI
        </h2>
    </div>

    <!-- President (Centered) -->
    <div class="flex justify-center mb-20 animate-fade-in-up">
        <x-member-card 
            :name="$president['name']" 
            :role="$president['role']" 
            :image="$president['image']"
            :highlight="true"
            posX="center"
            :posY="$president['posY']"
        />
    </div>

    <!-- Timbalan Presiden (Centered) -->
    <div class="flex justify-center mb-20 animate-fade-in-up">
        <x-member-card 
            :name="$timbalan['name']" 
            :role="$timbalan['role']" 
            :image="$timbalan['image']"
            posX="center"
            :posY="$timbalan['posY']"
        />
    </div>

    <!-- Vice Presidents (Grid) -->
    <div class="{{ count($naibPresidents) == 3 ? 'grid grid-cols-3' : 'flex flex-row flex-nowrap justify-center' }} {{ count($naibPresidents) == 2 ? 'md:justify-between max-w-4xl mx-auto' : '' }} gap-2 md:gap-16 lg:gap-24 animate-fade-in-up delay-100">
        @foreach($naibPresidents as $naib)
            <x-member-card 
                :name="$naib['name']" 
                :role="$naib['role']" 
                :image="$naib['image']"
                posX="center"
                :posY="$naib['posY']"
            />
        @endforeach
    </div>

    

    <!--  Setiausaha (Grid) -->
    <div class="{{ count($Setiausahas) == 3 ? 'grid grid-cols-3' : 'flex flex-row flex-nowrap justify-center' }} {{ count($Setiausahas) == 2 ? 'md:justify-between max-w-4xl mx-auto' : '' }} gap-2 md:gap-16 lg:gap-24 mt-16 animate-fade-in-up delay-200">
        @foreach($Setiausahas as $penolong)
            <x-member-card 
                :name="$penolong['name']" 
                :role="$penolong['role']" 
                :image="$penolong['image']"
                posX="center"
                :posY="$penolong['posY']"
            />
        @endforeach
    </div>

    
</div>
