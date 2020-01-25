<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "bootcamp"; //boleh diganti database sesuai kebutuhan
$koneksi = mysqli_connect($host, $user, $password, $db);
if(!$db){
	echo "KONEKSI DATABASE GAGAL";
}else{
	// echo "KONEKSI DATABASE BERHASIL";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.content {
			width: 80%;
			margin: 10px auto;
			text-align: center;
		}

		table {
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<div class="content">
		<?php if(!isset($_GET['page']) || isset($_GET['page']) && $_GET['page'] == 'home'){ ?>
			<table border="1" align="center">
				<tr>
					<th>No</th>
					<th>Image</th>
					<th>Title</th>
					<th colspan="3">Action</th>
				</tr>
				<?php
				$query = "SELECT * FROM book_tb";
				$read = mysqli_query($koneksi, $query);
				$no = 1;
				$jum = mysqli_num_rows($read);
				while($data = mysqli_fetch_array($read)){
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td>
							<img height="150px" src="<?php echo $data['img']; ?>">
						</td>
						<td><?php echo $data['name']; ?></td>
						<td>
							<a href="?page=detail&id=<?php echo $data['id']; ?>">Detail</a>
						</td>
						<td>
							<a href="?page=edit&id=<?php echo $data['id']; ?>">Edit</a>
						</td>
						<td>
							<a href="?page=delete&id=<?php echo $data['id']; ?>">Delete</a>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
		<?php
		}else{
			switch($_GET['page']){
				case 'detail':
				$id_detail = $_GET['id'];
				$query_detail = "SELECT b.*, c.name as category_name, w.name as writter_name FROM book_tb b JOIN category_tb c ON b.category_id = c.id JOIN writter_tb w ON b.writter_id = w.id WHERE b.id = $id_detail";
				$read_detail = mysqli_query($koneksi, $query_detail);
				$data_detail = mysqli_fetch_array($read_detail);
				?>
				<h2>Detail Data</h2>
				<table border="1" align="center">
					<tr>
						<td>Title</td>
						<td>:</td>
						<td><?php echo $data_detail['name']; ?>;</td>
					</tr>
					<tr>
						<td>Image</td>
						<td>:</td>
						<td>
							<img height="150px" src="<?php echo $data_detail['img']; ?>">
						</td>
					</tr>
					<tr>
						<td>Category</td>
						<td>:</td>
						<td><?php echo $data_detail['category_name']; ?></td>
					</tr>
					<tr>
						<td>Publication Year</td>
						<td>:</td>
						<td><?php echo $data_detail['publication_year']; ?></td>
					</tr>
					<tr>
						<td>Writter</td>
						<td>:</td>
						<td><?php echo $data_detail['writter_name']; ?></td>
					</tr>
				</table>
				<a href="?page=home">Kembali</a>
				<?php
				break;
				case 'edit':
				$id_edit = $_GET['id'];
				$query_edit = "SELECT b.*, c.name as category_name, w.name as writter_name FROM book_tb b JOIN category_tb c ON b.category_id = c.id JOIN writter_tb w ON b.writter_id = w.id WHERE b.id = $id_edit";
				$edit = mysqli_query($koneksi, $query_edit);
				$data_edit = mysqli_fetch_array($edit);
				//tampil tabel category
				$query_edit_category = "SELECT * FROM category_tb";
				$edit_category = mysqli_query($koneksi, $query_edit_category);
				//tampil tabel writter
				$query_edit_writter = "SELECT * FROM writter_tb";
				$edit_writter = mysqli_query($koneksi, $query_edit_writter);
				?>
				<h2>Edit Data</h2>
				<form method="POST" action="" enctype="multipart/form-data">
					<table border="1" align="center">
						<tr>
							<td>Title</td>
							<td>:</td>
							<td>
								<input type="text" name="title" value="<?php echo $data_edit['name']; ?>">
							</td>
						</tr>
						<tr>
							<td>Image</td>
							<td>:</td>
							<td>
								<img height="150px" src="<?php echo $data_edit['img']; ?>">
								<div>
									<input type="text" name="img" value="<?php echo $data_edit['img']; ?>" placeholder="image url:">
									<!-- <input type="file" name="img" value=""> -->
								</div>
							</td>
						</tr>
						<tr>
							<td>Category</td>
							<td>:</td>
							<td>
								<select name="category" value="<?php echo $data_edit['category_id']; ?>">
									<?php while($dec = mysqli_fetch_array($edit_category)){ ?>
										<option value="<?php echo $dec['id']; ?>" <?php echo ($dec['id'] == $data_edit['category_id']) ? 'selected' : ''; ?> /><?php echo $dec['name']; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Publication Year</td>
							<td>:</td>
							<td>
								<input type="text" name="publication_year" value="<?php echo $data_edit['publication_year']; ?>">
							</td>
						</tr>
						<tr>
							<td>Writter</td>
							<td>:</td>
							<td>
								<select name="writter" value="<?php echo $data_edit['writter_id']; ?>">
									<?php while($dew = mysqli_fetch_array($edit_writter)){ ?>
										<option value="<?php echo $dew['id']; ?>" <?php echo ($dew['id'] == $data_edit['writter_id']) ? 'selected' : ''; ?> /><?php echo $dew['name']; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="3"><button type="submit" name="submit">Kirim</button></td>
						</tr>
					</table>
				</form>
				<a href="?page=home">Kembali</a>
				<?php
				@$title = $_POST['title'];
				@$category = $_POST['category'];
				@$publication_year = $_POST['publication_year'];
				@$writter = $_POST['writter'];
				@$img = $_POST{'img'};
				@$id = $_GET['id'];
				if(isset($_POST['submit'])){
					$query_update = "UPDATE book_tb SET name = '$title', category_id = $category, publication_year = '$publication_year', writter_id = $writter, img = '$img' WHERE id = '$id'";
					$update = mysqli_query($koneksi, $query_update) or die ("ERROR UPDATE DATA");
					if($update){
						header('location:4.php?page=home');
					}
				}
				break;
				case 'delete':
				$delete_id = $_GET['id'];
				$query_delete = "DELETE FROM book_tb WHERE id = $delete_id";
				$data_delete = mysqli_query($koneksi, $query_delete);
				if($data_delete){
					header('location:4.php?page=home');
				}else{
					echo "Gagal Hapus Data";
				}
			}
		}
		?>
	</div>
</body>
</html>