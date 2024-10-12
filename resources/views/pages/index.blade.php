<x-app-layout>
    <x-page.navigation/>

    <div class="section-heading-text" data-aos="fade-up">
        Index Page
    </div>

    <div class="text-white">
        @foreach($images as $image)
            <img src="{{ $image->alt('large')->absolute_path() }}" alt="{{ $image->alt()->absolute_path() }}">
        @endforeach
    </div>
</x-app-layout>
