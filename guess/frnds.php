<?php
session_start();
include("db.php");
include( 'functions.php');
checklogin();
$title = "Friends";
include("header.php");

include("profilenav.php");   
?>

    </div>

	<div class="row">   
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	
	    	<div class="contbox">
    		<div class="row">
        	<div class="col-md-12 panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Friends</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter">Search</button>
                </div>
            </div>
            <table class="table openbox1">
                <thead>
                    <tr class="filters">
                    <th class="inwidth"><input type="text" class="form-control" placeholder="Username" disabled></th> 
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

	    	echo "<tr>
                    <td><a href='profile.php?user=$user' class=''>$username</a></td>
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

	