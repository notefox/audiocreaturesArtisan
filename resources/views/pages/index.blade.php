<x-app-layout>
    <x-page.navigation/>

    <div class="section-heading-text" data-aos="fade-up">
        Index Page
    </div>

    @foreach($publishers as $publisher)
        <img src="{{ URL::asset($publisher->logo) }}">
    @endforeach

</x-app-layout>
