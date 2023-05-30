<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=baumControl_exportado_" . date('Y:m:d:m:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");
	session_start();
	$id = $_SESSION['id'];

	include("../include/bbddconexion.php");
	
	$output = "";
	
	if(ISSET($_REQUEST['export'])){
		$output .="
			<table>
				<thead>
					<tr>
						<th>Estado</th>
						<th>Obra</th>
						<th>Fecha</th>
						<th>Horas</th>
					</tr>
				<tbody>
		";
		$query = "select * from hours where user_id=$id; ";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
		while($fetch = mysqli_fetch_array($query)){
			
		$output .= "
					<tr>
						<td>".$fetch['status']."</td>
						<td>".$fetch['work_id']."</td>
						<td>".$fetch['date']."</td>
						<td>".$fetch['hour']."</td>
					</tr>
		";
		}
		
		$output .="
				</tbody>
				
			</table>
		";
		
		echo $output;
	}
	
?>