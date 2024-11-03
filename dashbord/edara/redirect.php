<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'مستخدمين المدارس';  // this function to load page title
    include 'init.php';   //  Dirctory page 
    include 'breadcrumb.php';
    ?>
    <div class="main1">
        <div class="overlay"></div>
        <div class="terminal">
            <h1 class="text-center mb-4">خطأ في صلاحيات الوصول <span class="errorcode">403</span></h1>
            <p class="output">تم الرفض بسبب انه ليس لديك إذن للوصول إلى هذه الصفحة </p>
            <p class="output">فضلا قم بإختيار الأجراء المناسب <a class="bac" href="javascript:history.go(-1)">عودة للخلف</a> أو 
            <a class="bac" href="index">رئيسية الموقع</a>.</p>
            <p class="text-center mt-4">مديرية التربية والتعليم بكفر الشيخ </p>
        </div>
    </div>
<style>
    @import 'https://fonts.googleapis.com/css?family=Inconsolata';
    @import url('https://fonts.googleapis.com/css2?family=Changa:wght@300;600&display=swap');

    .main1 {
        box-sizing: border-box;
        height: 100%;
        background-color: #000000;
        background-image: radial-gradient(#11581E, #041607), url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
        background-repeat: no-repeat;
        background-size: cover;
        font-family: 'Changa', sans-serif;
        font-size: 1.5rem;
        color: rgba(128, 255, 128, 0.8);
        text-shadow:
            0 0 1ex rgba(51, 255, 51, 1),
            0 0 2px rgba(255, 255, 255, 0.8);
        direction: rtl;
    }

    .overlay {
        background-image: url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
        background-repeat: no-repeat;
        background-size: cover;
        
        background:
            repeating-linear-gradient(180deg,
                rgba(0, 0, 0, 0) 0,
                rgba(0, 0, 0, 0.3) 50%,
                rgba(0, 0, 0, 0) 100%);
        /* background-size: auto 4px; */
        z-index: 1;
        
    }

    .overlay::before {
        content: "";
        pointer-events: none;
        position: absolute;
        display: block;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(0deg,
                transparent 0%,
                rgba(32, 128, 32, 0.2) 2%,
                rgba(32, 128, 32, 0.8) 3%,
                rgba(32, 128, 32, 0.2) 3%,
                transparent 100%);
        background-repeat: no-repeat;
        animation: scan 7.5s linear 0s infinite;
    }

    @keyframes scan {
        0% {
            background-position: 0 -100vh;
        }
        35%,
        100% {
            background-position: 0 100vh;
        }
    }

    .terminal {
        width: 100%;
        max-width: 100%;
        padding: 4rem;
        text-transform: uppercase;
    }

    .output {
        color: rgba(128, 255, 128, 0.8);
        text-shadow:
            0 0 1px rgba(51, 255, 51, 0.4),
            0 0 2px rgba(255, 255, 255, 0.8);
    }

    .output::before {
        content: "> ";
    }

    .bac {
        color: #fff;
        text-decoration: none;
    }
    .bac:hover {
        color: #fff;
    }
    .bac::before {
        content: "[";
    }

    .bac::after {
        content: "]";
    }

    .errorcode {
        color: white;
    }
</style>

<?php

}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>