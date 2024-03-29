<?php
include "data.php";
?>
</main>
<footer>
    <div class="footer-content">
        <div class="footer-section about">
            <h2>A propos de My Cinema</h2>
            <p>Explorez My Cinema pour une expérience cinématographique exceptionnelle. Retrouvez les derniers films, horaires de projection et bien plus encore.</p>
        </div>
        <div class="footer-section contact">
            <h2>Contactez-nous</h2>
            <p>Email: info@mycinema.com</p>
            <p>Téléphone: +123 456 789</p>
        </div>
        <div class="footer-section follow">
            <h2>Suivez-nous</h2>
            <a href="#" class="fa-brands fa-facebook-f"></a>
            <a href="#" class="fa-brands fa-x-twitter"></a>
            <a href="#" class="fa-brands fa-instagram"></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 My Cinema. Tous droits réservés.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/script.js"></script>
<script type="text/javascript">
    const datas = <?= $datas?>
    
</script>
<script src="../js/chartjs.js"></script>
</body>


</html>