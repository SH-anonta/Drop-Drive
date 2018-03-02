<!DOCTYPE html>
<?php
// This template allows users to view folders and files in their storage

//This file assumes the following variables are declaired
// $_current_dir -> string containing the which file the user wants to get
// $_file_list  -> array of filenames in current_directory
?>

<head>

    <title>Files</title>

<style>
    #MainBody{
        width: 70%;
        float: left;
        min-height: 200px;
    }

    #SideBar{
        width: 30%;
        display: inline;
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

        <table>
            <th>Name</th>
            <?php
                
                // todo: file urls contain double slash '//' for first level sub directories
                foreach($_file_list as $file){
                    echo '<tr>';
                        echo '<td>';
                            printf('<a href="/filehost/files/%s/%s">%s</a>', $_current_dir, $file, urldecode($file));
                        echo '</td>';
                    echo '</tr>';
                }
            ?>
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


</body>
</html>