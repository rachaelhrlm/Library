<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="Style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Registration Form</h1>
        <form action="RegisterResults.php" method="post">
            <div class="form-group"> 
                <label for="Email" >Email:</label>
                <input type="Email" name="Email" class="form-control" id="Email" placeholder="Email" required autofocus>  
            </div>
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="Password" name="Password" class="form-control" id="Password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="FirstName">First Name:</label>
                <input type="text" name="FirstName" class="form-control" id="FirstName" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <label for="SecondName">Second Name:</label>
                <input type="text" name="SecondName" class="form-control" id="SecondName" placeholder="Second Name" required>
            </div>
            <div class="form-group">
                <label for="Postcode">Postcode:</label>
                <input type="text" name="Postcode" class="form-control" id="Postcode" placeholder="Postcode" required>
            </div>
            <div class="form-group">
                <label for="DOB">Date of Birth:</label>
                <input type="date" name="DOB" class="form-control" id="DOB" placeholder="Date of Birth" required>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        
    </form>;


    <?php
    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
