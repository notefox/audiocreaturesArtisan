<x-app-layout>
    <x-page.navigation/>

    <div class="section-heading-text" data-aos="fade-up">
        Index Page
    </div>

    @foreach($images as $image)
        <img src="{{ asset('storage/' . $image) }}" alt="image">
    @endforeach

</x-app-layout>
