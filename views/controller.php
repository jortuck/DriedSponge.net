<?php






   $steaminfo = SteamInfo($id);


?>

<!DOCTYPE html>
<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
           
        <?php 
            include("views/includes/meta.php"); 
            ?>
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="description"  content="Name: <?=htmlspecialchars($steaminfo['name']);?>,SteamID64:<?=htmlspecialchars($steaminfo['id64']);?>, SteamID: <?=htmlspecialchars($steaminfo['idn']);?>, SteamID3: <?=htmlspecialchars($steaminfo['id3']);?>, URL:<?=htmlspecialchars($steaminfo['url']);?>" />
        <meta name="keywords" content="<?=htmlspecialchars($steaminfo['name']);?>, <?=htmlspecialchars($steaminfo['id64']);?>, <?=htmlspecialchars($steaminfo['idn']);?>, <?=htmlspecialchars($steaminfo['id3']);?>" />
        <meta property="og:site_name" content="DriedSponge.net | SteamID Finder" /> <!-- Replace with your name or whatever you want-->
        <meta property="og:title" content="Info on <?=htmlspecialchars($steaminfo['name']);?>" />
        <meta property="og:image" content="<?=htmlspecialchars($steaminfo['img']);?>" />
        <meta property="og:image:type" content="image/png" />
        <meta name="author" content="Jordan Tucker">
        <meta property="og:description"  content="SteamID64: <?=htmlspecialchars($steaminfo['id64']);?> SteamID: <?=htmlspecialchars($steaminfo['idn']);?> SteamID3: <?=htmlspecialchars($steaminfo['id3']);?> URL: <?=htmlspecialchars($steaminfo['url']);?>" />
        <meta property="og:site_name" content="<?=htmlspecialchars($steaminfo['name']);?> - driedsponge.net" />
        <title><?=htmlspecialchars($steaminfo['name']);?> - driedsponge.net</title>

        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
       

    </head>
    
 <body>

     <div class="app">
    <div class="container-fluid-lg" style="padding-top: 30px;">
        

        
            <div class="container">
               
                    <hgroup>
                    <h1 class="display-2"><strong>SteamID Tool</strong></h1>
                        <br>
                        
                     <?php
                        include("views/includes/search.php");
                     ?>
                    
                    <br>
                    </hgroup>
                   
                    <div class="text-center">
                    <h2><img style="border-radius: 1em;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.30), 0 8px 22px 0 rgba(0, 0, 0, 0.30);max-width: 150px;" src="<?=htmlspecialchars($steaminfo['img']);?>"/></h2>
                    <br>
                    
                    <h1>Info on <?=htmlspecialchars($steaminfo['name']);?></h1>
                    <br>
                    <table class="table paragraph text-center">
                        <script>
                            $(document).ready(function(){
                                $("#userinfo").removeClass("d-none")
                                $("#loading").hide()
                            })
                        </script>
                        <div id="loading"><div class="text-center"><div class="spinner-border text-primary " role="status"><span class="sr-only">Loading...</span></div><br><p class="paragraph"><b>Loading...</b></p></div></div>
                        <tbody id="userinfo" class="d-none">
                        <?php 
                          $info = array(
                            array("Username",$steaminfo['name'],false),
                            array("SteamID64",$steaminfo['id64'],false),
                            array("SteamID",$steaminfo['idn'],false),
                            array("SteamID3",$steaminfo['id3'],false),
                            array("Profile URL",$steaminfo['url'],true),
                            array("Name",$steaminfo['realname'],false),
                            array("Country",$steaminfo['country'],false)
                            
                          );
                          if(isset($steaminfo['gmsname'])){
                            array_push($info,
                                array("GmodStore Name",$steaminfo['gmsname'],false),
                                array("GmodStore URL",$steaminfo['gmsurl'],true)
                            );
                          }
                          foreach ($info as $value) {
                           
                          if(!$value[2]){

                          
                        ?>
                    
                        <tr>
                        <th scope="row"><?=htmlspecialchars($value[0]);?></th>
                        <td><?=htmlspecialchars($value[1]);?></td>
                        <td><button  onclick="copything('<?=htmlspecialchars($value[1]);?>')" class="btn btn-primary"><i class="far fa-copy"> Copy</i></button></td>
                        </tr>
                    <?php
                    }else{
                        ?>
                        <tr>
                        <th scope="row"><?=htmlspecialchars($value[0]);?></th>
                        <td><a target="_blank" href="<?=htmlspecialchars($value[1]);?>"><?=htmlspecialchars($value[1]);?></a></td>
                        <td><button  onclick="copything('<?=htmlspecialchars($value[1]);?>')" class="btn btn-primary"><i class="far fa-copy"> Copy</i></button></td>
                        </tr>
                        <?php
                    }
                        }
                    ?>
                    
                    </tbody>
                    </table>
                    <br>
                </div>
                    
                    
                       
            



                    

                        </div>
</div>
</div> 
<!-- End of "app" -->






        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="main.js"></script>
        <script>
            AOS.init();
        </script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
        document.getElementById("id64").value = "<?php echo $WHO;?>";

        </script>
        <script>
          function  copything(value){
            

            navigator.clipboard.writeText(value)
            
           toastr["success"](value + " was successfully copied to clipboard", "Congradulations!")

           toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
          }


        </script>
        <script>
          navitem = document.getElementById('steam').classList.add('active')          
        </script>
 </body>






</html>