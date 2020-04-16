<template>
    <div class="container-fluid">
    <section class="row no-gutter align-items-center">
        <div class="col-12 text-center p-0 d-flex align-items-center">
            <img :src="'/storage/default/default-cover.jpg'" class="img-fluid position-relative mx-auto" style="height: 100%; width: 100%;">
            <div class="dashboard w-100 position-absolute my-auto">
                        <h1>Biskvit</h1>
                        <h2>Знайди своє захоплення</h2>
                <div class="">
                    <a href="/#/registration" rel="noopener noreferrer">
                        <button id="registration">
                            <span>Реєстрація</span>
                        </button>
                    </a>
                        <button id="login">
                            <span>Вхід</span>
                        </button>
                </div>
            </div>
            <div class="posted_img">
                <a href="" target="_blank" rel="noopener noreferrer">
                    Опублікував <strong>Аніме Клуб</strong>
                </a>
                <a href="http://" target="_blank" rel="noopener noreferrer">
                    <img :src="'/storage/default/default-avatar.jpg'" id="user_avatar" alt="User avatar">
                </a>
            </div>
        </div>
    </section>
    </div>
</template>

<style scoped>
html, body{
    font-family: Arial;
    font-style: normal;
}
h1{
    font-weight: bold;
    color: #ffffff;
    font-size: 50px;
    line-height: 70px;
}
h2{
    font-size: 16px;
    color: #ffffff;
}
#registration, #login{
    margin: 15px 10px;
    width: 280px;
    height: 45px;
    border-radius: 5px;
    font-family: Arial;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
    border: 0;
}
#registration{
    background: #ffffff;
    color: black;

}
#login{
    background: #3A55B4;
    color: white;
}
#user_avatar{
    width: 24px;
    height: 24px;
    border-radius: 2px;
    margin: 0 0 0 10px;
}
.align-items-start{
    background: #ffef0b;
}
.posted_img{
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 0 12px;
    margin: 0 0 12px 0;
}
.posted_img a{
    color: #ffffff;
    text-decoration: none;
    font-family: Arial;
    font-style: normal;
    font-size: 14px;
}
.posted_img a strong{
    font-weight: 800;
}
.posted_img a:visited{
        color: #ffffff;
}
</style>