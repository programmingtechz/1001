<!DOCTYPE html>
<html>
    <head>
        <?php include_title(); ?>
		<?php include_metas(); ?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700italic,700,900&amp;subset=latin,latin-ext">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=PT+Serif:700italic,700,400italic&amp;subset=latin,cyrillic-ext,latin-ext,cyrillic">

		<?php include_links(); ?>
		<?php include_stylesheets(); ?>
		<script type="text/javascript" src="<?=base_url()?>assets/frontend/script/jquery.min.js"></script>
		<script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>
		
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125088245-1"></script>
<script>
  var userdata = null;
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125088245-1');
</script>

        <?php if( get_current_page() == 'contact'):?>
        <script>
         var onContactSubmit = function(token) {
          contactForm();
        };

        var onContactloadCallback = function() {
          grecaptcha.render('contact-form-submit', {
            'sitekey' : '6LdSRU8UAAAAAN7B4PWgtMIS-OPGUV3__5h-a-j7',
            'callback' : onContactSubmit
          });
        };
        </script>
            <script src='https://www.google.com/recaptcha/api.js?onload=onContactloadCallback&render=explicit'></script>
            <?php endif;?>
        <?php if($this->session->userdata('logged_user_data')):?>
          <script>
            userdata = <?php echo json_encode($this->session->userdata('logged_user_data')); ?>;
          </script>

        <?php endif; ?>
        <script>
        var $gridheight = [600,248,248,248,248];
        <?php if( get_current_page() != 'home') {
            echo 'var $gridheight = [350,350,350,350,350]';
        }?>
  
         //declare global JS variables here
             var base_url = '<?php echo base_url();?>';
      	</script>
        </script>
    </head>
	
	<body class="page-<?=get_current_page()?>">
    
    <?php echo $content; ?>

		<?php include_javascripts(); ?>
	</body>


</html>