<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>

        <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
            @foreach($data as $index => $item)
            <div class="item">
                <img src="{{ asset('storage/doctor_images/' . basename($item->foto)) }}" alt="Doctor Image">
                <div class="carousel-caption">
                    <h3>{{ $item->name }}</h3>
                    <p>{{ $item->spesialis }}</p> <!-- Display specialization -->
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>