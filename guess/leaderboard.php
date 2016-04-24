<?php
session_start();
include("db.php");
include( 'functions.php'); 
$title = "Home";
include("header.php");
include("profilenav.php");

?>



<div class="container">
<div class="row">
<div class="col-md-12 contbox">
<div class="panel with-nav-tabs panel-default">
<div class="panel-heading">
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab1default" data-toggle="tab">Friends</a></li>
	<li><a href="#tab2default" data-toggle="tab">World</a></li>
</ul>
</div>
<div class="panel-body">
<div class="tab-content">
                        
<div class="tab-pane fade in active" id="tab1default">

<div class="">
<div class="row">
<div class="col-md-12 panel panel-primary filterable">

<div class="panel-heading heightadj">
    <h3 class="panel-title">Users</h3>
    <div class="pull-right">
        <button class="btn btn-default btn-xs btn-filter">Filter</button>
    </div>
</div>

<table class="table openbox1">

	    <thead>
	        <tr class="filters">
	        
	        <th class="inwidth"><input type="text" class="form-control" placeholder="Name" disabled></th>
	        <th><input type="text" class="form-control" placeholder="Score" disabled></th>
	        </tr>
	    </thead>

	<tbody>

		<?php

	    	$my_id = $_SESSION['user_id'];
	    	$frnd_query = mysqli_query($con,"SELECT user_one, user_two FROM frnds WHERE user_one='$my_id' OR user_two='$my_id'");
	    	while($run_frnd = mysqli_fetch_array($frnd_query)){
	    		$user_one = $run_frnd['user_one'];
	    		$user_two = $run_frnd['user_two'];
	    		if($user_one == $my_id){
	    			$user = $user_two;
	    		} else {
	    			$user = $user_one;
	    		}
	    		$username = getuser($user, 'username');
	    		$userscore = getuser($user, 'user_score');
	    		

	    	echo "<tr>
                    <td><a href='profile.php?user=$user'>$username</a></td>
                    <td>$userscore</td>
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
	<h3 class="panel-title">Users</h3>

	<div class="pull-right">
	<button class="btn btn-default btn-xs btn-filter">Filter</button>
	</div>
</div>

<table class="table openbox">

	<thead>
		<tr class="filters">
		<th class="inwidth"><input type="text" class="form-control" placeholder="Name" disabled></th>
		<th><input type="text" class="form-control" placeholder="Score" disabled></th>
		</tr>
	</thead>

	<tbody>

		<?php

		$leader = mysqli_query($con,"SELECT * FROM users ORDER BY user_score DESC") 
                    or die(mysqli_error()); 

        while ($row = mysqli_fetch_array($leader)) { 

        $username1 = $row['username'];
        $userscore1 = $row['user_score'];
        $user=$user1 = $row['id'];

        echo "<tr>
                    <td><a href='profile.php?user=$user1'>$username1</a></td>
                    <td>$userscore1</td>
                  </tr>";
        }
		?>


	</tbody>
</table>
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

	