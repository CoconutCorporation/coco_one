<!doctype html>

<html>
  <head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript" language="javascript">
      var coordonnes = new Array(100);
      for(i = 1; i <= 100; i++)
         coordonnes[i - 1] = new Array(2);
      //var r_square = Math.random() * 0.9 + 0.1;
      var r_square = <?php $r_square = mt_rand(0,1)/ getrandmax() * 0.9 + 0.1; echo($r_square);?>;//Faire en sorte que r_square soit bon
      document.write("pute" + r_quare);
      function init_var() // https://www.alsacreations.com/article/lire/1402-web-storage-localstorage-sessionstorage.html
      {
          if(typeof localStorage!="undefined") {
            var coord = sessionStorage.getItem("coord"); 
            var obj = JSON.parse(coord);
            if(sessionStorage.getItem("save") != null)
            {
              for(i = 1; i <= 100; i ++)
              {
                coordonnes[i - 1][0] = obj.prop1[i - 1][0];
                coordonnes[i - 1][1] = obj.prop1[i - 1][1];
              }
            }   
          }
      }  

      function save_var()
      {
        var obj = { prop1 : new Array(100)};
        for(i = 1; i <= 100; i++)
        {
          obj.prop1[i - 1] = new Array(2); 
          obj.prop1[i - 1][0] = coordonnes[i - 1][0];
          obj.prop1[i - 1][1] = coordonnes[i - 1][1];
        }

        var obj_json = JSON.stringify(obj);
        sessionStorage.setItem("coord", obj_json);
        sessionStorage.setItem("save", "true");
      }  
      //Calcul de la loi normal inverse : https://blog.developpez.com/philben/p11198/vba-access/approximer_en_double_precision_la_loi_no
      // inverse de la fonction d'erreur complémentaire
      function iefc(proba_cum)
      {
          /*Inverse of complementary error function in double precision 
            http://www.kurims.kyoto-u.ac.jp/~ooura/index.html 
            Copyright(C) 1996 Takuya OOURA : You may use, copy, modify this code for any purpose and without fee. 
            Implementation en VBA par Philben - v1.0 
            Implementation en javascript par BITTEL Axel - v1.0
          */
          var C0 = 1.12648096188977E-03 + 9.22E-18;
          var C1 = 1.05739299623423E-04 + 4.7E-20; 
          var C2 = 0.003512871461291 + 2.5E-19;
          var C3 = 7.7170835895412E-04 + 9.39E-19; 
          var C4 = 6.85649426074558E-03 + 6.12E-18;
          var C5 = 3.39721910367775E-03 + 8.61E-18;
          var C6 = 1.12749169332504E-02 + 8.7E-17;
          var C7 = 1.18598117047771E-02 + 1.04E-17;
          var C8 = 1.42961988697898E-02 + 1.8E-18;
          var C9 = 3.46494207789099E-02 + 9.22E-17;
          var C10 = 2.20995927012179E-03 + 6.7E-19; 
          var C11 = 7.43424357241784E-02 + 8.61E-17;
          var C12 = 0.105872177941595 + 4.88E-16; 
          var C13 = 1.47297938331485E-02 + 1.21E-17;
          var C14 = 0.316847638520135 + 9.44E-16;
          var C15 = 0.71365763586873 + 3.64E-16; 
          var C16 = 1.05375024970847 + 1.38E-15; 
          var C17 = 1.21448730779995 + 2.37E-15;
          var C18 = 1.1637458193156 + 8.31E-15; 
          var C19 = 0.956464974744799 + 6E-18;
          var C20 = 0.686265948274097 + 8.16E-16;
          var C21 = 0.43439749233143 + 1.15E-16; 
          var C22 = 0.24404451059319 + 9.35E-16;
          var C23 = 0.120782237635245 + 2.22E-16;

          var s = 0.0;
          var t = 0.0;
          var w = 0.0;
          var u = 0.0;
          var X = 0.0;
          var z = 0.0;

          if(proba_cum > 1)
            z = 2 - proba_cum;
          else
            z = proba_cum;
 
          w = 0.916461398268964 - Math.log(z); 
          u = Math.sqrt(w);
          s = (Math.log(u) + 0.488826640273108) / w;
          t = 1 / (u + 0.231729200323405); 
          X = u * (1 - s * (s * 0.124610454613712 + 0.5)) - ((((-7.28846765585675E-02 * t + 0.269999308670029) * t + 0.150689047360223) * t + 0.116065025341614) * t + 0.499999303439796) * t; 
          t = 3.97886080735226 / (X + 3.97886080735226); 
          u = t - 0.5 
          s = (((((((((C0 * u + C1) * u - C2) * u - C3) * u + C4) * u + C5) * u - C6) * u - C7) * u + C8) * u + C9) * u + C10 ;
          s = ((((((((((((s * u - C11) * u - C12) * u + C13) * u + C14) * u + C15) * u + C16) * u + C17) * u + C18) * u + C19) * u + C20) * u + C21) * u + C22) * t - z * Math.exp(X * X - C23); 
          X = X + (s * (X * s + 1)) ;
          if(proba_cum > 1)
            return -X; 
          else
              return X;
      }

      function LoiNormaleInverse(proba_cum, esperance, ecartType)
      {
        //Implementation en javascript par BITTEL Axel - v1.0
        if(proba_cum <= 0)
            return -99;
        else if(proba_cum >= 1)
            return 99;
        else
          return (-iefc(proba_cum * 2) * ecartType * Math.sqrt(2) + esperance);
      }
      //création des coordonnées
      function fillCoord() 
      {
        for(i = 1; i <= 100; i ++)
          coordonnes[i - 1][0] = Math.random(); 
          coordonnes[i - 1][1] = Math.random(); 
      }
      //Création de coordonées suivant une loi normale centrée réduite
      function fillCoord_normal()
      {
        for(i = 1; i <= 100; i ++)
        {
          coordonnes[i - 1][0] = -1.0;
          coordonnes[i - 1][1] = -1.0;

          while(coordonnes[i - 1][0] < 0 || coordonnes[i - 1][1] < 0)
          {
            coordonnes[i - 1][0] = -LoiNormaleInverse(Math.random(), 0, 1); 
            coordonnes[i - 1][1] = -LoiNormaleInverse(Math.random(), 0, 1); 
          }
          
        }
      }

      //Calcul de moyenne des abscices 
      function getAverageX()
      {
        var result = 0; 
        for(i = 1; i <= 100; i++)        
          result += coordonnes[i - 1][0]; 
        result /= 100; 
        return result; 
      }
      //Calcul de moyenne des ordonnées 
      function getAverageY()
      {
        var result = 0; 
        for(i = 1; i <= 100; i++)        
          result += coordonnes[i - 1][1]; 
        result /= 100; 
        return result; 
      }
      //Calcul de la variance des abscices 
      function getVarX()
      {
        var result = 0; 
        for(i = 1; i <= 100; i++)        
          result += (coordonnes[i - 1][0] * coordonnes[i - 1][0]); 
        result /= 100; 
        result -= (getAverageX() * getAverageX());
        return result; 
      }
      //Calcul de la variance des ordonnées
      function getVarY()
      {
        var result = 0; 
        for(i = 1; i <= 100; i++)        
          result += (coordonnes[i - 1][1] * coordonnes[i - 1][1]); 
        result /= 100; 
        result -= (getAverageY() * getAverageY());
        return result; 
      }
     //Calcul de la Covariance 
      function getCovariance()
      {
        var result = 0; 
        for(i = 1; i <= 100; i++)        
          result += coordonnes[i - 1][0] * coordonnes[i - 1][1]; 
        result /= 100; 
        result -= (getAverageX() * getAverageY());
        return result; 
      }
      //Calcul du coef de correlation R²
      function getRsquare()
      {
        return (getCovariance() * getCovariance()) / (getVarX() * getVarY());
      }
      //Ajustement des points par rapport au R², création des point V1
      function reduceError(ecart)
      {
        fillCoord();
        var r_graphique = getRsquare();
        while(Math.abs(r_square - r_graphique) >= ecart)
        {
          var number = Math.floor(Math.random() * 99) + 1;
          if(r_square - r_graphique > 0)
          {
            document.write(number);
            document.write(' '); 
            if(coordonnes[number - 1][1] > coordonnes[number - 1][0])
            {
              coordonnes[number - 1][1] -= 0.1;
            }
            else if(coordonnes[number - 1][1] < coordonnes[number - 1][0])
            {
              coordonnes[number - 1][1] += 0.1
            } 
          }
          else if(r_square - r_graphique < 0)
          {
             if(coordonnes[number -1][1] > coordonnes[number - 1][0])
              coordonnes[number - 1][1] += 0.1;
            else if(coordonnes[number - 1][1] < coordonnes[number - 1][0])
              coordonnes[number - 1][1] -= 0.1 
          }   
          r_graphique = getRsquare();   
        }
        return ecart;
      }

      //Transformation des coordonées pour avoir un nuage de point suivant le R aléatoire 
      function generate_point()
      {
        fillCoord_normal();
        for(i = 1; i <= 100; i++)
          coordonnes[i - 1][1] = Math.sqrt(r_square) * coordonnes[i - 1][0] + Math.sqrt(1 - r_square) * coordonnes[i - 1][1]; 
      }

      function draw() 
      {
        var cav = document.getElementById("graphique_cav");
        var cxt = cav.getContext('2d');
        var is_first_passage = <?php if(empty($_POST['resultat']) == false) 
                                        echo json_encode($_POST['resultat']);
                                      else 
                                        echo("null");
                                        ?>;
        if(is_first_passage == "false" || is_first_passage == null) {
          generate_point();
        }
        for(i = 1; i <= 100; i ++)
        {
          cxt.fillRect(coordonnes[i - 1][0]*250 - 3, 500-coordonnes[i - 1][1]*250 - 3, 5, 5);
        }
      }
      
    </script>
  </head>
  
  <body>
    <?php print_r($_POST) ?>
    
    <div id ="global">
      <div id="graphique">
        <div id="graphique_1_0">
          <div id ="ordonnee"></div>
          <canvas id="graphique_cav" width="500" height="500"></canvas>
        </div>
        <div id = "abcisse"></div>
        <div id ="echelle">
          <div id="number_zero"><h7>0</h7></div>
          <div id="number_one"><h7>1</h7></div>
        </div>
      </div>
    </div>
    <canvas id="myChart"></canvas>

    <script type="text/javascript" language="javascript"> 
      init_var();
      draw();
      save_var();
    </script>

    <?php 
      if(empty($_POST['resultat'])  || $_POST['resultat'] == "false")
      {
        echo ('<form name="form" method="post" class="form" action="corr.php">
          <input type="text" name="r_input" id="r_input" value="0.">
          <input type="hidden" name="resultat" value="true"></input>');
         echo('<input type="submit" id="submit" name="oui" value="guess">
        </form>');
      }else{
         //$ecart =  inval($_POST['r_input']);
         echo ('<form name="form" method="post" class="form" action="corr.php">
          <input type="hidden" name="resultat" value="false"></input>
          <input type="submit" name="non" id="submit" value="next">
        </form>');
      }?>
  </body>
</html>