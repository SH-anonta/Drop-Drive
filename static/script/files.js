// js code for files.php template
// assumes utility.js to be present before execution
// assumes the following static resources to be present
// /filehost/static/image/file_icon.png
// /filehost/static/image/folder_icon.png

(function(){
    var files_table = $('#FilesTable')[0];
    current_dir = $('input[name=parent_folder_path]')[0].value;
    current_dir = current_dir == '/' ? '' : current_dir;
    var file_icon_url = '/filehost/static/image/file_icon.png';
    var folder_icon_url = '/filehost/static/image/folder_icon.png';

    var debug = $('#debug')[0];     // pre element used for debugging 

    // initially null, contains json recieved from server
    // describing the files present in current_dir in users' storage
    var file_detail_list = null;    

	function clearFilesTable(){
        var rows = $('#FilesTable tr');
        deleteElements(rows, 1);
    }


    function createAnchorElement(file_detail){
        //create anchor element
        var file_link = document.createElement('a');
        file_link.innerHTML = file_detail['name'];
        var file_url= '/filehost/files/'+current_dir+file_detail['encoded_name'];
        file_link.setAttribute('href', file_url);

        return file_link;
    }

    function createCheckbox(file_detail){
        checkbox= document.createElement('input');

        checkbox.setAttribute('type', 'checkbox');
        checkbox.setAttribute('class', 'file_selection_chbox');
        checkbox.setAttribute('value', file_detail['encoded_name']);
        
        return checkbox;
    }

    function insertFilesTableRow(file){
        // create empty rows and columns
        var row = files_table.insertRow();
        var checkbox = row.insertCell();    // checkbox for selecting file
        var icon = row.insertCell();
        var name = row.insertCell();
        var size = row.insertCell();
        var last_modified = row.insertCell();;
        
        var file_link = createAnchorElement(file);

        // icon is either folder or file
        icon.innerHTML = '<img class="IconImage" src="'+(file['type'] == 'file' ? file_icon_url : folder_icon_url) + '">';

        //checkbox for selecting file
        checkbox.appendChild(createCheckbox(file));

        name.appendChild(file_link);
        var file_size = file['size'];
        size.innerHTML =  file_size == 0 ? '' : file_size;


    }

    // get a list of file details, and populate the files table with new data
    function reloadFIlesTable(file_list){
        clearFilesTable();
        for(i in file_list){
            insertFilesTableRow(file_list[i]);
        }
    }

    // hook function onRetrievalHook is expected to take one parameter,
    // list of file details 
    function fetchFileList(onRetrievalHook= null){

        function responseHandler() {
            if (this.readyState == 4 && this.status == 200) {
                // debug.innerHTML = this.responseText; // todo remove
                file_detail_list = JSON.parse(this.responseText);

                if(onRetrievalHook){
                    onRetrievalHook(file_detail_list);
                }
            }
            else if(this.status != 200){
                console.log('failed to get file list, status code: ', this.status)
            }
        };

        request = new XMLHttpRequest();
        request.open('POST', '/filehost/file-list', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.onreadystatechange = responseHandler;
        var post_data = 'current_dir='+current_dir;
        
        // console.log(post_data);
        request.send(post_data);
    }
    
    // innitially load files table
    fetchFileList(reloadFIlesTable);
    
})();