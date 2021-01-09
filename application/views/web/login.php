<style>
    .city_login_wrap {
        padding: 50px 0px;
        margin-bottom: 100px;
    }

    .city_register_list {
        margin-top: 190px;
    }

    /* .city_comment_form_login {
        margin-bottom: 93px;
    } */
</style>

<div class="city_login_wrap">
    <div class="container">
        <div class="city_login_list">
            <div class="city_login">
                <h4>login <small id="alerta"></small></h4>
                <form method="post" id="form_login" class="city_comment_form_login">
                    <div class="city_commet_field">
                        <label>username</label>
                        <input placeholder="username" name="username" type="text" value="" data-default="Name*" size="30" required>
                    </div>
                    <div class="city_commet_field">
                        <label>password</label>
                        <input placeholder="password" name="password" type="password" value="" data-default="Name*" size="30" required>
                    </div>

                    <!-- <a class="theam_btn" id="login_button">LOGIN</a> -->
                    <input type="submit" class="theam_btn" value="LOGIN">
                </form>
                <span class="city_or"></span>
            </div>
            <div class="city_login register">
                <h4>selamat datang</h4>
                <p>DI WEBSITE JDIH KOTA MOJOKERTO</p>
                <div class="city_register_list">
                    <h6></h6>
                </div>
            </div>
        </div>
    </div>
</div>