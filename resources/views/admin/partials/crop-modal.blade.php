{{-- 
    Shared Image Cropping Modal for STU Admin Dashboard.
    Requires: Cropper.js, heic2any (optional for HEIC support).
--}}
<div id="crop-modal" class="fixed inset-0 z-[1000] bg-black/90 backdrop-blur-md items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
            <h3 class="font-bold text-gray-800 text-sm italic tracking-tight">Kekemasan Visual</h3>
            <div id="crop-queue-info" class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md">PROSES</div>
        </div>
        <div class="bg-gray-100 flex items-center justify-center" style="height:380px;">
            <img id="crop-target" src="" alt="" style="max-height:360px; max-width:100%;">
        </div>
        <div class="px-6 py-4 bg-white border-t flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-1.5 p-1 bg-gray-50 rounded-xl" id="crop-ratios">
                <button type="button" class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent bg-white shadow-sm hover:translate-y-[-1px] transition" data-ratio="NaN">Bebas</button>
                <button type="button" class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent text-gray-400 hover:text-gray-600 transition" data-ratio="1.777">16:9</button>
                <button type="button" class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent text-gray-400 hover:text-gray-600 transition" data-ratio="1.333">4:3</button>
                <button type="button" class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent text-gray-400 hover:text-gray-600 transition" data-ratio="1">1:1</button>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" id="btn-crop-cancel" class="px-5 py-2.5 text-xs font-bold text-gray-500 hover:text-gray-700 transition">Batal</button>
                <button type="button" id="btn-crop-skip" class="px-5 py-2.5 text-xs font-bold bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Asal</button>
                <button type="button" id="btn-crop-done" class="px-6 py-2.5 text-xs font-black bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 transition shadow-md">POTONG</button>
            </div>
        </div>
    </div>
</div>

<style>
    #crop-modal.open { display: flex !important; }
</style>
