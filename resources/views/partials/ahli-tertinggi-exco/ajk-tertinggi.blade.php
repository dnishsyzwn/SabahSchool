@php
    $president = [
        'name' => 'TUAN HAJI SAHILEH BIN HAJI BAKAR',
        'role' => 'PRESIDEN',
        'image' => 'images/lelaki-pending.png',
        'posY' => '0'
    ];

    $timbalan = [
        'name' => 'TUAN HJ. MOHD. NAJIB BIN HJ. MOHAMAD',
        'role' => 'TIMBALAN PRESIDEN',
        'image' => 'images/lelaki-pending.png',
        'posY' => '0'
    ];

    $naibPresidents = [
        ['name' => 'TUAN HJ. JAINI BIN HJ. TUKIMAN', 'role' => 'NAIB PRESIDEN I', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        ['name' => 'TUAN HJ. ABD. RAZAK BIN HJ. ABD. LATIP', 'role' => 'NAIB PRESIDEN II', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        ['name' => 'PUAN HJH. SITI KHADIJAH BINTI HJ. IBRAHIM', 'role' => 'NAIB PRESIDEN III', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
    ];

    $setiausahaAgung = [
        'name' => 'TUAN HJ. MOHD. NAJIB BIN HJ. MOHAMAD',
        'role' => 'SETIAUSAHA AGUNG',
        'image' => 'images/lelaki-pending.png',
        'posY' => '0'
    ];

    $penolongSetiausahas = [
        ['name' => 'TUAN HJ. MOHD. NAJIB BIN HJ. MOHAMAD', 'role' => 'PENOLONG SETIAUSAHA I', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        ['name' => 'TUAN HJ. ISMAIL BIN HJ. SALLEH', 'role' => 'PENOLONG SETIAUSAHA II', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        ['name' => 'PUAN HJH. NORLIZA BINTI HJ. OTHMAN', 'role' => 'PENOLONG SETIAUSAHA III', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
    ];

    $bendaharis = [
        ['name' => 'TUAN HJ. MOHD. NAJIB BIN HJ. MOHAMAD', 'role' => 'BENDAHARI AGUNG', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        ['name' => 'TUAN HJ. ISMAIL BIN HJ. SALLEH', 'role' => 'PENOLONG BENDAHARI I', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
        ['name' => 'PUAN HJH. NORLIZA BINTI HJ. OTHMAN', 'role' => 'PENOLONG BENDAHARI II', 'image' => 'images/lelaki-pending.png', 'posY' => '0'],
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-16 lg:gap-24 animate-fade-in-up delay-100">
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

     <!-- SETIAUSAHA AGUNG (Centered) -->
    <div class="flex justify-center mt-16 mb-20 animate-fade-in-up">
        <x-member-card 
            :name="$setiausahaAgung['name']" 
            :role="$setiausahaAgung['role']" 
            :image="$setiausahaAgung['image']"
            posX="center"
            :posY="$setiausahaAgung['posY']"
        />
    </div>

    <!-- Penolong Setiausaha (Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-16 lg:gap-24 mt-16 animate-fade-in-up delay-200">
        @foreach($penolongSetiausahas as $penolong)
            <x-member-card 
                :name="$penolong['name']" 
                :role="$penolong['role']" 
                :image="$penolong['image']"
                posX="center"
                :posY="$penolong['posY']"
            />
        @endforeach
    </div>

    <!-- Bendaharis (Grid) -->
     <div class="grid grid-cols-1 md:grid-cols-3 gap-16 lg:gap-24 mt-16 animate-fade-in-up delay-200">
        @foreach($bendaharis as $bendahari)
            <x-member-card 
                :name="$bendahari['name']" 
                :role="$bendahari['role']" 
                :image="$bendahari['image']"
                posX="center"
                :posY="$bendahari['posY']"
            />
        @endforeach
    </div>
</div>
