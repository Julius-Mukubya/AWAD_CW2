@extends('layouts.guest')

@section('content')
<!-- Hero Section -->
<div class="relative rounded-none overflow-hidden my-0 w-full">
    <div class="absolute inset-0 z-0">
        <img alt="Boda bodas in Kampala" class="h-full w-full object-cover"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDbh5bzStfzY6OjMS5zvarQZjcVLzyHjYEB43EPtnKSoNa4VSfrTbBAvKnvQTyta9s73K2yYcDnaQo7ovU97coAZx_6WrDD2VpjbUVi6ytsghz1kjg1qzH6S8lBd2DjVvAyJwEb7_8PtMoXWhok4DjB73jZyLFCXdIxcXB0qL_i0fr_zSikD5tVw2_6na6HMFE6YAKs0aXgMd2Gma5tXuRkrDvLIJwq4yaAMgMxjKUaV03hg2IyZiBeTe03EOi4ARC4--ax2Gs-z1A" />
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    <div class="relative z-10 py-24 md:py-32 text-center">
        <div class="flex flex-col items-center gap-6 px-4">
            <div class="flex flex-col gap-4 text-center max-w-2xl mx-auto">
                <h1 class="text-4xl font-black leading-tight tracking-[-0.033em] md:text-5xl lg:text-6xl text-white">
                    Join the Official Kampala Boda Boda Network
                </h1>
                <h2 class="text-base font-normal leading-normal md:text-lg text-gray-200">
                    Register to gain legitimacy, safety, community support, and access to valuable
                    resources.
                </h2>
            </div>
            <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-secondary text-gray-900 text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                <span class="truncate">Register Now</span>
            </button>
        </div>
    </div>
</div>

<!-- Stats Section (Yellow Theme) -->
<div class="flex flex-col items-center justify-center p-6 w-full bg-background-light">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-7xl">

        <!-- Card 1 -->
        <div
            class="flex flex-col items-start gap-4 rounded-xl p-6 bg-white shadow-md border border-yellow-100 hover:shadow-lg transition">
            <div class="flex items-center justify-center size-12 rounded-lg bg-yellow-100 text-yellow-600">
                <span class="material-symbols-outlined text-3xl">groups</span>
            </div>
            <div class="flex flex-col gap-1">
                <p class="text-base font-medium text-gray-600">Total Riders</p>
                <p class="tracking-tight text-3xl font-extrabold text-gray-900">5,000+</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div
            class="flex flex-col items-start gap-4 rounded-xl p-6 bg-white shadow-md border border-yellow-100 hover:shadow-lg transition">
            <div class="flex items-center justify-center size-12 rounded-lg bg-yellow-100 text-yellow-600">
                <span class="material-symbols-outlined text-3xl">pin_drop</span>
            </div>
            <div class="flex flex-col gap-1">
                <p class="text-base font-medium text-gray-600">Active Stages</p>
                <p class="tracking-tight text-3xl font-extrabold text-gray-900">150+</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div
            class="flex flex-col items-start gap-4 rounded-xl p-6 bg-white shadow-md border border-yellow-100 hover:shadow-lg transition">
            <div class="flex items-center justify-center size-12 rounded-lg bg-yellow-100 text-yellow-600">
                <span class="material-symbols-outlined text-3xl">verified_user</span>
            </div>
            <div class="flex flex-col gap-1">
                <p class="text-base font-medium text-gray-600">Approved Riders</p>
                <p class="tracking-tight text-3xl font-extrabold text-gray-900">4,800+</p>
            </div>
        </div>

    </div>
</div>

<!-- About Section (Matching Yellow Theme with Icon) -->
<section class="py-16 bg-background-light">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <div class="bg-white p-10 rounded-xl shadow-md border border-yellow-100 hover:shadow-lg transition">
            <!-- Icon -->
            <div class="flex items-center justify-center text-yellow-500 text-5xl mb-6">
                <i class="fa-solid fa-users"></i>
            </div>
            <!-- Heading -->
            <h2 class="text-3xl font-bold text-black-600 mb-4">Who We Are</h2>
            <!-- Description -->
            <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
                The <span class="font-semibold text-black-700">Kampala Boda Boda Association
                    (KBBA)</span> unites riders
                across the city to promote professionalism, safety, and empowerment.
                We collaborate with local authorities and community stakeholders to enhance road
                safety,
                improve rider welfare, and advance digital inclusion for a smarter transport
                ecosystem.
            </p>
        </div>
    </div>
</section>


<!-- Programs Section -->
<section class="py-16 bg-background-light">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-black mb-10">Our Programs & Initiatives
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-yellow-500 text-4xl mb-4">
                    <i class="fa-solid fa-helmet-safety"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Rider Safety Training</h3>
                <p class="text-gray-600 text-sm">Regular safety workshops to ensure every rider is
                    equipped with defensive riding and first-aid skills.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-yellow-500 text-4xl mb-4">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Digital Rider Registration</h3>
                <p class="text-gray-600 text-sm">Creating a verified digital database of all riders
                    for accountability and transparency.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-yellow-500 text-4xl mb-4">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Partnerships & Support</h3>
                <p class="text-gray-600 text-sm">Collaborating with local government, NGOs, and
                    sponsors to empower riders economically and socially.</p>
            </div>
        </div>
    </div>
</section>

<!-- Join Us CTA -->
<section class="relative py-16 text-center text-gray-900">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDbh5bzStfzY6OjMS5zvarQZjcVLzyHjYEB43EPtnKSoNa4VSfrTbBAvKnvQTyta9s73K2yYcDnaQo7ovU97coAZx_6WrDD2VpjbUVi6ytsghz1kjg1qzH6S8lBd2DjVvAyJwEb7_8PtMoXWhok4DjB73jZyLFCXdIxcXB0qL_i0fr_zSikD5tVw2_6na6HMFE6YAKs0aXgMd2Gma5tXuRkrDvLIJwq4yaAMgMxjKUaV03hg2IyZiBeTe03EOi4ARC4--ax2Gs-z1A"
            alt="Boda bodas in Kampala" class="h-full w-full object-cover" />
        <div class="absolute inset-0 bg-black/60"></div> <!-- overlay for contrast -->
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-4 text-white">Be Part of the Change</h2>
        <p class="text-lg mb-8 text-gray-200">
            Join thousands of riders making Kampala’s transport system safer and stronger.
        </p>
        <button class="bg-secondary text-gray-900 px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition">
            Become a Member
        </button>
    </div>
</section>

@endsection