<footer class="px-4 py-8 text-white bg-[#406e83] shadow md:px-8">
    <div class="max-w-7xl mx-auto text-center">

        <ul class="flex flex-wrap items-center justify-center gap-5 text-base font-bold">
            <li><a class="text-white hover:underline" href="{{ route('chart') }}">Chart</a></li> || 
            <li><a class="text-white hover:underline" href="{{ route('privacy-policy') }}">Privacy Policy</a></li> ||
            <li><a class="text-white hover:underline" href="{{ route('terms-conditions') }}">Terms &amp; Conditions</a></li> ||
            <li><a class="text-white hover:underline" target="_blank" href="https://wa.me/+917015916793">Connect</a></li>
        </ul>

        <hr class="my-3 border-white/70">

        <p class="text-sm md:text-base leading-relaxed text-white font-semibold">
            This website does not promote, support, or encourage any kind of gambling, betting, or Satta activities.
            All content available on this website is purely for entertainment and informational purposes only.
            Satta/Gambling may be illegal in your region. Users are advised to check their local laws before accessing
            any such content. We are not responsible for any financial loss or legal consequences.
        </p>

        <hr class="my-3 border-white/70">

        <p class="text-sm md:text-base font-bold text-white">
            © 2026 Super-7-Satta.com™ — All Rights Reserved.
        </p>

    </div>
</footer>

{{-- Fixed Play Button --}}
<a href="https://wa.me/919896916793"
   style="position:fixed;left:4px;bottom:35px;z-index:999999;width:70px;background:#D10B37;color:#fff;border:2px solid #fff;border-radius:10px;text-align:center;font-weight:700;font-size:14px;padding:18px 4px;text-decoration:none;box-shadow:0 4px 15px rgba(0,0,0,.35);">
    <i class="fa fa-arrow-down blink"></i><br>
    PLAY<br>Now
</a>

{{-- Fixed WhatsApp Button --}}
<a href="https://api.whatsapp.com/send/?phone=919896916793&text&type=phone_number&app_absent=0"
   target="_blank"
   style="position:fixed;right:12px;bottom:105px;z-index:999999;">
    <img src="{{ asset('wapp.webp') }}"
         alt="WhatsApp"
         style="width:82px;height:82px;object-fit:contain;filter:drop-shadow(0 4px 8px rgba(0,0,0,.4));">
</a>

{{-- Fixed Refresh Button --}}
<button type="button"
        onclick="window.location.reload();"
        title="Refresh page"
        aria-label="Refresh this page"
        style="position:fixed;right:22px;bottom:40px;z-index:999999;width:58px;height:58px;border-radius:50%;border:2px solid #1565C0;background:#fff;box-shadow:0 4px 15px rgba(0,0,0,.35);cursor:pointer;display:flex;align-items:center;justify-content:center;padding:0;">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
        <path fill="#1565C0"
              d="M17.65 6.35A7.958 7.958 0 0012 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.56 7.73-6h-2.08A5.99 5.99 0 0112 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z" />
    </svg>
</button>