<!DOCTYPE html>
<html>

<!-- This is the metadata which include the title, the bootstrap framework for design and support for mobile devices --> 
<head>
   <title>Disney Emoji Blitz Sidekick</title>
   <link rel="stylesheet" type="text/css" href="styles.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
   <div class="logo">
      <img src="DisneyEmojiBlitzHeader1.png" alt="Disney Emoji Blitz Sidekick" width="1600" height="200">
   </div>
   <!-- Vistior Counter -->
   <div class="counter"> <span>Visitors:</span>
      <!-- hitwebcounter Code START -->
      <a href="https://www.hitwebcounter.com" target="_blank">
         <img src="https://hitwebcounter.com/counter/counter.php?page=7281366&style=0009&nbdigits=5&type=ip&initCount=0" title="User Stats" Alt="PHP Hits Count" border="0">
      </a>
   </div>
   <div class="Intro">
      <p>
         Confused by all of this? Download Disney Emoji Blitz for free on <a href=https://apps.apple.com/app/id1017551780>Apple devices</a> and <a href=https://play.google.com/store/apps/details?id=com.disney.emojimatch_goo&referrer=utm_source%3Dko_c0035ec2af89f0f79%26utm_medium%3D1%26utm_campaign%3Dkoemoji-blitz-google55a93de56c122358f70aa4b8c1%26utm_term%3D%26utm_content%3D%26>Android devices!</a> </p> <p>
            Are you tired of having to look up what counts as a yellow emoji or a Jewelry wearing emoji for a mission? Do you want to get through two or three missions at once with different mission tags? Then this application is for you! Just enter in the tag, box and/or series and you will get the list of emojis! This will constantly update to add in future emojis!
      </p>
      <p>
         This site's emoji data has been updated to version 45.
      </p>
   </div>
   <div class="News">
      <p> <strong>News: </strong></p>
      <ul>
         <li>
            <p>Site Update (11/__/21): Updated to Version 45. Please note that the following emojis will not appear when searching for Powers: Figment, Pacha, and Ping. This is the final major update to this site
            </p>
            <p>
               IMPORTANT!!!! This site is shutting down on March 29, 2022. Thank you all for your support! 
            </p>
         </li>
      </ul>
   </div>
   <div class="input">
      <form method=get>
         <div class="catSection">
            <div>
               <label for="cat1">First Tag</label>
               <select id="cat1" name="cat1">
                  <option selected="None">None</option>
               </select>
            </div>
            <div>
               <label for="cat2">Second Tag</label>
               <select id="cat2" name="cat2">
                  <option selected="None">None</option>
               </select>
            </div>
            <div>
               <label for="cat3">Third Tag</label>
               <select id="cat3" name="cat3">
                  <option selected="None">None</option>
               </select>
            </div>

            <div>
               <label for="Group">Group</label>
               <select id="Group" name="Group">
                  <option selected="None">None</option>
               </select>
            </div>

            <div>
               <label for="Box">Box</label>
               <select id="Box" name="Box">
                  <option selected="None">None</option>
                  <option value="Silver">Silver</option>
                  <option value="Gold">Gold</option>
                  <option value="Series">Series</option>
                  <option value="Story">Story</option>
                  <option value="Rainbow">Rainbow</option>
                  <option value="Villain">Villain</option>
               </select>
            </div>
                     <!--
            <div>
               <label for="Series">Series</label>
               <select id="Series" name="Series">
                  <option selected="None">None</option>
                  <option value="Standard">Standard</option>
                  <option value="I">I</option>
                  <option value="II">II</option>
                  <option value="III">III</option>
                  <option value="Diamond">Diamond</option>
                  <option value="Group">Group</option>
               </select>
            </div>
            -->
         </div>

         <div class="powerSection">
            <div>
            <label for="power1">Power 1</label>
               <select id="power1" name="power1">
                  <option selected="None">None</option>
               </select>
            </div>
            <div>
            <label for="power2">Power 2</label>
               <select id="power2" name="power2">
                  <option selected="None">None</option>
               </select>
            </div>
            <div>
            <label for="power3">Power 3</label>
               <select id="power3" name="power3">
                  <option selected="None">None</option>
               </select>
            </div>
         </div>
         
         <div>
            <input type="submit" name="compute" id="compute" value="Compute" class="btn btn-primary" />
         </div>
      </form>
   </div>

   <?php

   // How to run on built-in web server: php -S localhost:8000
   require 'vendor/autoload.php';

   use App\SQLiteConnection;

   // When the compute button is hit, get the data from the drop down boxes.

   if (array_key_exists('compute', $_GET)) {
      $input['cat_1'] = $_GET['cat1']; //0
      $input['cat_2'] = $_GET['cat2']; //1
      $input['cat_3'] = $_GET['cat3']; //2
      $input['group'] = $_GET['Group']; //3
      $input['box'] = $_GET['Box']; //4
      $input['pow_1'] = $_GET['power1']; //5
      $input['pow_2'] = $_GET['power2']; //6
      $input['pow_3'] = $_GET['power3']; //7

      //$input['series'] = $_POST['Series'];

      // Create an SQL query to retreive the data
      $sql = 'SELECT DEBTags.Emoji, DEBTags.Box, DEBTags.Emoji_Group';
      $sql_where = ' FROM DEBTags INNER JOIN DEBPowers ON DEBTags.Emoji = DEBPowers.Emoji';
      $where_add = FALSE; //This is for only using one where.

      $powersArray = array();

      echo '<div class = "resultsDisplay"><h2> Your Input: </h2><ul>';
      $key = array_keys($input);
      // Go through each drop down box result and get the value
      for ($i = 0; $i < 8; $i++) {
         if (strcmp($input[$key[$i]], "None") != 0) {
            if ($where_add == FALSE) {
               $where_add = TRUE;
               $sql_where .= ' WHERE ';
            } else {
               $sql_where .= ' AND ';
            }
            if ($i >= 0 and $i <= 2) {
               echo "<li>Tag " . ($i + 1) . ": " . $input[$key[$i]] . "</li>";
               reduceString($input[$key[$i]]);
               $sql_where .= 'DEBTags.' . $input[$key[$i]] . ' = "Yes"';
            } elseif ($i == 3) {
               echo "<li>Group: " . $input[$key[$i]] . "</li>";
               $sql_where .= 'DEBTags.Emoji_Group = "' . $input[$key[$i]] . '"';
            } elseif ($i == 4) {
               echo "<li>Box: " . $input[$key[$i]] . "</li>";
               reduceString($input[$key[$i]]);
               $sql_where .= 'DEBTags.Box = "' . $input[$key[$i]] . '"';
               /*
                echo "<li>Series: " . $input[$key[$i]] . "</li>";
                reduceString($input[$key[$i]]);
                $sql .= 'Series_Category = "' . $input[$key[$i]] . '"';
                */
            } else{
               echo "<li>Power " . ($i - 4) . ": " . $input[$key[$i]] . "</li>";
               reduceString($input[$key[$i]]);
               array_push($powersArray, $input[$key[$i]]);
               $sql .= ', DEBPowers.' . $input[$key[$i]];
               $sql_where .= '( DEBPowers.' . $input[$key[$i]] . '= "All" OR DEBPowers.' . $input[$key[$i]] . ' LIKE "Some%")';

            }
         }
      }



      //If all the drop down boxes are none)
      if ($where_add == FALSE) {
         echo "<li>All Emojis</li>";
      }
      echo "</ul>";

      $sql .= $sql_where . ';';

      //Code for SQL connection
      $pdo = (new SQLiteConnection())->connect();

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();



  echo '<h2> Results: </h2><div class="container">';
  if (empty($result)){
   echo "<ul><li>No Emojis match your input</li></ul>";
  }
  else{
   echo '<table class="table table-responsive-sm table-striped"><thead class="thead-dark"><tr><th>Emoji</th><th>Box</th><th>Group</th>';
   if (count($powersArray) != 0){
      echo '<th>Levels</th>';
   }
   echo '</tr></thead><tbody>';
   foreach ($result as $entry) {
      if (count($powersArray) != 0){
         $levelArray = findEmojiLevels($entry, $powersArray);
         //If there is a match with the levels
         if (count($levelArray) != 0){
            echo '<tr><td>' . $entry['Emoji'] . '</td><td>' . $entry['Box'] . '</td><td>' . $entry['Emoji_Group'] . '</td><td>';
            $levelString = "";
            foreach ($levelArray as $level){
               $levelString .= $level . ', ';
            }
            $lvlStringTrimmed = rtrim($levelString, ', ');
            echo $lvlStringTrimmed . '</td></tr>';
         }
      }
      else{
         echo '<tr><td>' . $entry['Emoji'] . '</td><td>' . $entry['Box'] . '</td><td>' . $entry['Emoji_Group'] . '</td></tr>';
      }
   }
   echo "</tbody></table></div>";
  }
  echo "</div>";
  
}

   //Because the SQL columns (WreckItRalph) are not the dame as the displayed ones (Wreck-It-Ralph), they need to be broken down. 
   function reduceString(&$str)
   {
      $str = preg_replace("/\s/", "_", $str);
      $str = preg_replace("/[-.']/", "", $str);
   }

   // Getting the emoji levels for the powers
   function findEmojiLevels($entry, $powersArray){
      // Only 1 level emojis
      if ($entry['Emoji'] == 'Spirit Mufasa' || $entry['Emoji'] == 'Yen Sid'){
         $numArray = array(1);
      }
      // Only 3 level emojis
      elseif($entry['Box'] == 'Silver' || $entry['Emoji'] == 'The Fairy Godmother' || $entry['Emoji'] == 'Blue Fairy' || $entry['Emoji'] == 'Enchantress' || $entry['Emoji'] == 'Fairy Minnie'){
         $numArray = array(1, 2, 3);
      } else{ //Gold/Series, Story, Villian and Rainbow, all 5 level emojis
         $numArray = array(1, 2, 3, 4, 5);
      }
      for($i = 0; $i < count($powersArray); $i++){
         $value = $entry[$powersArray[$i]];
         if ($value == 'All'){
            continue;
         } else{ //6 is the start point for the Some tag
            $someValue = str_split($entry[$powersArray[$i]]);
            $someValueArray = array();
            for ($j = 6; $j < count($someValue); $j++){
               array_push($someValueArray, $someValue[$j]);
            }
            //Used to remove the levels that don't have the emoji
            $numArray = array_intersect($numArray, $someValueArray);
         }
      }
      return $numArray;
   }

   ?>

   <div class="footer">
      <p>Disclamier: This site is not affilated with The Walt Disney Company or Jam City. All data is based on info reported by reddit <a href="https://www.reddit.com/user/IceJD/">/u/IceJD</a></p>
      <p>Have any questions, concerns, compliments or notice any mistakes? Email me right <a href="mailto:creator@debsidekick.com" target="_top">here!</a></p>
   </div>
   <script src="setListsUp.js"></script>
</body>

</html>