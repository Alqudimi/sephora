@php
    $cookieChoice = request()->cookie('cookie_consent') ?? session('cookie_consent');
@endphp

@if (! in_array($cookieChoice, ['accepted', 'declined'], true))
    <div id="cookie-banner" role="dialog" aria-label="Cookie preferences"
         class="fixed inset-x-0 bottom-0 z-[100] bg-black text-white border-t border-gray-800">
        <div class="max-w-[1440px] mx-auto px-4 md:px-8 py-4 flex flex-col lg:flex-row lg:items-center gap-4">
            <p class="font-body-sm text-body-sm text-gray-300 flex-1">
                We use essential cookies to run the store and optional cookies to remember your
                preferences and measure performance. Read our
                <a class="underline text-white hover:text-gray-300" href="{{ route('terms') }}">Privacy Policy</a>.
            </p>
            <div class="flex flex-wrap gap-2 shrink-0">
                <form method="POST" action="{{ route('consent.cookies') }}">
                    @csrf
                    <input name="choice" type="hidden" value="declined">
                    <button class="h-10 px-5 border border-gray-600 text-white font-label-caps text-label-caps uppercase tracking-wider hover:border-white transition-colors" type="submit">
                        Decline optional
                    </button>
                </form>
                <form method="POST" action="{{ route('consent.cookies') }}">
                    @csrf
                    <input name="choice" type="hidden" value="accepted">
                    <button class="h-10 px-5 bg-white text-black font-label-caps text-label-caps uppercase tracking-wider hover:bg-gray-200 transition-colors" type="submit">
                        Accept all
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif
