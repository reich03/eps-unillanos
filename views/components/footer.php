</main>

    <footer class="bg-gradient-to-r from-eps-blue-900 via-eps-blue-800 to-eps-blue-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-2 left-10 w-8 h-8 bg-white opacity-10 rounded-full"></div>
            <div class="absolute bottom-3 right-20 w-6 h-6 bg-white opacity-10 rounded-full"></div>
            <div class="absolute top-4 right-1/3 w-4 h-4 bg-white opacity-10 rounded-full"></div>
        </div>

        <div class="container mx-auto px-6 py-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mx-4">
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start space-x-3 mb-4">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <span class="text-xl">🏥</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">EPS Unillanos</h3>
                            <p class="text-eps-blue-200 text-sm">Cuidando tu salud</p>
                        </div>
                    </div>
                    <p class="text-eps-blue-100 text-sm leading-relaxed">
                        Brindando servicios de salud de calidad con tecnología moderna y atención personalizada.
                    </p>
                </div>
                

                <div class="text-center md:text-right">
                    <h4 class="text-lg font-semibold mb-4 text-white">Contacto</h4>
                    <div class="space-y-2 text-sm text-eps-blue-100">
                        <div class="flex items-center justify-center md:justify-end space-x-2">
                            <span>📍</span>
                            <span>Villavicencio, Meta</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-end space-x-2">
                            <span>📞</span>
                            <span>(8) 123-4567</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-end space-x-2">
                            <span>✉️</span>
                            <span>info@epsunillanos.com</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-eps-blue-700 my-6"></div>
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-center md:text-left">
                    <p class="text-eps-blue-200 text-sm">
                        &copy; <?= date('Y') ?> EPS Unillanos. Todos los derechos reservados.
                    </p>
                    <p class="text-eps-blue-300 text-xs mt-1">
                        Sistema desarrollado con ❤️ para mejorar la atención médica
                    </p>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-eps-blue-200 text-xs">
                        Versión 1.0.0
                    </div>
                    <div class="w-px h-4 bg-eps-blue-600"></div>
                    <div class="text-eps-blue-200 text-xs">
                        <?= date('d/m/Y H:i') ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.shadow-lg').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>