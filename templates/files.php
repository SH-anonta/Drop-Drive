<!DOCTYPE html>
<?php
// This template allows users to view folders and files in their storage

//This file assumes the following variables are declaired
// $_current_dir -> string containing the which file the user wants to get
// $_file_list  -> array of filenames in current_directory
?>

<head>

    <title>Files</title>

    <link rel="stylesheet" href="/filehost/static/style/global.css">
<style>
    #MainBody{
        width: 60%;
        float: left;
        min-height: 200px;
    }

    #SideBar{
        width: 40%;
        display: inline;
    }

    #FilesTable a{
        text-decoration: none;
    }

    #FilesTable td{
        min-width: 30px;
    }

    #FilesTable > tr{
	    margin-top: 30px;
        border-width: thin;
        border-bottom-style: solid;
    }
</style>

</head>

<body>
    <?php
        // show header
        require('fragments/header.php');
        printf('Directory: %s', urldecode($_current_dir));
        echo '<br>';
    ?>

    <div id="MainBody">
        <h3>Files:</h3>

        <table id="FilesTable">
            <tr>
                <th></th>
                <th>Name</th>
                <th>size</th>
            </tr>
            
        </table>
    </div>

    <div id="SideBar">
        <h3>Upload file:</h3>
        <form action="/filehost/upload" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="hidden" name="parent_folder_path" value="<?php echo $_current_dir?>/">  
            <button type="submit">Upload</button>
        </form>
                
        <br>
        <br>
        <h3>Create folder</h3>
        <form action="/filehost/mkdir" method="POST">
            <input type="hidden" name="parent_folder_path" value="<?php echo $_current_dir?>/">  
            <input required name="folder_name" placeholder="Folder name">
            <button type="submit">Create</button>
        </form>

    </div>

    <pre id="debug"></pre>
<script type="text/javascript" src="/filehost/static/script/utility.js"></script>
<script type="text/javascript" src="/filehost/static/script/files.js"></script>
           
    
</body>
</html>