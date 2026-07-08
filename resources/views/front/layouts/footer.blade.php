<footer class="px-6 py-10 text-white bg-[#406e83] shadow-lg md:px-12">
    <div class="max-w-7xl mx-auto text-center">

        <!-- Links with proper spacing -->
        <ul class="flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-base font-semibold tracking-wide">
            <li><a class="text-white/90 hover:text-white hover:underline transition-colors" href="{{ route('chart') }}">Chart</a></li>
            <li><a class="text-white/90 hover:text-white hover:underline transition-colors" href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
            <li><a class="text-white/90 hover:text-white hover:underline transition-colors" href="{{ route('terms-conditions') }}">Terms &amp; Conditions</a></li>
            <li><a class="text-white/90 hover:text-white hover:underline transition-colors" target="_blank" href="https://wa.me/+917015916793">Connect</a></li>
        </ul>

        <hr class="my-6 border-white/20">

        <!-- Disclaimer Text -->
        <p class="text-sm md:text-base leading-relaxed text-white/80 max-w-4xl mx-auto font-medium">
            This website does not promote, support, or encourage any kind of gambling, betting, or Satta activities.
            All content available on this website is purely for entertainment and informational purposes only.
            Satta/Gambling may be illegal in your region. Users are advised to check their local laws before accessing
            any such content. We are not responsible for any financial loss or legal consequences.
        </p>

        <hr class="my-6 border-white/20">

        <!-- Copyright -->
        <p class="text-xs md:text-sm font-medium text-white/70 tracking-wider">
            © 2026 Super-7-Satta.com™ — All Rights Reserved.
        </p>

    </div>
</footer>

{{-- Fixed Play Button --}}
<a href="https://wa.me/919896916793"
   style="position:fixed; left:16px; bottom:35px; z-index:999999; width:75px; background:#D10B37; color:#fff; border:2px solid #fff; border-radius:12px; text-align:center; font-weight:700; font-size:13px; padding:15px 4px; text-decoration:none; box-shadow:0 8px 24px rgba(209,11,55,.4); transition: transform 0.2s;"
   onmouseover="this.style.transform='scale(1.05)'" 
   onmouseout="this.style.transform='scale(1)'">
    <i class="fa fa-arrow-down blink" style="margin-bottom: 4px; display: inline-block;"></i><br>
    PLAY<br>NOW
</a>

{{-- Fixed WhatsApp Button --}}
<a href="https://api.whatsapp.com/send/?phone=919896916793&text&type=phone_number&app_absent=0"
   target="_blank"
   style="position:fixed; right:16px; bottom:115px; z-index:999999; transition: transform 0.2s;"
   onmouseover="this.style.transform='scale(1.08)'" 
   onmouseout="this.style.transform='scale(1)'">
    <img src="{{ asset('wapp.webp') }}"
         alt="WhatsApp"
         style="width:72px; height:72px; object-fit:contain; filter:drop-shadow(0 6px 12px rgba(0,0,0,.3));">
</a>

{{-- Fixed Refresh Button --}}
<button type="button"
        onclick="window.location.reload();"
        title="Refresh page"
        aria-label="Refresh this page"
        style="position:fixed; right:23px; bottom:40px; z-index:999999; width:58px; height:58px; border-radius:50%; border:none; background:#ffffff; box-shadow:0 6px 20px rgba(0,0,0,.2); cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; transition: transform 0.2s, background-color 0.2s;"
        onmouseover="this.style.transform='scale(1.05)'; this.style.background='#f5f5f5';" 
        onmouseout="this.style.transform='scale(1)'; this.style.background='#ffffff';">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
        <path fill="#1565C0"
              d="M17.65 6.35A7.958 7.958 0 0012 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.56 7.73-6h-2.08A5.99 5.99 0 0112 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z" />
    </svg>
</button>