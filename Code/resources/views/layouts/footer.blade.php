<footer class="bg-[#3654a5] text-white pt-12 pb-6 relative overflow-hidden font-sans">
    
    {{-- Hiasan Background (Jejak Kaki) --}}
    <div class="absolute top-4 left-4 opacity-20 pointer-events-none">
        <img 
                src="{{ asset('images/paw.png') }}" 
                alt="paw" 
                class="w-[100px] relative z-10 mr-20 mt-2"
            >
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-start">
            
            {{-- Kolom 1: Logo --}}
            <div class="flex justify-center md:justify-start">
                <div class="bg-white rounded-[2rem] p-4 w-32 h-32 flex flex-col items-center justify-center shadow-lg text-[#3654a5]">
                    {{-- Ganti src ini dengan path logo Anda yang sebenarnya --}}
                    {{-- Placeholder Icon --}}
                    <i class="fa-solid fa-dog text-4xl mb-1"></i>
                    <i class="fa-solid fa-cat text-2xl absolute ml-6 mt-2"></i>
                    <img src="{{ asset('images/Logo.png') }}" alt="">
                </div>
            </div>

            {{-- Kolom 2: Slogan --}}
            <div class="text-center md:text-left mt-2">
                <h3 class="text-[#facc15] font-bold text-xl mb-3 tracking-wide">Adopt a Buddy</h3>
                <p class="text-white text-lg font-medium leading-snug">
                    Every paw deserves a <br> place to call home.
                </p>
            </div>

            {{-- Kolom 3: Contact Us --}}
            <div class="text-center md:text-left mt-2">
                <h3 class="text-white font-bold text-xl mb-3 tracking-wide">Contact Us</h3>
                <div class="text-[#facc15] font-medium text-lg leading-snug space-y-1">
                    <p>123 Shelter Lane, Animal</p>
                    <p>Haven, CA 90210</p>
                    <a href="mailto:info@adoptabuddy.org" class="hover:underline block mt-2">info@adoptabuddy.org</a>
                </div>
            </div>

            {{-- Kolom 4: Newsletter & Social --}}
            <div class="text-center md:text-right mt-2 flex flex-col items-center md:items-end">
                <h3 class="text-white  font-bold text-xl mb-4 tracking-wide w-full md:text-center text-center">Sign Up for news</h3>
                
                {{-- Email Input pill-shaped --}}
                <form action="#" class="w-full max-w-xs">
                    <div class="relative">
                        <input type="email" placeholder="Email" 
                            class="w-full bg-[#4662b0] border border-white/50 rounded-full py-2 px-6 text-center text-white placeholder-white focus:outline-none focus:bg-[#526dc0] transition-colors"
                        >
                    </div>
                </form>

                {{-- Social Icons --}}
                <div class="flex space-x-6 mt-6 justify-center md:justify-end">
                    <a href="#" class="text-white hover:text-[#facc15] transition-colors bg-white/10 rounded-full w-8 h-8 flex items-center justify-center">
                        <img src="{{ asset('images/fb.png') }}" alt="fb">
                    </a>
                    <a href="#" class="text-white hover:text-[#facc15] transition-colors bg-white/10 rounded-full w-8 h-8 flex items-center justify-center">
                        <img src="{{ asset('images/ig.png') }}" alt="ig">
                    </a>
                    <a href="#" class="text-white hover:text-[#facc15] transition-colors bg-white/10 rounded-full w-8 h-8 flex items-center justify-center">
                        <img src="{{ asset('images/x.png') }}" alt="x">
                    </a>
                </div>
            </div>
        </div>

        {{-- Divider Line --}}
        <div class="border-t border-white/30 mt-12 mb-8 mx-4"></div>

        {{-- Copyright --}}
        <div class="text-center text-white text-base font-medium pb-4">
            Copyright &copy; 2025 Adopt A Buddy. All Rights Reserved.
        </div>
    </div>
</footer>