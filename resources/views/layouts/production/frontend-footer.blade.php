<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center" height="100">
                    <img src="{{ asset('assets/media/logos/logo.png') }}" alt="Logo">
                </a>
                <div class="pt-3 footer-contact">
                    <p>Kenya Bankers Centre,</p>
                    <p>3rd Ngong Avenue, Upper Hill, Nairobi</p>
                    <p class="mt-3">
                        <strong>Email:</strong>
                        <span> info@psychoafrica.co.ke </span>
                    </p>
                    <p>
                        <strong>Phone:</strong>
                        <span>+254719184616, +254719184651, +254719184857</span>
                    </p>
                </div>
                <div class="mt-4 social-links d-flex">
                    {{-- <a href="#"><i class="bi bi-twitter-x"></i></a> --}}
                    <a href="https://wa.me/+254719184616"><i class="bi bi-whatsapp"></i></a>
                    {{-- <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a> --}}
                </div>
            </div>

            <div class="col-lg-3 col-md-4 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about-us') }}">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 footer-links">
                <h4>Our Services</h4>
                <ul>
                    @forelse ($serviceCategories as $serviceCategory)
                        <li>
                            <a href="{{ route('service-category.show', $serviceCategory) }}" target="_blank">
                                {{ $serviceCategory->name }}
                            </a>
                        </li>
                    @empty
                        <li><a href="#">No Services Categories Available</a></li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-4 text-center copyright">
        <p> © <span>{{ date('Y') }}</span> <strong class="px-1 sitename">{{ env('APP_NAME') }},</strong>
            <span>All Rights Reserved</span>
        </p>
    </div>
</footer>
