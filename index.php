<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="LibraryStyle.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>

    <body>
        <div class="container">
            <div class="row header"> 
                <div class="col-md-10"> </div>
                <div class="col-md-2 logo">logo</div>
            </div>
            <div class="row Header2">
                <div class="col-md-2 PageTitle"> Page Title </div>
                <div class="col-md-8"></div>
                <div class="col-md-2 SearchBar"> Search Bar</div>
            </div>
            <!-- the middle column is for Bootstrap while the second one is for personal design-->        
            <div class="row NavBar"> 
                <div class="col-md-3">Home</div>
                <div class="col-md-3">Location and Hours</div>
                <div class="col-md-3">Library Services</div>
                <div class="col-md-3">Contact Us</div>

            </div> 

            <div class="row Content">

                <div class ="Box">
                    <div class="row">
                        <div class ="col-md-12">

                            <form action="Results.php" method="post">
                                <div class="form-row">
                                    <div class ="col-md-2">
                                        <label for="searchbook">Keywords:</label> </div>
                                    <div class ="col-md-3">
                                        <select class="form-control" id="search" name="search">

                                            <option id="search" name="search" value="title">Title</option>
                                            <option id="search" name="search" value="author">Author</option>
                                            <option id="search" name="search" value="ISBN">ISBN</option> 
                                        </select> </div>
                                    <div class ="col-md-2">
                                        <label>Search Book:</label> </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="keyword"> </div>
                                    <div class ="col-md-2">
                                        <input class="btn btn-primary" type="submit"> </div></div>
                            </form>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="row Footer"> Footer </div>
        </div>
        <?php
        ?>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
