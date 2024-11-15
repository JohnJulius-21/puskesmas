@extends('user.layouts.main')

@section('container')
<section id="hero" style="height: auto; background: url('/assets/img/hero-image.jpg') no-repeat center center; background-size: cover;">
    <div class="container position-relative">
        <div class="welcome position-relative aos-init aos-animate" 
            style="padding: 2.5rem; border-radius: 0.5rem; text-align: center;" 
            data-aos="fade-down" data-aos-delay="100">
            
            <div style="display: flex; flex-direction: column; align-items: center; margin-top: 10vh;"> 
                <h2 style="color: white; font-size: 50px; margin-bottom: 5px;">Daftar Konsultasi Medis Anda dengan</h2>
                <h2 style="color: white; font-size: 50px; margin: 0;">Mudah dan Cepat.</h2>
                
                <h2 style="color: white; font-size: 18px; font-weight: 400; margin-top: 10px;">
                    Kami siap melayani Anda dengan profesional dan penuh perhatian. 
                </h2>
                
                <h2 style="color: white; font-size: 18px; font-weight: 400; margin: 0;">
                    Kesehatan Anda adalah prioritas kami, dan kami hadir untuk mendampingi perjalanan kesehatan Anda.
                </h2>
                        
                <div style="text-align: center; margin-top: 10vh;"> <!-- Adjusted for mobile with vh -->
                    <a href="/konsultasi" class="btn btn-primary" 
                        style="display: inline-flex; align-items: center; justify-content: center; 
                               padding: 1rem 2rem; font-size: 1.5rem; 
                               border-radius: 2rem; background-color: #007bff; color: white; 
                               text-decoration: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
                               transition: background-color 0.3s, transform 0.3s;">
                        <span>Daftar Konsultasi</span> <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
                
                @guest
                <div style="margin-top: 20px; color: white; font-size: 12px; display: flex; align-items: center;">
                    <img src="/assets/img/exclamation.png" alt="Warning Icon" style="width: 16px; height: 16px; margin-right: 5px;">
                    <span>Harap login dulu sebelum membuat konsultasi</span>
                </div>
                @endguest
            </div>
        </div>
    </div><!-- End Content-->
</section>


@endsection
{{-- 
<script>
    // Cek status login dari localStorage
    const isLoggedIn = localStorage.getItem('isLoggedIn'); // misalnya status login tersimpan di sini

    // Jika user sudah login, sembunyikan pesan peringatan
    if (isLoggedIn === 'true') {
        document.getElementById('login-warning').style.display = 'none';
    }
</script> --}}
