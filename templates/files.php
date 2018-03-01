<!DOCTYPE html>
<?php
// This template allows users to view folders and files in their storage

//This file assumes the following variables are declaired
// $_current_dir -> string containing the which file the user wants to get
// $_file_list  -> array of filenames in current_directory
?>

<head>
    <title>Files</title>
</head>

<body>
    <?php
        // show header
        require('fragments/header.php');
        printf('Directory: %s', $_current_dir);
    ?>

    <form action="/filehost/upload" method="POST">
        <input type="file" name="file">
        <input type="hidden" name="parent_folder_path" value="<?php echo $_current_dir?>">
        <button type="submit">Upload</button>
    </form>

    <h3>Files:</h3>

    <table>
        <th>Name</th>
        <th>Type</th>
        <?php
            
            // todo: file urls contain double slash '//' for first level sub directories
            foreach($_file_list as $file){
                echo '<tr>';
                    echo '<td>';
                        printf('<a href="/filehost/files/%s/%s">%s</a>', $_current_dir, $file, $file);
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </table>

</body>
</html>