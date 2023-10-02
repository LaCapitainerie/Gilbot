<section class="entete">
    <div>
        <i class='bx bx-menu' onclick="sw();"></i>
        <span class="entete-text"><?php $url = explode("/", $_SERVER['PHP_SELF']); echo ucfirst(explode(".", end($url))[0]); ?></span>
        <div id="offline" style="opacity: 0;">
            <a>Vous êtes hors ligne.</a>
        </div>
    </div>
    <script>document.querySelector('#offline').style.opacity = window.navigator.onLine?'0':'1';</script>
</section>