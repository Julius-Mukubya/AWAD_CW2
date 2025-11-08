@extends('layouts.guest')

@section('content')
<main class="w-full">
    <!-- Hero Section -->
    <section class="w-full">
        <div class="@container">
            <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 items-center justify-center p-4 text-center"
                data-alt="Kampala boda boda riders on a busy street"
                style='background-image: linear-gradient(rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAmrUfO4yBAvAl9qVaZnnuB4zKDM62F4iI_RndonH9VTjlTd6fQMkDwwFYmqMKCWXRArC_R6zd9n86DhyD4m1k5Ifucyyn1uOnxO1BGFPKBhK6IJqBcDAbx5wO2wsz_nPKf9KApfeTBrxknou3mVfj5FZ10MhpbN7roIEfvPQU1pA8l6wQe3m5wFnWWuzjPah1tGV-gM6DgqGiGMU6X5YhangmXho5WUrD1l9YrthEC5Ca881z1alLgH0VpfAhfumavn8cF2q9tcRg");'>
                <div class="flex flex-col gap-4 max-w-3xl items-center text-center">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl">
                        About the Kampala Boda Boda Association
                    </h1>
                    <h2 class="text-white/90 text-sm font-normal leading-normal @[480px]:text-base">
                        Championing the rights, welfare, and professionalism of Boda Boda riders across Kampala.
                    </h2>
                    <!-- Centered CTA Button -->
                    <a href="#how-to-register"
                        class="mt-4 inline-flex min-w-[160px] max-w-[300px] w-full justify-center rounded-lg bg-yellow-500 text-white font-bold px-6 py-3 hover:bg-yellow-600 transition-colors">
                        Register Now
                    </a>
                </div>
            </div>
        </div>
    </section>


    <div class="px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto py-12 md:py-20">
        <!-- Who We Are Section -->
        <section class="mb-12 md:mb-20 text-center">
            <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-3 pt-5">
                Who We Are</h2>
            <p
                class="text-gray-700 dark:text-gray-300 text-base font-normal leading-relaxed pb-6 pt-1 max-w-3xl mx-auto">
                The Kampala Boda Boda Association (KBBA) is a member-driven organization dedicated to
                empowering riders. We provide a unified voice for advocacy, promote safety through training,
                and offer access to essential financial and legal services. Our mission is to
                professionalize the Boda Boda industry and improve the livelihoods of every member within
                our community.
            </p>
            <a href="#how-to-register"
                class="inline-block rounded-lg bg-yellow-500 text-white font-bold px-6 py-3 hover:bg-yellow-600 transition-colors">
                Join KBBA Today
            </a>
        </section>


        <!-- Benefits of Joining Section -->
        <section class="mb-12 md:mb-20">
            <h2
                class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-6 pt-5 text-center">
                Benefits of Joining</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="flex flex-col items-center text-center p-6 bg-white dark:bg-background-dark rounded-xl border border-gray-200 dark:border-gray-800">
                    <div
                        class="flex items-center justify-center size-12 mb-4 rounded-full bg-yellow-100 text-yellow-500">
                        <span class="material-symbols-outlined">gavel</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Legal Support</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Access to legal representation and advice for
                        work-related issues.</p>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-white dark:bg-background-dark rounded-xl border border-gray-200 dark:border-gray-800">
                    <div
                        class="flex items-center justify-center size-12 mb-4 rounded-full bg-yellow-100 text-yellow-500">
                        <span class="material-symbols-outlined">savings</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Financial Services</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Exclusive access to savings schemes, loans, and
                        insurance products.</p>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-white dark:bg-background-dark rounded-xl border border-gray-200 dark:border-gray-800">
                    <div
                        class="flex items-center justify-center size-12 mb-4 rounded-full bg-yellow-100 text-yellow-500">
                        <span class="material-symbols-outlined">health_and_safety</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Safety Training</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Regular training workshops on road safety and
                        first aid.</p>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-white dark:bg-background-dark rounded-xl border border-gray-200 dark:border-gray-800">
                    <div
                        class="flex items-center justify-center size-12 mb-4 rounded-full bg-yellow-100 text-yellow-500">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Community & Advocacy</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">A strong voice representing your interests to
                        local authorities.</p>
                </div>
            </div>
        </section>

        <!-- Registration Requirements Section -->
        <section class="mb-12 md:mb-20">
            <h2
                class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-6 pt-5 text-center">
                Registration Requirements</h2>
            <div class="space-y-4 max-w-2xl mx-auto">
                <details
                    class="group rounded-lg bg-white dark:bg-background-dark p-4 border border-gray-200 dark:border-gray-800 cursor-pointer">
                    <summary class="flex items-center justify-between font-bold text-gray-800 dark:text-gray-200">
                        Rider's Personal Documents
                        <span
                            class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                    </summary>
                    <ul class="mt-4 text-gray-600 dark:text-gray-400 text-sm list-disc pl-5 space-y-2">
                        <li>National ID Card</li>
                        <li>Valid Riding Permit</li>
                        <li>Two recent passport-sized photos</li>
                        <li>Letter from Local Council (LC1)</li>
                    </ul>
                </details>
                <details
                    class="group rounded-lg bg-white dark:bg-background-dark p-4 border border-gray-200 dark:border-gray-800 cursor-pointer">
                    <summary class="flex items-center justify-between font-bold text-gray-800 dark:text-gray-200">
                        Motorcycle Documents
                        <span
                            class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                    </summary>
                    <ul class="mt-4 text-gray-600 dark:text-gray-400 text-sm list-disc pl-5 space-y-2">
                        <li>Motorcycle Logbook (copy)</li>
                        <li>Valid Third-Party Insurance</li>
                    </ul>
                </details>
            </div>
        </section>

        <!-- Contact Us Section -->
        <section>
            <h2
                class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-8 pt-5 text-center">
                Contact Us</h2>
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white dark:bg-background-dark p-8 rounded-xl border border-gray-200 dark:border-gray-800">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Get in Touch</h3>
                    <div class="space-y-4 text-gray-600 dark:text-gray-400">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-yellow-500">location_on</span>
                            <span>123 Boda Boda Lane, Kampala, Uganda</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-yellow-500">call</span>
                            <span>+256 777 123 456</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-yellow-500">email</span>
                            <span>info@kbba.ug</span>
                        </div>
                    </div>
                </div>
                <div class="h-64 md:h-full w-full rounded-lg overflow-hidden">
                    <iframe allowfullscreen=""
                        data-alt="Google Map showing the location of the Kampala Boda Boda Association office."
                        data-location="Kampala, Uganda" height="100%" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127674.55168019014!2d32.5028509375833!3d0.3135439744432135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbc0f90fc921f%3A0x442881580133c91!2sKampala%2C%20Uganda!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
                        style="border:0;" width="100%"></iframe>
                </div>
            </div>
            <div class="text-center mt-12">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Ready to Join?</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Become a part of our growing community today!</p>
                <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-yellow-500 text-white text-base font-bold leading-normal tracking-[0.015em] mx-auto hover:bg-yellow-600 transition-colors">
                    <span class="truncate">Register Today!</span>
                </button>
            </div>
        </section>
    </div>
</main>
@endsection