<?php
session_start();
?>
<?php
    include 'dbconnect.php';
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Planning</title>
</head>

<body>
  <?php include('header.php'); ?>  

  <div id="calendar">

    <h1>Planning de la semaine</h1>

  <?php 
      

      $request=$mysqli->query(" SELECT * from utilisateurs inner join reservations on utilisateurs.id = reservations.id_utilisateur where week(debut) = week(curdate())");
      $result=$request->fetch_all();
      //var_dump($result);
      echo count($result);

  /*-----------function pour convertir date au format datetime en SQL en jour de la semaine--------*/
    function convertDate($tempDate){
        $day_of_weeks = date('N', strtotime( $tempDate));
        $tempHeure = date('H', strtotime( $tempDate));      
        //transforme chiffre obtenu avec 'N' en jour de la semaine et en ajoutant l'heure.
        if ($day_of_weeks==1){
          $day_of_weeks="Lundi $tempHeure.h00";
        }elseif ($day_of_weeks==2){
          $day_of_weeks="Mardi $tempHeure"."h00";
        }elseif ($day_of_weeks==3){
          $day_of_weeks="Mercredi $tempHeure"."h00";
        }elseif ($day_of_weeks==4){
          $day_of_weeks="Jeudi $tempHeure"."h00";
        }elseif ($day_of_weeks==5){
          $day_of_weeks="Vendredi $tempHeure"."h00";
        }elseif ($day_of_weeks==6){
          $day_of_weeks="Samedi $tempHeure"."h00";
        }elseif ($day_of_weeks==7){
          $day_of_weeks="Dimanche $tempHeure"."h00";
        }
        $tempdate = $day_of_weeks;
        return $tempdate;
    }
  $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];
  ?>
  <table>
    <thead>
        <tr>
            <td>Horaire / Jours</td>
            <?php 
            foreach ($days as $jour) {
            echo "<td>".$jour."</td>"; 
            }?>
        </tr>
    </thead>
    <tbody>
        <?php
            for ($i = 8; $i <= 19; $i++){
                echo "<tr>";
                if($i<10){
                  $i="0".$i;
                }
                echo '<td class="horaire">'.$i.'h00</td>';
                for ($j = 0; $j <= 4; $j++){
                    echo "<td>";
                    $datetime= "$days[$j] ".$i."h00";
                    //echo $datetime;
                    $a=0;
                    while($a <= count($result)){
                      for($b=0;$b<=7; $b++){
                        if ($b==6){
                          if (convertDate($result[$a][$b])==$datetime){
                            echo '<div id="even">';
                            echo $result[$a][1]."<br>";
                            echo $result[$a][4]."<br>";
                            $n_id=$result[$a][3];
                            echo "<a href='reservation.php?id=$n_id' title='GET'>Détails</a>";
                           
                            echo '</div>';
                            break;
                          }
                        }
                      }
                      $a++;
                      }
                    echo "<br>";
                    echo "</td>";
                }
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
</div>

  
  <?php include('footer.php'); ?>
</body>

