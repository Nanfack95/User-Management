const motDePasse = document.getElementById('password');
        const voirMotDePasse = document.getElementById('eye-icon');
        const cacherMotDePasse = document.getElementById('eye-slash-icon');

        voirMotDePasse.addEventListener('click', function() {
            if (motDePasse.type === 'password') {
                motDePasse.type = 'text';
                voirMotDePasse.classList.add('hidden');
                cacherMotDePasse.classList.remove('hidden');
            }
        });

        cacherMotDePasse.addEventListener('click', function() {
            if (motDePasse.type === 'text') {
                motDePasse.type = 'password';
                cacherMotDePasse.classList.add('hidden');
                voirMotDePasse.classList.remove('hidden');
            }
        });