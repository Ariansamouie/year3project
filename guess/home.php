<?php
session_start();
include("db.php");
$title = "Home";
include("header.php");
include("profilenav.php");

function getNotifications($onlymine) {

    global $con;

    $query = "SELECT notifications.user_from
                    ,notifications.user_to
                    ,fixtures.fixture_date
                    ,created_guesses.user_id AS guessing_user
                    ,team1.id AS team1_id
                    ,team2.id AS team2_id
                    ,team1.team_name AS team1 
                    ,team2.team_name AS team2
                    ,users.username AS userfrom
                    ,fixtures.id AS fixture_id
                    ,created_guesses.id AS created_guesses_id

                FROM notifications 
                INNER JOIN created_guesses
                    ON notifications.created_guesses_id = created_guesses.id
                INNER JOIN fixtures
                    ON created_guesses.fixture_id = fixtures.id
                INNER JOIN teams AS team1
                    ON fixtures.team1_id = team1.id 
                INNER JOIN teams AS team2
                    ON fixtures.team2_id = team2.id
                INNER JOIN users
                    ON users.id = notifications.user_from     
                ";

                if($onlymine) {
                    $query = $query."WHERE user_from = ".$_SESSION['user_id'];
                } else {
                    $query = $query."WHERE (user_from = ".$_SESSION['user_id']." OR user_to = ".$_SESSION['user_id'].")";
                }

                $query = $query."
                AND fixtures.fixture_date >= CURDATE() AND notifications.notification_status = 1 OR notifications.user_from = '".$_SESSION['user_id']."'";


                //die($query);

    $result = mysqli_query($con,$query);

    return $result;
}

?>

<div class="container">
    <div class="row">
    	<div class="col-md-12 contbox">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Active Guesses</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Your Created Guesses</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        
<div class="tab-pane fade in active" id="tab1default">

                <div class="">
            <div class="row">
            <div class="col-md-12 panel panel-primary filterable">
            <div class="panel-heading heightadj">
                <h3 class="panel-title">Guesses</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter">Filter</button>
                </div>
            </div>
            <table class="table openbox1">
                <thead>
                    <tr class="filters">
                    
                    <th class="inwidth"><input type="text" class="form-control" placeholder="Created By" disabled></th> 
                    
                    <th><input type="text" class="form-control" placeholder="Games" disabled></th> 
                    
                
                    </tr>
                </thead>
            <tbody>

     <?php
        

    $result = getNotifications(false);


        while ($row = mysqli_fetch_array($result)) { 

                   echo "<tr>
                            <td class='inwidth'><p>".$row['userfrom']."</p></td>
                            <td><p>" .$row['team1']." vs " .$row['team2']."</p></td>
                            <td class='openbox'>
                                <a href='lobby.php?TeamID1=".$row['team1_id']."&TeamID2=".$row['team2_id']."&FixtureID=".$row['fixture_id']."&notify=1&created_guesses_id=".$row['created_guesses_id']."'><i class='fa fa-external-link-square'></i>
                                </a>
                            </td>


                        </tr>";

        }

    ?>


      </tbody>
            </table>
        </div>
    </div>
</div>

        </div>

        <div class="tab-pane fade" id="tab2default">

			<div class="">
    		<div class="row">
        	<div class="col-md-12 panel panel-primary filterable">
            <div class="panel-heading heightadj">
                <h3 class="panel-title">Active Guesses</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter">Filter</button>
                </div>
            </div>
            <table class="table openbox">
                <thead>
                    <tr class="filters">
                    	<th><input type="text" class="form-control" placeholder="Games" disabled></th> 
                    </tr>
                </thead>
            <tbody>

    <?php
        

    $result = getNotifications(true);


        while ($row = mysqli_fetch_array($result)) { 

                   echo "<tr>
                            <td class='inwidth'><p>".$row['userfrom']."</p></td>
                            <td><p>" .$row['team1']." vs " .$row['team2']."</p></td>
                            <td class='openbox'>
                                <a href='lobby.php?TeamID1=".$row['team1_id']."&TeamID2=".$row['team2_id']."&FixtureID=".$row['fixture_id']."&notify=1&created_guesses_id=".$row['created_guesses_id']."'><i class='fa fa-external-link-square'></i>
                                </a>
                            </td>


                        </tr>";

        }

    ?>


   



      </tbody>
            </table>
        </div>
    </div>
</div>
        </div>
                    </div>
                </div>
            </div>
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

	