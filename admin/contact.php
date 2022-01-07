<?php
    if(isset($_GET['action'])): ?>

<?php 
    if($_GET['action'] == "insert"):
        header('Location: /contact.php');
    elseif($_GET['action'] == "show"): ?>

<?php
	include $_SERVER['DOCUMENT_ROOT']."/control/control.php";
	session_start();
	$contact = new Contacts();
	
?>

<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>contact List</title>
	<link rel="stylesheet" href="/css/style.css" type="text/css">
	<link rel="stylesheet" href="/css/custom.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/script/moveRow.js"></script>

	
    <!-- This will overwrite the submit button and use ajax to insert new contact
	
    
	<script>
        $(document).ready(function () {
            $('#myform').on('submit', function(e) {
                e.preventDefault();
				var values = $(this).serialize();
                $.ajax({
                    url : '/control/contact.php',
                    type: "POST",
                    data: values,
                    success: function(msg) {
                        alert('Email Sent');
                    }   
                });
            });
        });
    </script>
	-->

	<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<a href="/trang1.php">Zero Type</a>
			</div>
			<ul id="navigation">
				<li>
					<a href="/trang1.php">Home</a>
				</li>
				<li>
					<a href="/features.php">Features</a>
				</li>
				<li>
					<a href="/contact.php">News</a>
				</li>
				<li>
					<a href="/about.php">About</a>
				</li>
				<li>
					<a href="/contact.php">Contact</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents" style="width: 90%;">
		<div id="tagline" class="clearfix">
		<?php
			
			if(isset($_SESSION['username'])):?>

			<?php 
				if((new Users())->validate($_SESSION['username'], $_SESSION['password'])):?>

            <br>
            <table id="tb" class="table table-blue user-table" style="overflow: hidden;">
                <thead>
                    <tr>
						<th style="max-width: 5%;  width: 5%;"  >ID</th>
                        <th style="max-width: 20%; width: 20%;" >Name</th>
                        <th style="max-width: 15%; width: 15%;" >Email</th>
                        <th style="max-width: 10%; width: 10%;" >Sub</th>
                        <th style="max-width: 35%; width: 35%;" >Content</th>
                        <th style="max-width: 20%; width: 20%;" >Actions</th>
                    </tr>
                </thead>
				<tbody>

				<?php 
                //Set the next row element to $contact_form
                ob_start(); ?>
                
                <tr id="formRow" style="display: none;" style="width: 90%;">
                    <form id="myform" method="POST" action="/control/contact.php">
					<td><input type="text" name="id" value="ID" id="ContactID" onFocus="this.select();" onMouseOut="javascript:return false;" style="width: 2em;;" readonly="readonly"/></td>
                    <td><input type="text" name="name" value="Title" id="ContactName" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
                    <td><input type="text" name="email" value="Author" id="ContactEmail" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
                    <td><input type="text" name="sub" value="Date" id="ContactSub" onFocus="this.select();" onMouseOut="javascript:return false;"/></td>
                    <td><textarea name="content" id="ContactContent" ></textarea></td>
                    <td>
						<input type="submit" name="update" id="update" value="Update"/>
						<input type="submit" name="delete" id="delete" value="Delete"/>
						<button type="button" id="cancel" style="display: none;" onclick="cancelBtnClick()">Cancel</button>
					</td>
                    </form>

                    
                </tr>

				<?php 
					$contact_form = ob_get_clean(); 
					echo $contact_form;
				?>

                <?php
                    $contact_list = (new Contacts())->select();
                    foreach($contact_list as $contact): ?>
                        <tr id="Row<?=$contact['ID_contact'] ?>">
                            <td><p><?=$contact['ID_contact'] ?></p></td>
                            <td><p><?=$contact['name']?></p></td>
                            <td><p><?=$contact['email']?></p></td>
                            <td><p><?=$contact['sub']?></p></td>
                            <td><p><?=$contact['content']?></td>
                            <td>
								<button class="contactUpdateBtn" value="<?=$contact['ID_contact'] ?>" onclick="updateContactBtnClick(this)">Update</button>
								<button class="contactDeleteBtn" value="<?=$contact['ID_contact'] ?>" onclick="deleteContactBtnClick(this)">Delete</button>
                            </td>
                        </tr>
                <?php endforeach;?>
				</tbody>
            </table>
			
			<?php 
				else:?>
				<h1>Wrong username/password</h1>
				<h2>You will be redirect back in <span id="time-left"></span> second(s)</h2>
				<script>
					i = 5000;
					elm = document.getElementById("time-left");
					elm.innerHTML = i/1000;
					setTimeout(function(){
						window.location.replace("http://localhost/login.php");
					}, i);
					setInterval(function(){
						i = i - 1000;
						elm.innerHTML = i/1000;
					}, 1000);
				</script>
			<?php endif ?>

		</div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© 2023 Zerotype. All Rights Reserved.
			</p>
		</div>
	</div>

	<script>
		function updateContactBtnClick(button)
		{
			console.log(button.value);
			var contactID;
			//get data about contact from /control/contact.php and put them in form
			$.getJSON(
				"/control/contact.php",
				{
					id : button.value,

				},
				function(data) {
					document.getElementById("ContactID").value = data.ID_contact;
					document.getElementById("ContactName").value = data.name;
					document.getElementById("ContactEmail").value = data.email;
					document.getElementById("ContactSub").value = data.sub;
					document.getElementById("ContactContent").value = data.content;
				}
			);
			moveRow(document.getElementById("tb"), document.getElementById("formRow").rowIndex - 1, document.getElementById("Row"+button.value).rowIndex - 1, true);
			
			document.getElementById("formRow").style.display = "table-row";
			document.getElementById("Row" + button.value).style.display = "none";

			document.getElementById("delete").style.display = 'none';
			document.getElementById("cancel").style.display = 'inline-block';
		}

		function cancelBtnClick()
		{
			document.getElementById("cancel").style.display = 'none';
			document.getElementById("delete").style.display = 'inline-block';
			
			document.getElementById("formRow").style.display = 'none';
			id = document.getElementById("contactID").value;
			document.getElementById("Row"+id).style.display = 'table-row';
		}

		function deleteContactBtnClick(button)
		{
			console.log(button.value)
			var id = button.value
			$.ajax({
				url : '/control/contact.php',
				type: "POST",
				data: {
					id: button.value,
					delete: 'delete'
				},
				success: function(msg) {
					alert('Deleted');
					button.parentNode.parentNode.parentNode.removeChild(button.parentNode.parentNode);
				}   
			});
		}
	</script>
</body>
</html>
<?php 
	else: ?>
	<h1>Please log in again</h1>
	<h2>You will be redirect back in <span id="time-left"></span> second(s)</h2>
	<script>
		i = 5000;
		elm = document.getElementById("time-left");
		elm.innerHTML = i/1000;
		setTimeout(function(){
			window.location.replace("http://localhost/login.php");
		}, i);
		setInterval(function(){
			i = i - 1000;
			elm.innerHTML = i/1000;
		}, 1000);
		
		
	</script>
	<?php
	endif; 
?>

<?php endif?>
<?php endif ?>