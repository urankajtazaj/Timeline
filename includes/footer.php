<footer class="text-center p-3">
    <p class="mt-3 m-0 text-muted">&copy; <?= date_format(new DateTime(), "Y") ?> Uran Kajtazaj</p>
</footer>

<script src="assets/js/libs/jquery-3.4.1.min.js"></script>
<script src="assets/js/libs/popper.min.js"></script>
<script src="assets/js/libs/bootstrap.min.js"></script>

<script src="assets/js/main.js"></script>
<script src="assets/js/post_likes.js"></script>
<script src="assets/js/post_modal.js"></script>
<script src="assets/js/user_follow.js"></script>
<script src="assets/js/search_user.js"></script>
<script src="assets/js/post_create.js"></script>
<script src="assets/js/comment_create.js"></script>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>

<!--<div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false"></div>-->

<!--<script>-->
<!--    window.fbAsyncInit = function() {-->
<!--        FB.init({-->
<!--            appId      : '2040535216240224',-->
<!--            cookie     : true,-->
<!--            xfbml      : true,-->
<!--            version    : 'v3.3'-->
<!--        });-->
<!---->
<!--        FB.AppEvents.logPageView();-->
<!---->
<!--        FB.getLoginStatus(function(response) {-->
<!--            console.log(response);-->
<!--            statusChangeCallback(response);-->
<!--        });-->
<!---->
<!--    };-->
<!---->
<!--    (function(d, s, id){-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) {return;}-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = "https://connect.facebook.net/en_US/sdk.js";-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));-->
<!--</script>-->

</body>
</html>