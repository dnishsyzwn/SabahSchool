<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/stu-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/stu-logo.png') }}">
    <meta name="theme-color" content="#1a4731"> {{-- STU Green color --}}
    <title>@yield('title', 'Sabah Teachers Union (STU) | Kebajikan Guru Sabah')</title>

    <!-- Global SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Portal rasmi Sabah Teachers Union (STU). Memperjuangkan kebajikan guru & profesion perguruan di Sabah sejak 1962.')">
    <meta name="keywords" content="@yield('meta_keywords', 'STU, Sabah Teachers Union, Kesatuan Guru Sabah, Kebajikan Guru Sabah, Pendidikan Sabah')">
    <meta name="author" content="Sabah Teachers Union">
    <meta name="ahrefs-site-verification" content="d86dd6079e76f1d1dac4522b4eb5c8087376a4b041b35a971fccdecfd5e81a1e">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Sabah Teachers Union')">
    <meta property="og:description" content="@yield('meta_description', 'Membela nasib guru dan memperkasakan profesion perguruan di Sabah.')">
    <meta property="og:image" content="@yield('og_image', asset('images/stu-logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Sabah Teachers Union')">
    <meta property="twitter:description" content="@yield('meta_description', 'Membela nasib guru dan memperkasakan profesion perguruan di Sabah.')">
    <meta property="twitter:image" content="@yield('og_image', asset('images/stu-logo.png'))">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "Sabah Teachers Union",
      "alternateName": "STU",
      "url": "https://www.sabahteachersunion.com",
      "logo": "{{ asset('images/stu-logo.png') }}",
      "sameAs": [
        "https://www.facebook.com/sabahteachersunion",
        "https://twitter.com/stu_sabah"
      ],
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+6016 663 6752",
        "contactType": "customer service",
        "areaServed": "MY",
        "availableLanguage": ["Malay", "English"]
      }
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    @stack('styles')

    <!-- Ahrefs Analytics -->
    <script src="https://analytics.ahrefs.com/analytics.js" data-key="7g+CJcVLX59M0i0dTyTLcQ" async></script>
    <script>
      var ahrefs_analytics_script = document.createElement('script');
      ahrefs_analytics_script.async = true;
      ahrefs_analytics_script.src = 'https://analytics.ahrefs.com/analytics.js';
      ahrefs_analytics_script.setAttribute('data-key', '7g+CJcVLX59M0i0dTyTLcQ');
      document.getElementsByTagName('head')[0].appendChild(ahrefs_analytics_script);
    </script>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        @include('partials.navbar')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>


    @include('partials.footer')
    @include('partials.whatsapp-button')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
