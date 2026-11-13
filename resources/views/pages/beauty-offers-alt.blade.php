@extends('layouts.app')

@section('title', __('meta.beauty_offers'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- MAIN CANVAS -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- 3. BREADCRUMBS -->
<nav aria-label="{{ __('ui.breadcrumb') }}" class="py-space-md">
<ol class="flex items-center gap-space-xs font-label-caps text-label-caps text-on-surface-variant tracking-wider uppercase">
<li>
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
</li>
<li class="select-none text-outline">/</li>
<li aria-current="page" class="text-primary font-bold">{{ __('ui.beauty_offers') }}</li>
</ol>
</nav>
<!-- 4. PAGE HEADER & QUICK FILTER CHIPS -->
<section class="pb-space-xl pt-2">
<div class="border-b border-outline-variant pb-space-lg">
<h1 class="font-headline-lg text-headline-lg md:text-display-hero text-primary tracking-tight">{{ __('ui.beauty_offers') }}</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mt-space-xs max-w-2xl">
          {{ __('content.t_f1e42d39ae8d') }}
        </p>
<!-- Filter Chips (0px geometry, crisp hairline outline) -->
<div class="flex items-center gap-space-xs md:gap-space-sm flex-wrap mt-space-lg pt-space-xs">
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-4 py-2 border border-primary transition-colors duration-150" type="button">
            {{ __('ui.all_offers_count_19') }}
          </button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">{{ __('ui.fragrance') }}</button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">{{ __('ui.makeup') }}</button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">{{ __('ui.skincare') }}</button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">
            {{ __('ui.haircare') }}
          </button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">
            {{ __('content.t_289b65242e3b') }}
          </button>
</div>
</div>
</section>
<!-- 5. BEAUTY OFFERS CARDS GRID (19 REAL PROMOTIONAL OFFERS) -->
<section class="pb-space-xl">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-gutter">
<!-- CARD 1: NUXE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_997a83199bc3') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/glow_recipe_watermelon_glow_niacinamide_dew_drops_pink_glass_serum_bottle.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">NUXE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_f2e1a3b51c56') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_b8ac711d9d86') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 2: TARTE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_6fac05672434') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/l_occitane_en_provence_shea_butter_ultra_rich_body_cream_luxury_silver_lid_tin.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">TARTE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_ef2430595af4') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_f6cff8b12ce5') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 3: NARCISO RODRIGUEZ -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_c3b5755aacdc') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/gisou_honey_infused_hair_oil_luxury_glass_dropper_bottle_with_golden_honey_oil.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">{{ __('content.t_3f10fb00303d') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_c39c79d5a28d') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_c22ffa2e02c2') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 4: RABANNE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_9e0abc7f3a18') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/sephora_brow_bar_by_benefit_or_beauty_consultation_service_expert_brow_styling.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">RABANNE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_ac29f01d5338') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_546b3c3d56a8') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 5: PRADA -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_49e245ec6fb4') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/modern_luxury_sephora_beauty_flagship_store_interior_sleek_monochrome_black_and.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">PRADA</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_d42bcea15f43') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_1655829cb40b') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 6: NARS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_54da51eacfac') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_bottle_of_kayali_vanilla_28_or_yum_pistachio_gelato_perfume_high_end.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">NARS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_7f847b69061c') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_288de05847f3') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 7: ELEMIS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_ff277e51b30e') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_smartphone_mockup_showing_sephora_mobile_beauty_shopping_app_interface.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">ELEMIS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_a4ca41843d23') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_7c8563bd6b69') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 8: COLOR WOW -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_26ad688b6ef2') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/maison_francis_kurkdjian_baccarat_rouge_540_eau_de_parfum_bottle_iconic_red.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">{{ __('content.t_0b95d626b4f2') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_267712ed71b5') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_1e4d6af1ba9e') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 9: TATCHA -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_dffd959f4022') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_black_and_white_striped_sephora_gift_card_on_an_elegant_sleek_marble.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">TATCHA</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_40660270f230') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_9d9c20737ddb') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 10: MILK MAKEUP -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_e99ac5366638') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/natasha_denona_glam_or_bronze_eyeshadow_palette_open_showing_shimmering.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">{{ __('content.t_2dcd5b8905c1') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_e99ac5366638') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_ba47277f321c') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 11: BIODANCE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_efc53bc76afe') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">BIODANCE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_b2425f1ea042') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_9d669643c766') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 12: CLARINS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_82d6521cbfb4') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_beauty_services_at_sephora_professional_makeup_artist_applying_glam.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">CLARINS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_8c7d038ef13d') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_2acefaf3248d') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 13: HOURGLASS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_005e01b1bda5') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/ouai_st__barts_body_cleanser_luxury_minimalist_bottle_with_pump_clean_studio.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">HOURGLASS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_55ab9143a9a5') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_f06b5914702b') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 14: GUCCI -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_8fb0c223a256') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/k18_leave_in_molecular_repair_hair_mask_white_pump_bottle_with_pink_accent_high.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">GUCCI</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_64d429444fc6') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_97737a7dc563') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 15: HUDA BEAUTY -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_6b771411420f') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/maison_francis_kurkdjian_baccarat_rouge_540_eau_de_parfum_bottle_iconic_red.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">{{ __('content.t_d6675db98e96') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_e73ea0294738') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_624970367667') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 16: CAROLINA HERRERA -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="{{ __('content.t_91f13b7b3c28') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/natasha_denona_glam_or_bronze_eyeshadow_palette_open_showing_shimmering.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">{{ __('content.t_046c1d9503bb') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_53f69c2fc447') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_8b8a9ed35190') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 17: BENEFIT -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_80fc37782f1b') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/qr_code_mockup_for_downloading_mobile_app_with_elegant_sephora_minimalist.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">BENEFIT</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_dac65c9decae') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_6c60b1e57731') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 18: URBAN DECAY -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_1e47a893f4f1') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/sephora_skincare_consultation_and_custom_beauty_bar_high_tech_skin_diagnostics.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">{{ __('content.t_6a8278fe00c8') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_3db3ec1369e4') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_99279c73b91c') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 19: LANCÔME -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">{{ __('content.t_37bddd5c3e6b') }}</span>
<img alt="{{ __('content.t_e246d5790983') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/yves_saint_laurent_libre_eau_de_parfum_bottle_studio_e_commerce_beauty_product.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">{{ __('content.t_070fb3f5c3c6') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">{{ __('content.t_5d82d6caf9f9') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_68cef1937c6b') }}</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
</div>
</section>
<!-- 6. TRUST BADGES BAR -->
<section class="border-t border-b border-outline-variant py-space-xl my-space-xl">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter text-center lg:text-left">
<!-- Pillar 1 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">local_shipping</span>
<div>
<h3 class="font-title-md text-title-md text-primary">{{ __('ui.free_delivery') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_22d686abca9c') }}</p>
</div>
</div>
<!-- Pillar 2 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">verified</span>
<div>
<h3 class="font-title-md text-title-md text-primary">{{ __('ui.authentic') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_fb19e07117e9') }}</p>
</div>
</div>
<!-- Pillar 3 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">store</span>
<div>
<h3 class="font-title-md text-title-md text-primary">{{ __('content.t_b11cfb0e8504') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_a98242354516') }}</p>
</div>
</div>
<!-- Pillar 4 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">card_membership</span>
<div>
<h3 class="font-title-md text-title-md text-primary">{{ __('ui.beauty_pass_points') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_7fa7c6495809') }}</p>
</div>
</div>
</div>
</section>
<!-- 7. NEWSLETTER SECTION -->
<section class="py-space-xl mb-space-xl bg-surface-container-low border border-outline-variant p-space-lg text-center">
<div class="max-w-xl mx-auto flex flex-col items-center gap-space-sm">
<span class="material-symbols-outlined text-[28px] text-primary">mail</span>
<h2 class="font-headline-sm text-headline-sm text-primary">{{ __('content.t_f8db767a3f5b') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant">
          {{ __('content.t_c2497f7e7000') }}
        </p>
<form class="w-full flex flex-col sm:flex-row gap-2 mt-4" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="flex-1 bg-surface-container-lowest border border-outline px-4 py-3 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary placeholder:text-on-surface-variant rounded-none" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps px-8 py-3 tracking-widest transition-colors duration-200" type="submit">
            {{ __('content.t_1e0c8c669c5f') }}
          </button>
</form>
</div>
</section>
</main>
<!-- 8. FOOTER (SHARED COMPONENT EXECUTION) -->
@endsection
