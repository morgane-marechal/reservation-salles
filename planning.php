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

  <?php 
  $tempDate = '2022-12-21 10:00:00';
  //$tempHeure = date('H', strtotime( $tempDate));
  //echo $tempHeure."<br>";
  //$day_of_weeks = date('N', strtotime( $tempDate));
  //echo $day_of_weeks;

  
  /*-----------function pour convertir date au format datetime en SQL en jour de la semaine--------*/
  function convertDate($tempDate){
    $day_of_weeks = date('N', strtotime( $tempDate));
    $tempHeure = date('H', strtotime( $tempDate));
    //echo $day_of_weeks."<br>";
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
    return $day_of_weeks;
  }
  echo "repère après fonction<br>";
  echo convertDate($tempDate);
  //echo $day_of_weeks;

  //echo date('N', strtotime( $tempDate));

  $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
  ?>
  <table>
    <thead>
        <tr>
            <td>Horaire / Jours</td>
            <td>Lundi</td>
            <td>Mardi</td>
            <td>Mercredi</td>
            <td>Jeudi</td>
            <td>Vendredi</td>
            <td>Samedi</td>
            <td>Dimanche</td>
        </tr>
    </thead>
    <tbody>
        <?php
            for ($i = 8; $i <= 19; $i++){
                echo "<tr>";
                echo '<td class="horaire">'.$i.' h00</td>';
                for ($j = 0; $j <= 6; $j++){
                    if($j <=4){
                    echo "<td>";
                    echo "$days[$j] ".$i."h00";
                    echo "</td>";
                    }else{
                      echo '<td class="weekend">';
                      echo "Indisponible";
                      echo '</td>';
                    }
                }
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
</div>

  
  <?php include('footer.php'); ?>
</body>

