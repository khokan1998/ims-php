<?php
// to give full permission to a folder named files : sudo chmod -R 777 files/


/**

// to pull latest code
git pull origin master

// see local changes (modified OR Untracked)
git status 

--------
git add admin/file_upload.php

git commit -m "sample file upload"

// to push commit changes to remote server.
git push origin master
-------

*/

if ($_POST) {

	print '<pre>' . print_r($_POST, true) . '</pre>';

	print '<pre>' . print_r($_FILES, true) . '</pre>';

	// file upload
	if ($_FILES['image']['error'] == 0) {

		$srcPath = $_FILES['image']['tmp_name'];

		//$destPath = 'files/' . $_FILES['image']['name'];
		$destPath = 'files/abc.jpeg';

		$destPath = 'files/' . time() . '.jpeg';


		$status = move_uploaded_file($srcPath, $destPath);

		var_dump($status);
	}

}

?>

<html>
	<form method="POST" enctype="multipart/form-data">

		<label>Name:</label>
		<input type="text" name="name" value="">



		<label>Image:</label>
		<input type="file" name="image" value="">
		<button type="submit" >Save</button>
	</form>
</html>