<footer class="mt-3">
  <style>
    #footer {
        background: orange !important;
    }
    #footer h5{
    	padding-left: 10px;
        border-left: 3px solid #eeeeee;
        padding-bottom: 6px;
        margin-bottom: 20px;
        color:#ffffff;
    }
    #footer a {
        color: #ffffff !important;
        text-decoration: none !important;
        background-color: transparent;
        -webkit-text-decoration-skip: objects;
    }
    #footer ul.social li{
    	padding: 3px 0;
    }
    #footer ul.social li a i {
        margin-right: 5px;
    	font-size:25px;
    	-webkit-transition: .5s all ease;
    	-moz-transition: .5s all ease;
    	transition: .5s all ease;
    }
    #footer ul.social li:hover a i {
    	font-size:30px;
    	margin-top:-10px;
    }
    #footer ul.social li a,
    #footer ul.quick-links li a{
    	color:#ffffff;
    }
    #footer ul.social li a:hover{
    	color:#eeeeee;
    }
    #footer ul.quick-links li{
    	padding: 3px 0;
    	-webkit-transition: .5s all ease;
    	-moz-transition: .5s all ease;
    	transition: .5s all ease;
    }
    #footer ul.quick-links li:hover{
    	padding: 3px 0;
    	margin-left:5px;
    	font-weight:700;
    }
    #footer ul.quick-links li a i{
    	margin-right: 5px;
    }
    #footer ul.quick-links li:hover a i {
        font-weight: 700;
    }

    @media (max-width:767px){
    	#footer h5 {
        padding-left: 0;
        border-left: transparent;
        padding-bottom: 0px;
        margin-bottom: 10px;
      }
    }


  </style>
  <section id="footer">
    <div class="container">
      <div class="row text-center text-xs-center text-sm-left text-md-left">
          <ul class="list-unstyled quick-links">
            <li><a href="mailto:helion.quentin@gmail.com">Contact</a></li>
            <li><a href="<?= isset($_SESSION["id"]) ? 'profil.php' : 'inscription.php'  ?>">Espace client</a></li>
            <li><a href="savoir_plus.php">En savoir plus</a></li>
          </ul>
        </div>
        <hr>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
          <p class="h6">©Hicham Khadda     ©Jonathan Mbossa     ©Quentin Hélion</p>
          <a class="text-green ml-2">HJQ-MOTORS</a>
        </div>
      </div>
    </div>
  </section>
</footer>
