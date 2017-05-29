<?php 
	include 'header.php';
	include 'config.php';

	$db = new Database();

	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	$per_page = isset($_GET['per_page']) && $_GET['per_page'] <= 50 ? (int)$_GET['per_page'] : 10;
	$start = ($page>1) ? ($page*$per_page) - $per_page : 0;

	//just write your query here
	$query = $db->conn->query("SELECT SQL_CALC_FOUND_ROWS * from consumer order by id ASC limit {$start}, {$per_page}") ;
	$data = $query->fetchall(PDO::FETCH_ASSOC);

	$total = $db->conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
	$pages = ceil($total/$per_page);

?>

<div class="">Pagination Test</div>

<div class="container">
	<div class="row" id="">
		<table class="">
			<tr>
				<td><b>id</b></td>
				<td><b>Name</b></td>
				<td><b>Address</b></td>
				<td><b>Email</b></td>
			</tr>
			<?php foreach($data as $person) { ?>
			<tr>				
				<td><?=$person['id'];?></td>
				<td><?=$person['name'];?></td>
				<td><?=$person['address'];?></td>
				<td><?=$person['email'];?></td>							
			</tr>
			<?php } ?>
		</table>
		<div>			
			<ul class="pagination">
				<?php if($page > 1) { $first = 1 ?>
					<li><a href="?page=<?=$first;?>&per_page=<?=$per_page;?>">First</a></li>
				<?php } ?>

				<?php if($page > 1) { $prev = $page-1 ?>
					<li><a href="?page=<?=$prev;?>&per_page=<?=$per_page;?>">Previous</a></li>
				<?php } ?>

			 	<?php for($i = 1;$i <= $pages; $i++) { ?>
				<li><a href="?page=<?=$i;?>&per_page=<?=$per_page;?>"<?php if($page === $i){ echo 'class="selected"';} ?>> <?=$i;?></a></li>
				<?php } ?>

				<?php if($page < $pages) { $next = $page+1 ?>
					<li><a href="?page=<?=$next;?>&per_page=<?=$per_page;?>">Next</a></li> 
				<?php } ?>

				<?php if($page <= $pages) { $last = $pages ?>
					<li><a href="?page=<?=$last;?>&per_page=<?=$per_page;?>">Last</a></li> 
				<?php } ?>
			</ul>			
		</div>
	</div>	
</div>

<?php include 'footer.php'; ?>


