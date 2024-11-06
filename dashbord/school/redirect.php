<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';

if (isset($_SESSION['user'])){
    $pageTitle = 'fitness stations gym';  // this function to load page title
    include 'init.php';   //  Dirctory page 
    include 'breadcrumb.php';
    ?>
    <div class="main1" style="direction:ltr;">
        <div class="overlay"></div>
        <div class="terminal">
            <h1 class="text-center mb-4">   Welcome in <span class="errorcode">   Moaddi  </span></h1>
            <p class="output"> You are now waiting for the site administration to approve your application. </p>
            <p class="output"> Please select the appropriate procedure. <a class="bac" href="">Go back </a> أو 
            <a class="bac" href="../../">Home Page </a>.</p><br>
            <div class="typing-demo">Admin   🙋 </div>
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
            text-align: left;
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

    .typing-demo {
            width: 22ch;
            animation: typing 2s steps(22), blink .5s step-end infinite alternate;
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid;
            font-family: monospace;
            font-size: 1em;
            direction: ltr !important;
            font-family: 'Changa', sans-serif;
            text-align: left;
            }

            @keyframes typing {
            from {
                width: 0
            }
            }
                
            @keyframes blink {
            50% {
                border-color: transparent
            }
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