<html>
	<head>
		
	</head>
	<body>		
		
	<?php
	//includkan filekoneksi yang sudah dibuat
	include"koneksi.php";	

		//eksekusi query untuk menampilkan data provinsi
		$sql = "select * from data_provinsi";
		$result = mysqli_query($conn,$sql);	
	?>	

		<select id="s_provinsi">
			<option value="">-- Pilih Provinsi --</option>
			<?php
			//tampilkan data provinsi pada select provinsi
			while($row=mysqli_fetch_assoc($result)){
				echo"<option value=".$row['id_provinsi'].">".$row['nama_provinsi']."</option>";
			}
			?>	
		</select>
   
   		<br>
   		<p id="nilai_return"></p>
		<script src="js/jquery-3.2.1.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				
				// gunakan event jQuery change 	
				$('#s_provinsi').change(function(){
					var id_provinsi = $(this).val(); //dapatkan id provinsi yang dipilih
					$.ajax({ //panggil ajax
						type : 'POST', //tipe yang digunakan adalah post
						url : 'ajax_json.php', //alamat / file tempat eksekusi ajax
						data : 'id_provinsi='+id_provinsi, //data yang dikirim pada url
						success:function(response) { //hasil eksekusi disimpan pada variabel response
							if(response.st==0) { //st=0 yaitu jika provinsi belum punya kabupaten
								alert('Provinsi belum punya kabupaten')
							}

							if(response.st==2) {
								alert('Anda tidak memilih provinsi')
							}							

							$('#nilai_return').text(response.msg); 
						},
						dataType : 'json' // response akan berupa data array json
					});


				});


			});

		</script>
	</body>
</html>
