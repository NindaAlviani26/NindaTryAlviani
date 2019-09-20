<?php
	include"koneksi.php";

	$id_provinsi = $_POST['id_provinsi']; 

	$data_kabupaten = '';
	$status = 0;

	if($id_provinsi!='') {
		$sql = "select * from data_kabupaten where id_provinsi=".$id_provinsi."";
		$result = mysqli_query($conn,$sql);


		if(mysqli_num_rows($result)>0) {
			$status = 1;
			while($row=mysqli_fetch_assoc($result)){
					$data_kabupaten=$row['nama_kabupaten'].','.$data_kabupaten;
				}
		}
	} else {
		$status=2;
	}

	echo json_encode(array('st'=>$status,'msg'=>$data_kabupaten)); //script kirim data json
?>