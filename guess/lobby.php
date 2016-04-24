<?php
session_start();
include("db.php");


if (isset($_GET['action']) && $_GET['action'] == 'Delete') {

    $delcreated_guesses = "DELETE FROM created_guesses WHERE id = ".$_GET['created_guesses_id'];
    mysqli_query($con, $delcreated_guesses);

    $delnot = "DELETE FROM notifications WHERE created_guesses_id = ".$_GET['created_guesses_id'];
    mysqli_query($con, $delnot);

    $delguesses = "DELETE FROM guesses WHERE created_guesses_id = ".$_GET['created_guesses_id'];
    mysqli_query($con, $delguesses);

    


    header( 'location: home.php' );
} else {

}


$title = "Guess";
include("header.php");




$result3a = mysqli_query($con,"SELECT id FROM created_guesses WHERE id = ".$_GET['created_guesses_id']."") or die(mysqli_error());  

        $row3a = mysqli_fetch_array($result3a);



$result2a = mysqli_query($con,"SELECT fixture_id FROM created_guesses WHERE id = ".$row3a['id']."")  or die(mysqli_error()); 


				$row2a = mysqli_fetch_array($result2a);




// find out the fixturedate



$resultfixid = mysqli_query($con,"SELECT * FROM created_guesses WHERE id = ".$_GET['created_guesses_id']."")  or die(mysqli_error()); 


                $rowfixid = mysqli_fetch_array($resultfixid);

$resultfixdate = mysqli_query($con,"SELECT * FROM fixtures WHERE id = ".$rowfixid['fixture_id']."")  or die(mysqli_error()); 


                $rowfixdate = mysqli_fetch_array($resultfixdate);

                $fixturedate = $rowfixdate['fixture_date'];





        $result1a = mysqli_query($con,"SELECT team1_id, team2_id FROM fixtures WHERE id = ".$row2a['fixture_id']."")  or die(mysqli_error()); 

				$row1a = mysqli_fetch_array($result1a);


			// get team names

				$fixture1 = "";

        $result5 = mysqli_query($con,"SELECT * FROM teams WHERE id = ".$row1a['team1_id']." OR id =  ".$row1a['team2_id']."")  or die(mysqli_error()); 



				while($row5 = mysqli_fetch_array($result5)){
					$fixture1 = $fixture1." vs ".$row5['team_name'];

				}

				$fixture1 = substr($fixture1, 4);


    $result3 = mysqli_query($con,"SELECT * FROM created_guesses WHERE id = ".$_GET['created_guesses_id']."") 
                    or die(mysqli_error()); 

        $row3 = mysqli_fetch_array($result3);

    $resultuser = mysqli_query($con,"SELECT * FROM users WHERE id = ".$row3['user_id']."") 
                    or die(mysqli_error()); 

        $rowuser = mysqli_fetch_array($resultuser); 


        $usermade = $rowuser['username'];


$resultgetuser = mysqli_query($con,"SELECT * FROM users WHERE (id = ".$_SESSION['user_id'].") ") or die(mysqli_error()); 

    $rowgetuser = mysqli_fetch_array($resultgetuser);

    $userdel = $rowgetuser['username'];


    if ($usermade == $userdel) {
?>
       <style type="text/css">
            .delbutt
            {
                display:block;
            }
        </style>
<?php

    } else{
?>
        <style type="text/css">
            .delbutt
            {
                display:none;
            }
        </style>
<?php
    }
?>
				
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 usercreate">
                <?php echo " <h2> ".$usermade." </h2> "; ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 delbutt">
            <!-- if user created the lobby then show the delete button -->
            <form action="lobby.php" method='GET'>
            <input type="hidden" name="created_guesses_id" value="<?php echo $_GET['created_guesses_id']; ?>">
                <input type="submit" value="Delete"  name="action" onclick="return confirm('Are you sure you want to Delete This Guess Lobby?');"/>
            </form>
            </div>
        </div>



				<div class="contbox">
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $fixture1; ?>  <span> <?php echo $fixturedate; ?> </span></h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter">Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                    	<th><input type="text" class="form-control" placeholder="Name" disabled></th>
                    	<th><input type="text" class="form-control" placeholder="Player" disabled></th>
                    	<th><input type="text" class="form-control" placeholder="Team" disabled></th>                      
                       
                        
                    </tr>
                </thead>
            <tbody>
                    
    <?php

	$result6 = mysqli_query($con,"SELECT guesses.created_guesses_id, users.id, users.username, players.name, players.player_id, teams.team_name FROM guesses INNER JOIN users ON guesses.user_id = users.id INNER JOIN players ON guesses.first_scorer = players.player_id INNER JOIN teams ON players.team_id = teams.id WHERE created_guesses_id = ".$_GET['created_guesses_id']."") 
		or die(mysqli_error()); 

				while($row6 = mysqli_fetch_array($result6)){
				?>



                       <?php 

                       echo "<tr>
                       			<td>" .$row6['username']."</td>
                       			<td>" .$row6['name']."</td>
                       			<td>" .$row6['team_name']."</td>
                       		</tr>";
                       	?>
                    
                    	
                       	<?php 	} ?>
         
                </tbody>
            </table>
        </div>
    </div>
</div>







<script type="text/javascript">

$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});





</script>



<?php 
include("footer.php");
?>