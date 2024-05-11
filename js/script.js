
        /////////////////////////////////
        // Home Page Login and Signup
        /////////////////////////////////
        // Get the popup and button elements
        const loginButtonHeader = document.getElementById('loginButtonHeader');
        const registerButtonHeader = document.getElementById('registerButtonHeader');
        const loginPopup = document.getElementById('loginPopup');
        const registerPopup = document.getElementById('registerPopup');
        const loginButton = document.getElementById('loginButton');
        const registerButton = document.getElementById('registerButton');
        // Add event listeners to the buttons
        loginButtonHeader.addEventListener('click', () => {
            loginPopup.classList.remove('hidden');
        });

        registerButtonHeader.addEventListener('click', () => {
            registerPopup.classList.remove('hidden');
        });

        loginButton.addEventListener('click', () => {
            loginPopup.classList.remove('hidden');
        });

        registerButton.addEventListener('click', () => {
            registerPopup.classList.remove('hidden');
        });


        // Close the popup when the user clicks outside of it
        loginPopup.addEventListener('click', (event) => {
            if (event.target === loginPopup) {
                loginPopup.classList.add('hidden');
            }
        });

        registerPopup.addEventListener('click', (event) => {
            if (event.target === registerPopup) {
                registerPopup.classList.add('hidden');
            }
        });

        ///////////////////////////////
        //Home Page Fade Effect
        window.addEventListener('scroll', function() {
            var elementsToFadeIn = document.querySelectorAll('.fade-in-element');
        
            elementsToFadeIn.forEach(function(element) {
                var elementPosition = element.getBoundingClientRect().top;
                var windowHeight = window.innerHeight;
                var fadeInThreshold = windowHeight / 2;
                var opacity = 1 - Math.max(0, Math.min(1, (elementPosition - fadeInThreshold) / fadeInThreshold));
        
                element.style.opacity = opacity;
            });
        });
        



        