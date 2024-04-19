@php
$image = Vite::asset('resources/assets/images/avatar.jpg');
@endphp
<div class="card-container px-3 ">
    <div class="card-wrap rounded-xl overflow-hidden border p-10 flex flex-col gap-12">
        <div class="card-header bg-cover bg-center w-full flex flex-col items-center gap-2">
            <div class="card-avatar">
                <img src="{{$image}}" alt="" class="h-16 w-16 rounded-full">
            </div>
            <div class="card-title text-center">
                <h2 class="font-Poppins font-semibold text-xl">M. Husni Mubarok</h2>
                <h4 class="font-Inter text-lg">Ketua RW 01</h4>
            </div>
        </div>
        <div class="card-body flex flex-col gap-2 items-center text-center">
            <p class="">“Dengan adanya website ini, sangat membantu kami dalam menjalankan berbagai aktivitas administrasi yang ada di lingkungan ini. Harapan saya semoga website ini dapat membantu seluruh masyarakat RW 01 Landungsari dalam menunjang kebutuhan administrasi mereka.”</p>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>