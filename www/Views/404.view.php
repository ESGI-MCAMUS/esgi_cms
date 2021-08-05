<style>
    #container {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #4DC4FF;
        background-image: linear-gradient(135deg, #4DDBC4 0%, #4DC4FF 100%);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>


<section id="container">
    <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_lwuTiS.json" background="transparent" speed="1" style="width: 400px; height: 400px;" loop autoplay></lottie-player>
    <h1 class="texte blanc tres-gros"><?= strtoupper(LANG['404']['title']) ?></h1>
    <a href="/" class="bouton blanc inverse arrondi"><?= LANG['404']['button'] ?></a>
</section>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>