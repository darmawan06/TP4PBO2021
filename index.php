<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// insert data
if(isset($_POST['add'])){
	$id = $_POST['ID'];
	$nama = $_POST['NAMA'];
	$alamat = $_POST['ALAMAT'];
	$jenislensa = $_POST['JENISLENSA'];
	$wakturental = $_POST['WAKTU'];

	$otask->insertTask($id, $nama, $alamat, $jenislensa, $wakturental, "Belum Bayar");

	header('Location: index.php');
}

// delete data
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$otask->delete($id);


        header('Location: index.php');
}

if(isset($_GET['update'])){
	$id = $_GET['update'];
	$otask->update($id);

	header('Location: index.php');
}

$otask->getTask();

$data = null;
$no = 1;

while (list($id, $nama,  $alamat, $jenislensa, $waktu, $status) = $otask->getResult()) {
	if($status == "Sudah Bayar"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $id . "</td>
		<td>" . $nama . "</td>
		<td>" . $alamat . "</td>
		<td>" . $jenislensa . "</td>
		<td>" . $waktu . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?delete=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $id . "</td>
		<td>" . $nama . "</td>
		<td>" . $alamat . "</td>
		<td>" . $jenislensa . "</td>
		<td>" . $waktu . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?delete=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?update=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}


$tpl = new Template("templates/skin.html");

$otask->close();


$tpl->replace("DATA_TABEL", $data);

$tpl->write();
