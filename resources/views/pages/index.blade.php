<x-app-layout>
    <x-page.navigation/>

    <div class="section-heading-text" data-aos="fade-up">
        Index Page
    </div>

    <pre class="text-white">
        @foreach($images as $image)
            <img src="{{ $image->alt()->absolute_path() }}" alt="{{ $image->alt()->absolute_path() }}">
        @endforeach
    </pre>
</x-app-layout>
