<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Wish! | Bday.io</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Fredoka:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Scripts & Styles -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#FBBF24", // Bold yellow
                        secondary: "#6ee7b7", // Teal-ish
                        accent: "#F472B6", // Pink for extra pop
                        "background-light": "#FFFBEB",
                        "background-dark": "#18181b",
                        "surface-light": "#ffffff",
                        "surface-dark": "#27272a",
                    },
                    fontFamily: {
                        display: ["'Fredoka'", "sans-serif"],
                        body: ["'Space Mono'", "monospace"],
                    },
                    boxShadow: {
                        'neo': '5px 5px 0px 0px #000000',
                        'neo-sm': '2px 2px 0px 0px #000000',
                        'neo-hover': '2px 2px 0px 0px #000000',
                        'neo-lg': '8px 8px 0px 0px #000000',
                    },
                    borderWidth: {
                        '3': '3px',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                },
            },
        };
    </script>
    <style>
        body {
            /* Hide content until GSAP loads to prevent flash */
            visibility: hidden;
            min-height: 100vh;
            /* Changed from 100dvh for better compatibility */
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #000;
            border: 2px solid #FFFBEB;
            border-radius: 20px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #fff;
            border-color: #18181b;
        }

        .neo-input:focus {
            outline: none;
            box-shadow: 4px 4px 0px 0px #000000;
            transform: translate(-4px, -4px);
        }

        .neo-button:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px #000000;
        }

        /* Smooth reveal class */
        .reveal-item {
            opacity: 0;
            transform: translateY(30px);
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-body text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center relative selection:bg-primary selection:text-black">

    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-5%] w-64 h-64 bg-secondary rounded-full border-3 border-black opacity-10 animate-float"
            style="animation-duration: 8s;"></div>
        <div class="absolute bottom-[10%] left-[5%] w-40 h-40 bg-accent rounded-full border-3 border-black opacity-10 animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute top-[20%] right-[-5%] w-56 h-56 bg-primary rounded-full border-3 border-black opacity-10 animate-float"
            style="animation-delay: 1s;"></div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 32px 32px; opacity: 0.05;">
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-lg relative z-10 w-full" id="main-container">

        <!-- Header / Logo Area (Simplified, No Menu) -->
        <div class="text-center mb-40 relative z-10 reveal-item">
            <div
                class="inline-flex items-center space-x-3 mb-6 bg-white dark:bg-zinc-800 px-6 py-2 rounded-full border-3 border-black shadow-neo-sm transform -rotate-2 hover:rotate-0 transition-transform duration-300">
                <div class="w-8 h-8 bg-primary rounded-full border-2 border-black flex items-center justify-center">
                    <span class="material-icons-round text-black text-sm">cake</span>
                </div>
                <span class="font-display font-bold text-xl tracking-wide">Bday.io</span>
            </div>

            <div class="relative inline-block">
                <h1
                    class="font-display font-black text-5xl md:text-6xl mb-2 text-black dark:text-white tracking-tight leading-none">
                    Make a <br /><span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent decoration-4 underline decoration-black underline-offset-4">Wish!</span>
                </h1>

                <!-- Floating Star Icon -->
                <svg class="absolute -top-8 -right-8 w-14 h-14 text-primary animate-bounce" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                </svg>
            </div>

            <p class="text-base text-gray-600 dark:text-gray-400 mt-4 font-bold max-w-xs mx-auto">
                Craft the perfect greeting card in seconds. <br />✨ Premium & Elegant ✨
            </p>
        </div>

        <!-- Card Form Container -->
        <div class="relative reveal-item">
            <!-- Decorative Mascot/Icon atop Form -->
            <div
                class="absolute -top-16 left-1/2 transform -translate-x-1/2 w-28 h-28 z-20 pointer-events-none floating-icon">
                <svg class="w-full h-full drop-shadow-2xl filter" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" fill="#FBBF24" r="42" stroke="black" stroke-width="3">
                    </circle>
                    <g class="eyes">
                        <circle cx="35" cy="45" fill="black" r="6"></circle>
                        <circle cx="65" cy="45" fill="black" r="6"></circle>
                    </g>
                    <path d="M 40 65 Q 50 75 60 65" fill="none" class="mouth" stroke="black" stroke-linecap="round"
                        stroke-width="3"></path>
                    <!-- Party Hat -->
                    <path d="M 30 15 L 50 -15 L 70 15" fill="#6ee7b7" stroke="black" stroke-width="3"
                        stroke-linejoin="round"></path>
                    <circle cx="50" cy="-15" r="5" fill="#F472B6" stroke="black" stroke-width="3"></circle>
                </svg>
            </div>

            <div
                class="bg-surface-light dark:bg-surface-dark border-3 border-black dark:border-white rounded-3xl p-8 pt-16 shadow-neo dark:shadow-[8px_8px_0px_0px_#ffffff] relative z-10">
                <form class="space-y-6" id="create-card-form" enctype="multipart/form-data">
                    @csrf
                    <!-- Sender Number -->
                    <div class="space-y-2 group">
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-200 group-focus-within:text-green-500 transition-colors">
                            Sender Number (WhatsApp)
                        </label>
                        <div class="relative">
                            <input
                                class="w-full bg-white dark:bg-gray-800 border-2 border-black dark:border-gray-500 rounded-xl px-4 py-3 focus:ring-0 focus:border-black dark:focus:border-white transition-all neo-input placeholder-gray-400 dark:placeholder-gray-600 text-lg font-display"
                                placeholder="e.g. 628123456789" type="text" name="sender_number" required />
                            <span
                                class="absolute right-4 top-3.5 text-gray-400 group-focus-within:text-black dark:group-focus-within:text-white transition-colors">
                                <span class="material-icons-round text-2xl">whatsapp</span>
                            </span>
                        </div>
                    </div>

                    <!-- Recipient -->
                    <div class="space-y-2 group">
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-200 group-focus-within:text-primary transition-colors">
                            Who is it for?
                        </label>
                        <div class="relative">
                            <input
                                class="w-full bg-white dark:bg-gray-800 border-2 border-black dark:border-gray-500 rounded-xl px-4 py-3 focus:ring-0 focus:border-black dark:focus:border-white transition-all neo-input placeholder-gray-400 dark:placeholder-gray-600 text-lg font-display"
                                placeholder="e.g. Budi, Sarah" type="text" name="recipient_name" required />
                            <span
                                class="absolute right-4 top-3.5 text-gray-400 group-focus-within:text-black dark:group-focus-within:text-white transition-colors">
                                <span class="material-icons-round text-2xl">face</span>
                            </span>
                        </div>
                    </div>

                    <!-- Age -->
                    <div class="space-y-2 group">
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-200 group-focus-within:text-secondary transition-colors">
                            Turning Age
                        </label>
                        <div class="relative">
                            <input
                                class="w-full bg-white dark:bg-gray-800 border-2 border-black dark:border-gray-500 rounded-xl px-4 py-3 focus:ring-0 focus:border-black dark:focus:border-white transition-all neo-input placeholder-gray-400 dark:placeholder-gray-600 text-lg font-display"
                                placeholder="25" type="number" name="age" required />
                            <span
                                class="absolute right-4 top-3.5 text-gray-400 group-focus-within:text-black dark:group-focus-within:text-white transition-colors">
                                <span class="material-icons-round text-2xl">cake</span>
                            </span>
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div class="space-y-2">
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-200">
                            Add a Photo (Optional)
                        </label>
                        <label
                            class="w-full bg-gray-50 dark:bg-gray-900 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl px-4 py-8 flex flex-col items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-gray-800 hover:border-black dark:hover:border-white transition-all group relative overflow-hidden">
                            <input accept="image/*" class="hidden" type="file" name="photo" id="photo-input" />
                            <div
                                class="absolute inset-0 bg-secondary opacity-0 group-hover:opacity-5 transition-opacity">
                            </div>
                            <span
                                class="material-icons-round text-4xl mb-2 text-gray-400 group-hover:text-primary group-hover:scale-110 transition-transform duration-300"
                                id="photo-icon">add_a_photo</span>
                            <span
                                class="text-sm font-display font-bold text-gray-500 dark:text-gray-400 group-hover:text-black dark:group-hover:text-white"
                                id="photo-text">Upload sweet memory</span>
                            <span class="text-xs text-green-600 font-bold hidden" id="photo-success">Photo
                                Selected!</span>
                        </label>
                    </div>

                    <!-- Wish -->
                    <div class="space-y-2 group">
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-200 group-focus-within:text-accent transition-colors">
                            Special Wish
                        </label>
                        <textarea
                            class="w-full bg-white dark:bg-gray-800 border-2 border-black dark:border-gray-500 rounded-xl px-4 py-3 focus:ring-0 focus:border-black dark:focus:border-white transition-all neo-input placeholder-gray-400 dark:placeholder-gray-600 text-base font-body resize-none"
                            placeholder="Write something sweet or funny..." rows="3" name="message" required></textarea>
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center space-x-4 py-2 opacity-50">
                        <div class="h-0.5 bg-black dark:bg-white flex-grow rounded-full"></div>
                        <span class="material-icons-round text-sm animate-spin-slow">star</span>
                        <div class="h-0.5 bg-black dark:bg-white flex-grow rounded-full"></div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        class="w-full bg-primary hover:bg-yellow-300 text-black border-3 border-black rounded-xl py-4 font-display font-bold text-xl uppercase tracking-wider shadow-neo hover:shadow-neo-hover active:shadow-none transition-all flex items-center justify-center space-x-3 group neo-button relative overflow-hidden"
                        type="submit" id="submit-btn">
                        <span class="relative z-10">Create Card</span>
                        <span
                            class="material-icons-round relative z-10 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        <!-- Button Glare Effect -->
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity">
                        </div>
                    </button>

                    <div id="result-area"
                        class="hidden mt-4 bg-green-100 border-2 border-green-500 text-green-800 p-4 rounded-xl text-center">
                        <p class="font-bold mb-2">Card Created Successfully! 🎉</p>
                        <input type="text" readonly id="share-link"
                            class="w-full bg-white border border-green-500 rounded px-2 py-1 text-sm mb-2" />
                        <a href="" id="open-link" target="_blank"
                            class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-green-600 transition">View
                            Card</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer Tip -->
        <div class="mt-12 text-center reveal-item">
            <div
                class="inline-flex items-center justify-center space-x-2 bg-white/80 dark:bg-zinc-800/80 backdrop-blur-sm border-2 border-black/10 dark:border-white/20 rounded-full px-5 py-2 hover:scale-105 transition-transform cursor-help">
                <span class="material-icons-round text-secondary text-base">tips_and_updates</span>
                <span class="text-xs font-bold text-gray-600 dark:text-gray-300">Tip: Upload a funny photo!</span>
            </div>
            <p class="mt-8 text-[10px] text-gray-400 uppercase tracking-widest">Designed with ❤️ for DigitalProud</p>
        </div>
    </main>

    <!-- Side Decoration Removed as per user feedback -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Make body visible now
            document.body.style.visibility = 'visible';

            gsap.registerPlugin();

            const tl = gsap.timeline({
                defaults: {
                    ease: "back.out(1.7)",
                    duration: 1
                }
            });

            // 1. Initial Scale & Fade of the Main Container elements
            tl.fromTo(".reveal-item", {
                opacity: 0,
                y: 50,
                scale: 0.95
            }, {
                opacity: 1,
                y: 0,
                scale: 1,
                stagger: 0.15
            });

            // 2. Animate the 'Floating Item' (Mascot) specifically
            tl.fromTo(".floating-icon", {
                    y: -100,
                    opacity: 0,
                    rotation: -45
                }, {
                    y: "-4rem",
                    opacity: 1,
                    rotation: 0,
                    ease: "elastic.out(1, 0.5)",
                    duration: 1.5
                },
                "-=1.0"
            );

            // 3. Eye Movement (Subtle interaction)
            const eyes = document.querySelectorAll('.eyes circle');
            document.addEventListener('mousemove', (e) => {
                const x = (window.innerWidth / 2 - e.pageX) / 50;
                const y = (window.innerHeight / 2 - e.pageY) / 50;
                eyes.forEach(eye => {
                    gsap.to(eye, {
                        x: -x,
                        y: -y,
                        duration: 0.2,
                        ease: "power1.out"
                    });
                });
            });

            // 4. Input Focus Animation Helpers
            const inputs = document.querySelectorAll('.neo-input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    gsap.to(input, {
                        scale: 1.02,
                        duration: 0.2
                    });
                });
                input.addEventListener('blur', () => {
                    gsap.to(input, {
                        scale: 1,
                        duration: 0.2
                    });
                });
            });

            // Photo Input Handling
            const photoInput = document.getElementById('photo-input');
            photoInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    document.getElementById('photo-text').classList.add('hidden');
                    document.getElementById('photo-icon').classList.add('hidden');
                    document.getElementById('photo-success').classList.remove('hidden');
                }
            });

            // Form Handling
            const form = document.getElementById('create-card-form');
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btn = document.getElementById('submit-btn');
                const originalText = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML =
                    '<span class="material-icons-round animate-spin">refresh</span> Processing...';

                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ route('greeting.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        const resultArea = document.getElementById('result-area');
                        const shareLink = document.getElementById('share-link');
                        const openLink = document.getElementById('open-link');

                        shareLink.value = data.redirect_url;
                        openLink.href = data.redirect_url;

                        resultArea.classList.remove('hidden');

                        // Scroll to result
                        gsap.to(window, {
                            duration: 1,
                            scrollTo: "#result-area"
                        });

                        btn.innerHTML = '<span>Created!</span>';
                    } else {
                        alert('Something went wrong. Please check your inputs.');
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    }
                } catch (error) {
                    console.error(error);
                    alert('Error submitting form.');
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            });
        });
    </script>
</body>

</html>
