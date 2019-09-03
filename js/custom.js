 var formdata = `<form class='form-horizontal' method='post' action="dashboard.php" enctype="multipart/form-data">
    <div class='form-group'>
        <label class='control-label col-sm-2' for='email'>Book title</label>
        <div class='col-sm-10'>
            <input type='text' class='form-control' id='email' name='name' placeholder='Enter book name'> </div>
    </div>
    <div class='form-group'>
        <label class='control-label col-sm-2' for='desc'>Description</label>
        <div class='col-sm-10'>
            <input type='text' class='form-control' id='desc' name='desc' placeholder='Enter Book Description'> </div>
    </div>
	<div class='form-group'>
    Select book to upload:
    <input type="file" name="book" id="fileToUpload"></br>
	</div>
	<div class='form-group'>
    Select image to upload:
    <input type="file" name="image" id="fileToUpload">
	</div>

    <div class='form-group'>
        <label class='control-label col-sm-2' for='price'>Book Price</label>
        <div class='col-sm-10'>
            <input type='text' class='form-control' id='price' name='price' placeholder='Enter book price'> </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-10'>
            <button type='submit' name="submit"class='btn btn-primary'>Submit</button>
        </div>
    </div>
</form>`;

	var data = document.getElementById('myfunc');
	const myfunc = ()=> data.innerHTML = formdata;