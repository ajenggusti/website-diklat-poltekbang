            </div>
                <style>
                    .footer {
                        padding: 25px 0;
                        background-color: #fa9d6c;
                        color: white;
                        width: 100%;
                        font-weight: bold;
                        padding-left: 10px;
                        padding-right: 10px;
                    }
                    .footer h5 {
                        font-weight: bolder;
                        font-size: 24px;
                    }


                    .footer-left,
                    .footer-middle,
                    .footer-right {
                        padding: 10px;
                        box-sizing: border-box;
                    }


                    .footer-left {
                        width: 22%;
                        margin-left: 130px;
                        float: left;
                        box-sizing: border-box;

                    }
                    .footer-left p {
                        margin-top: 15px;
                        font-weight:lighter;
                    }

                    .footer-middle {
                        width: 26%;
                        margin-left: 70px;
                        float: left;
                    }
                    
                    .footer-right {
                        width: 30%;
                        margin-left: 20px;
                        float: left;

                    }
                    .footer-right p{
                        margin-top: 15px;
                    }

                    .clear {
                        clear: both;
                    }

                    /* Style untuk QUICK LINKS */
                    .ul-kiri {
                        margin-top: 15px;
                        margin-left: -10px;
                        padding-left: 10px;
                        list-style: none;
                        float: left;
                        width: 200px;
                    }
                    .nav-footer a {
                        color: rgb(255, 255, 255);
                    }

                    .ul-kanan {
                        margin-top: 15px;
                        margin-right: 10px;
                        padding-left: 0;
                        list-style: none;
                        float: right;
                        width: 160px;
                    }

                    /* Footer Bawah */
                    .kiri-bawah {
                        width: 680px;
                        float: left;
                        padding: 10px;
                        box-sizing: border-box;
                        margin-left: 120px;
                    
                    }

                    .kanan-bawah {
                        width: 320px;
                        margin-right: 110px;
                        float: right;
                        padding: 10px;
                        box-sizing: border-box;
                    }
                    .kanan-bawah a {
                        margin-top: 3px;
                        margin-bottom: 3px;
                        float: left;
                        color: rgb(255, 255, 255);
                    }

                    /* Style Icon */
                    .ikon i {
                        border-radius: 50%;
                        text-decoration: none;
                        padding: 5px 8px 5px 8px;
                        font-size: 20px;
                        width: 25px;
                        margin: 5px 2px;
                        text-align: center;
                    }
                    .bi:hover {
                        opacity: 0.7;
                        color:#838688;
                    }
                    .footer p  {
                        font-size: 18px;
                    }


                    /* Layar 0-480px */
                   @media screen and (max-width: 480px) {
                        .footer h5 {
                            font-weight: bold;
                        }

                        .footer-left,
                        .footer-middle,
                        .footer-right {
                            font-size: 14px;
                        }


                        .footer-left {
                            width: 100%;
                            /* max-width: 90%; */
                            margin-left: 20px;
                            float: none;
                            box-sizing: border-box;


                        }
                        .footer-left p {
                            margin-top: 15px;
                            font-weight:lighter;
                        }

                        .footer-middle {
                            width: 100%;
                            /* max-width: 90%; */
                            margin-left: 40px;
                            margin-right: 0;
                            float: none;
                        }
                        .footer-middle h5 {
                            margin-left: -20px
                        }
                        .footer-middle .ul-kiri,
                        .footer-middle .ul-kanan {
                            width: 100%;
                            max-width: 45%;
                        }
                        .footer-right {
                            width: 100%;
                            max-width: 90%;
                            margin-left: 20px;
                            float: left;

                        }

                        .ul-kiri {
                            margin-top: 15px;
                            margin-left: -33px;
                            list-style: none;
                            float: left;
                        }
                        .nav-footer a {
                            color: rgb(255, 255, 255);
                        }

                        .ul-kanan {
                            margin-top: 15px;
                            margin-right: 50px;
                            list-style: none;
                            float: right;
                        }

                        .kiri-bawah {
                            font-weight: 600;
                            width: 100%;
                            /* max-width: 95%; */
                            margin-left: 10px;
                            text-align: center;
                            float: none;
                        }

                        .kanan-bawah {
                            width: 100%;
                            /* max-width: 95%; */
                            text-align: center;
                            /* margin-right: -120px; */
                            float: none;
                        }
                        
                        .footer p  {
                            font-size: 14px;
                        }
                        .ikon i {
                            border-radius: 50%;
                            text-decoration: none;
                            padding: 5px 7px 5px 7px;
                            font-size: 10px;
                            width: 20px;
                            margin: 5px 2px;
                            text-align: center;
                        }
                    }

                    /* Layar untuk 481px - 900px */
                    @media screen and (min-width: 481px) and (max-width: 900px) {
                        .footer-left,
                        .footer-middle,
                        .footer-right {
                            font-size: 15px;
                        }

                        .footer-left {
                            width: 100%;
                            max-width: 21%;
                            margin-left: 20px;
                            margin-right: 20px;
                            margin-top: 10px;
                            float: left;
                            box-sizing: border-box;


                        }
                        .footer-left p {
                            margin-top: 15px;
                            font-weight:lighter;
                        }

                        .footer-middle {
                            width: 100%;
                            max-width: 35%;
                            margin-left: 20px;
                            margin-top: 10px;
                            float: left;
                        }

                        .footer-right {
                            width: 100%;
                            max-width: 35%;
                            margin-left: 0;
                            margin-right: 10px;
                            margin-top: 10px;
                            float: right;

                        }
                        .footer-middle h5 {
                            padding-bottom: 20px;
                        }
                        .footer-right h5 {
                            padding-bottom: 20px
                        }

                        .ul-kiri {
                            margin-top: 15px;
                            max-width: 40%;
                            list-style: none;
                            float: left;
                        }
                        .nav-footer a {
                            color: rgb(255, 255, 255);
                        }

                        .ul-kanan {
                            margin-top: 15px;
                            max-width: 40%;
                            margin-left: -10px;
                            list-style: none;
                            float: right;
                        }

                        .kiri-bawah {
                            font-weight: 600;
                            width: 100%;
                            max-width: 50%;
                            margin-left: 10px;
                            padding-top: 20px;
                        }

                        .kanan-bawah {
                            width: 100%;
                            max-width: 50%;
                            text-align: center;
                            margin-right: -60px;
                        }
                        
                        .footer p  {
                            font-size: 14px;
                        }
                        .ikon i {
                            border-radius: 50%;
                            text-decoration: none;
                            padding: 5px 7px 5px 7px;
                            font-size: 10px;
                            width: 100%;
                            max-width: 20px;
                            margin: 5px 2px;
                            text-align: center;
                        }
                    }

                </style>

                <div class="footer">
                    <div class="footer-left">
                        <h5>POLTEKBANG SURABAYA</h5>
                        <p>Be first class airman!</p>
                    </div>
                    <div class="footer-middle">
                        <h5>QUICK LINKS</h5>
                            <ul class="ul-kiri">
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">PPID</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">LMS</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">CITIUS</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">E-JOURNAL</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">SNITP</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Sipencatar Non Reguler</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Cloud</a></li>
                            </ul>
                            <ul class="ul-kanan">
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">ALUMNI</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">e-Library</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Repository</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">DAMA</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">ICATEAS</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Sipencatar Reguler</a></li>
                                <li class="nav-footer mb-2"><a href="#" class="nav-link p-0 text-body-secondary">SIAKAD</a></li>
                            </ul>
                    </div>
                    <div class="footer-right">
                        <h5>OUR ADDRESS</h5>
                        <p>Jalan Jemur Andayani | No 73 Surabaya 60236</p>
                        <p><span style="color:rgb(255, 255, 255); font-weight: bold;">Phone :</span> 62 31 8410871</p>
                        <p><span style="color:rgb(255, 255, 255); font-weight: bold;">Fax : </span>62 31 8490005</p>
                        <p><span style="color:rgb(255, 255, 255); font-weight: bold;">Email : </span>mail@poltekbangsby.ac.id</p>
                    </div>
                    <div class="clear"></div>
                    <br> <br>
                    <hr>
                    <div class="kiri-bawah">
                        <p class="text-body-secondary">Copyright &copy; 2024, All rights reserved. Designed by Unit IT Politeknik Surabaya</p>
                    </div>
                    <div class="kanan-bawah">
                        <a href="#" style="font-size: 25px; margin-left: 10px; " class="ikon">
                            <i class="bi bi-instagram" style="background: #405DE6;"></i>
                        </a>

                        <a href="#" style="font-size: 25px; margin-left: 10px;" class="ikon">
                            <i class="bi bi-facebook" style="background: #55ACEE;"></i>
                        </a>

                        <a href="#" style="font-size: 25px; margin-left: 10px;" class="ikon">
                            <i class="bi bi-twitter-x" style="background: #000000;"></i>
                        </a>

                        <a href="#" style="font-size: 25px; margin-left: 10px;" class="ikon">
                            <i class="bi bi-youtube" style="background: #bb0000;"></i>
                        </a>

                        <a href="#"style="font-size: 25px; margin-left: 10px;" class="ikon">
                            <i class="bi bi-whatsapp" style="background: #a4c639;"></i>
                        </a>

                        <a href="#"style="font-size: 25px; margin-left: 10px;" class="ikon">
                            <i class="bi bi-tiktok" style="background: #000000;"></i>
                        </a>
                    </div>
                    <div class="clear"></div>
                </div>
    </body>
</html>