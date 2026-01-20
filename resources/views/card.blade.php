<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Happy Birthday {{ $data->recipient_name }}!</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Fredoka:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"></script>
    <!-- Confetti for extra pop -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        body {
            overscroll-behavior: none;
            touch-action: manipulation;
            font-family: 'Space Mono', monospace;
        }

        .font-display {
            font-family: 'Fredoka', sans-serif;
        }

        .card-stage {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s;
        }

        .hidden-stage {
            opacity: 0;
            pointer-events: none;
            z-index: -1;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            cursor: pointer;
            animation: floatUp 4s linear forwards;
        }

        @keyframes floatUp {
            to {
                transform: translateY(-120vh) rotate(360deg);
            }
        }

        .tap-hint {
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 20px rgba(251, 191, 36, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(251, 191, 36, 0);
            }
        }

        .choice-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px #000000;
        }
    </style>
</head>

<body class="bg-zinc-900 text-white overflow-hidden h-screen w-screen">

    <!-- STAGE 1: THE GIFT -->
    <div id="stage-1" class="card-stage z-40 bg-yellow-50">
        <div class="text-center relative">
            <p class="text-black mb-8 font-bold text-lg animate-bounce">Tap to Open for {{ $data->recipient_name }}! 🎁
            </p>
            <div id="gift-box"
                class="w-48 h-48 bg-red-500 border-4 border-black rounded-xl relative cursor-pointer shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] tap-hint active:scale-95 transition-transform flex items-center justify-center">
                <!-- Ribbon -->
                <div class="absolute inset-x-0 top-1/2 h-8 bg-yellow-400 border-y-4 border-black -translate-y-1/2">
                </div>
                <div class="absolute inset-y-0 left-1/2 w-8 bg-yellow-400 border-x-4 border-black -translate-x-1/2">
                </div>
                <span class="material-icons-round text-6xl text-white z-10 drop-shadow-lg">card_giftcard</span>
            </div>
            <p class="mt-8 text-xs text-gray-400">Views: {{ $data->current_views }}/{{ $data->max_views }}</p>
        </div>
    </div>

    <!-- STAGE 2: BUBBLE POP GAME -->
    <div id="stage-2" class="card-stage z-30 bg-blue-400 hidden-stage overflow-hidden">
        <div class="absolute inset-0 pointer-events-none flex items-center justify-center">
            <h2 class="text-4xl font-display font-black text-white drop-shadow-[4px_4px_0_#000] z-0 opacity-50">POP THE
                BUBBLES!</h2>
        </div>
        <!-- Bubbles injected by JS -->
    </div>

    <!-- STAGE 2.5: DIALOG & AVATAR -->
    <div id="stage-dialog" class="card-stage z-20 bg-pink-300 hidden-stage p-4">
        <div class="max-w-md w-full flex flex-col items-center">
            <!-- AVATAR -->
            <div id="avatar-container" class="w-32 h-32 mb-6 relative">
                <svg class="w-full h-full drop-shadow-[4px_4px_0_#000]" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" fill="#FBBF24" r="45" stroke="black" stroke-width="3">
                    </circle>
                    <!-- Eyes -->
                    <g class="eyes">
                        <circle cx="35" cy="45" fill="black" r="6"></circle>
                        <circle cx="65" cy="45" fill="black" r="6"></circle>
                    </g>
                    <!-- Mouth -->
                    <path id="avatar-mouth" d="M 35 60 Q 50 75 65 60" fill="none" stroke="black"
                        stroke-linecap="round" stroke-width="3"></path>
                    <!-- Cheeks -->
                    <circle cx="25" cy="55" r="4" fill="#F472B6" opacity="0.6"></circle>
                    <circle cx="75" cy="55" r="4" fill="#F472B6" opacity="0.6"></circle>
                </svg>
            </div>

            <!-- DIALOG BOX -->
            <div
                class="bg-white border-4 border-black rounded-2xl p-6 shadow-[8px_8px_0px_0px_#000] w-full text-black relative">
                <!-- Speech Bubble Arrow -->
                <div
                    class="absolute -top-4 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[15px] border-l-transparent border-r-[15px] border-r-transparent border-b-[15px] border-b-black">
                </div>
                <div
                    class="absolute -top-[11px] left-1/2 -translate-x-1/2 w-0 h-0 border-l-[11px] border-l-transparent border-r-[11px] border-r-transparent border-b-[11px] border-b-white">
                </div>

                <p id="dialog-text"
                    class="font-display font-bold text-lg min-h-[3.5rem] whitespace-pre-wrap tracking-wide">...</p>

                <!-- CHOICES CONTAINER -->
                <div id="choices-container" class="mt-4 flex flex-col space-y-3 hidden">
                    <!-- Buttons injected by JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- STAGE 3: THE REVEAL -->
    <div id="stage-3" class="card-stage z-10 bg-yellow-400 hidden-stage p-6">
        <div
            class="max-w-md w-full bg-white text-black border-4 border-black rounded-3xl p-6 shadow-[10px_10px_0px_0px_#000000] relative transform rotate-1">

            <!-- Confetti Canvas -->
            <canvas id="canvas" class="absolute inset-0 w-full h-full pointer-events-none z-50"></canvas>

            <div class="text-center">
                <!-- Age Badge -->
                <div
                    class="absolute -top-6 -right-6 bg-red-500 text-white border-4 border-black w-20 h-20 rounded-full flex items-center justify-center font-display font-bold text-2xl shadow-[4px_4px_0px_0px_#000000] rotate-12 z-20">
                    {{ $data->age }}th
                </div>

                <!-- Photo -->
                @if ($data->photo_path)
                    <div
                        class="relative inline-block mb-6 transform -rotate-2 hover:rotate-0 transition-transform duration-300">
                        <div class="p-2 bg-white border-4 border-black rounded-xl shadow-[4px_4px_0px_0px_#000]">
                            <img src="{{ Storage::url($data->photo_path) }}" alt="Photo"
                                class="w-full h-64 object-cover rounded-lg border-2 border-black grayscale hover:grayscale-0 transition-all duration-500">
                        </div>
                        <!-- Tape Effect -->
                        <div
                            class="absolute -top-3 left-1/2 -translate-x-1/2 w-24 h-8 bg-white/50 border-2 border-black rotate-2">
                        </div>
                    </div>
                @else
                    <div
                        class="w-full h-48 bg-gray-100 border-4 border-black rounded-xl mb-6 flex items-center justify-center">
                        <span class="material-icons-round text-6xl text-gray-300">cake</span>
                    </div>
                @endif

                <h1 class="font-display font-black text-4xl mb-2">Happy Birthday!</h1>
                <h2 class="font-display font-bold text-2xl text-purple-600 mb-6">{{ $data->recipient_name }}</h2>

                <div class="bg-gray-50 border-2 border-black rounded-xl p-4 mb-6 text-left relative">
                    <span
                        class="absolute -top-3 -left-2 bg-white border-2 border-black px-2 text-xs font-bold uppercase">From:
                        {{ $data->sender_number }}</span>
                    <p class="whitespace-pre-wrap leading-relaxed" id="message-text"></p>
                </div>

                <div class="text-xs text-center text-gray-400 mt-4">
                    Reply to sender via WhatsApp? <br />
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data->sender_number) }}?text=Thank you for the birthday wishes!"
                        class="inline-block mt-2 bg-green-500 text-white border-2 border-black px-4 py-2 rounded-lg font-bold hover:bg-green-600 shadow-[2px_2px_0px_0px_#000]">Send
                        Thanks</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const messageOriginal = @json($data->message);

        // --- STAGE 1: OPEN GIFT ---
        const giftBox = document.getElementById('gift-box');
        const stage1 = document.getElementById('stage-1');
        const stage2 = document.getElementById('stage-2');
        const stageDialog = document.getElementById('stage-dialog');
        const stage3 = document.getElementById('stage-3');

        giftBox.addEventListener('click', () => {
            // Animate Gift Opening
            gsap.to(giftBox, {
                scale: 1.5,
                rotation: 360,
                opacity: 0,
                duration: 0.8,
                ease: "back.in(1.7)",
                onComplete: () => {
                    stage1.classList.add('hidden-stage');
                    stage2.classList.remove('hidden-stage');
                    startBubbleGame();
                }
            });
        });

        // --- STAGE 2: BUBBLE POP MINI-GAME ---
        function startBubbleGame() {
            let poppedCount = 0;
            const totalBubbles = 15; // Requires 10 pops to proceed
            const requiredPops = 8;

            // Speed up slightly
            const colors = ['#FBBF24', '#f472b6', '#60A5FA', '#34D399', '#F87171'];

            const interval = setInterval(() => {
                if (poppedCount >= requiredPops) return;

                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                const size = Math.random() * 60 + 40; // 40-100px
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${Math.random() * 80 + 10}%`;
                bubble.style.bottom = '-150px';
                bubble.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                bubble.style.border = '3px solid black';
                bubble.style.zIndex = '50';

                // Pop Event
                bubble.addEventListener('touchstart', popBubble);
                bubble.addEventListener('click', popBubble);

                function popBubble(e) {
                    e.stopPropagation();
                    poppedCount++;

                    // Pop animation
                    gsap.to(bubble, {
                        scale: 1.5,
                        opacity: 0,
                        duration: 0.1,
                        onComplete: () => bubble.remove()
                    });

                    if (poppedCount === requiredPops) {
                        clearInterval(interval);
                        endStage2();
                    }
                }

                stage2.appendChild(bubble);

                // Auto remove if floats off screen
                setTimeout(() => {
                    if (bubble.parentNode) bubble.remove();
                }, 4000);

            }, 300);
        }

        function endStage2() {
            setTimeout(() => {
                stage2.classList.add('hidden-stage');
                stageDialog.classList.remove('hidden-stage');
                startDialog();
            }, 500);
        }

        // --- STAGE 2.5: DIALOG SYSTEM ---

        const scripts = [{
                text: "Wow! Great popping skills! 🎈",
                choices: []
            },
            {
                text: "Are you ready for your surprise?",
                choices: [{
                        label: "YES BORN READY!",
                        next: 'yes'
                    },
                    {
                        label: "Hmm, maybe...",
                        next: 'maybe'
                    }
                ]
            }
        ];

        const branches = {
            'yes': {
                text: "I love the energy! Let's go! 🚀",
                choices: [{
                    label: "Reveal it!",
                    action: 'finish'
                }]
            },
            'maybe': {
                text: "Don't be shy! It's gonna be great! ✨",
                choices: [{
                    label: "Okay, show me!",
                    action: 'finish'
                }]
            }
        };

        const dialogText = document.getElementById('dialog-text');
        const choicesContainer = document.getElementById('choices-container');
        const avatarContainer = document.getElementById('avatar-container');
        const avatarMouth = document.getElementById('avatar-mouth');

        function startDialog() {
            // Animate Avatar In
            gsap.fromTo(avatarContainer, {
                scale: 0,
                rotation: -180
            }, {
                scale: 1,
                rotation: 0,
                duration: 1,
                ease: "elastic.out(1, 0.5)"
            });

            runScriptStep(scripts[0]);
        }

        function runScriptStep(stepData) {
            choicesContainer.classList.add('hidden');
            choicesContainer.innerHTML = ''; // clear old choices
            typeText(stepData.text, () => {
                // After typing finish
                if (stepData.choices && stepData.choices.length > 0) {
                    showChoices(stepData.choices);
                } else {
                    // Auto advance if no choices (after delay)
                    setTimeout(() => {
                        runScriptStep(scripts[1]); // Harcoded for simple linear flow to start
                    }, 1500);
                }
            });
        }

        function showChoices(choices) {
            choicesContainer.classList.remove('hidden');
            gsap.fromTo(choicesContainer, {
                opacity: 0,
                y: 10
            }, {
                opacity: 1,
                y: 0
            });

            choices.forEach(choice => {
                const btn = document.createElement('button');
                btn.className =
                    "w-full bg-white border-2 border-black rounded-xl py-3 font-display font-bold text-lg shadow-[4px_4px_0px_0px_#000] hover:bg-yellow-100 transition-colors choice-btn text-left px-4";
                btn.innerText = choice.label;
                btn.onclick = () => handleChoice(choice);
                choicesContainer.appendChild(btn);
            });
        }

        function handleChoice(choice) {
            if (choice.action === 'finish') {
                endStageDialog();
            } else if (choice.next && branches[choice.next]) {
                runScriptStep(branches[choice.next]);
            }
        }

        function typeText(text, callback) {
            dialogText.textContent = "";
            let i = 0;
            // Mouth animation
            gsap.to(avatarMouth, {
                scaleY: 0.2,
                yoyo: true,
                repeat: -1,
                duration: 0.1
            });

            const interval = setInterval(() => {
                dialogText.textContent += text.charAt(i);
                i++;
                if (i >= text.length) {
                    clearInterval(interval);
                    gsap.killTweensOf(avatarMouth);
                    gsap.to(avatarMouth, {
                        scaleY: 1
                    }); // reset mouth
                    if (callback) callback();
                }
            }, 40);
        }

        function endStageDialog() {
            gsap.to(stageDialog, {
                opacity: 0,
                scale: 0.9,
                duration: 0.5,
                onComplete: () => {
                    stageDialog.classList.add('hidden-stage');
                    stage3.classList.remove('hidden-stage');
                    revealCard();
                }
            });
        }

        // --- STAGE 3: CARD REVEAL ---
        function revealCard() {
            // Typewriter effect for message
            const msgContainer = document.getElementById('message-text');
            let i = 0;
            const speed = 30; // ms

            function typeWriter() {
                if (i < messageOriginal.length) {
                    msgContainer.innerHTML += messageOriginal.charAt(i);
                    i++;
                    setTimeout(typeWriter, speed);
                }
            }

            // Wait for stage transition then spark confetti and type
            setTimeout(() => {
                confetti({
                    particleCount: 150,
                    spread: 70,
                    origin: {
                        y: 0.6
                    }
                });
                typeWriter();
            }, 500);
        }
    </script>
</body>

</html>
