<?php
session_start();
include("db.php");
$title = "Guess";
include("header.php");
include("profilenav.php");
?>
<div class="contbox">
    		<div class="row">
        	<div class="col-md-12 panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Notifications</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter">Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                    
                    <th class="inwidth"><input type="text" class="form-control" placeholder="Created By" disabled></th> 
                    
                    <th><input type="text" class="form-control" placeholder="Games" disabled></th> 
                    
                    

                    </tr>
                </thead>
            <tbody>

<?php
 		$result3a = mysqli_query($con,"SELECT * FROM notifications WHERE user_to = ".$_SESSION['user_id']." AND notification_status = 0")  or die(mysqli_error());  


		while ($row3a = mysqli_fetch_array($result3a)) { 

			$result2a = mysqli_query($con,"SELECT fixture_id FROM created_guesses WHERE id = ".$row3a['created_guesses_id']."")  or die(mysqli_error()); 

            $result2b = mysqli_query($con,"SELECT user_id FROM created_guesses WHERE id = ".$row3a['created_guesses_id']."")  or die(mysqli_error());


				$row2a = mysqli_fetch_array($result2a);
                $row2b = mysqli_fetch_array($result2b);


            $resultuser = mysqli_query($con,"SELECT * FROM users WHERE id = ".$row2b['user_id']."") 
                    or die(mysqli_error()); 

                $rowuser = mysqli_fetch_array($resultuser); 
				

			$result1a = mysqli_query($con,"SELECT team1_id, team2_id FROM fixtures WHERE id = ".$row2a['fixture_id']."")  or die(mysqli_error()); 

				$row1a = mysqli_fetch_array($result1a);


			// get team names

			$result5 = mysqli_query($con,"SELECT * FROM teams WHERE id = '".$row1a['team1_id']."' OR id =  '".$row1a['team2_id']."'")  or die (mysqli_error($con)); 



				while($row5 = mysqli_fetch_array($result5)){
					$fixture1 = $fixture1." vs ".$row5['team_name'];

				}

				$fixture1 = substr($fixture1, 4);

                $usermade = $rowuser['username'];

		 ?>

		<?php
			

			echo "<tr>
               			<td><p>".$usermade."</p></td>
               			<td><p>" .$fixture1."</p></td>
   						<td>
   							<a href='makeaguessfirstchoose.php?TeamID1=".$row1a['team1_id']."&TeamID2=".$row1a['team2_id']."&FixtureID=".$row2a['fixture_id']."&notify=1&created_guesses_id=".$row3a['created_guesses_id']."'>Make a Guess</a>
   						</td>


                  </tr>";

              ?>


<?php 
$fixture1 = "";

}  ?> 

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
