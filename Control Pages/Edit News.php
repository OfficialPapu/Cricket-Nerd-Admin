<?php
session_name();
session_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';
if(isset($_GET['NewsID'])){
    $NewsID=$_GET['NewsID'];
}else{
    die();
}
$NewsData = $conn->query("SELECT * FROM `news` WHERE ID='$NewsID'")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
    <link rel="stylesheet" href="Assets/CSS/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Quill.css">
</head>

<body>
    <div class="max-w-4xl mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
        <form id="newsForm">
            <h1 class="mb-6 text-2xl text-center text-teal-800">Edit News</h1>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" htmlFor="title">Title</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" name="Title" value="<?php echo $NewsData['Title'];?>"/>
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" htmlFor="title">Author</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" name="Author" value="<?php echo $NewsData['Author'];?>" />
            </div>


            <div class="description">
                <p class="block mb-2 font-bold text-teal-900">Description</p>
                <div id="editor" style="height: 400px;"><?php echo $NewsData['Description'];?></div>
                <textarea id="Description" style="display: none;" name="Description"></textarea>
            </div>
       
            <button class="mt-8 w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800">Submit</button>
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="Assets/JS/butterup.min.js"></script>
<script src="Assets/JS/Quill.js"></script>
<script>
   $('#newsForm').on('submit', function (e) {
    e.preventDefault();
    // Get the form data
    let Title = $("input[name='Title']").val();
    let Author = $("input[name='Author']").val();
    let Description = quill.root.innerHTML; 

    $.ajax({
        type: "POST",
        url: "Assets/PHP/Configuration/UpdateNews.php", 
        data: {
            UpdateNews: true,
            NewsID: <?php echo $NewsID; ?>, 
            Title: Title,
            Author: Author,
            Description: Description
        },
        success: function (response) {
            response = response.trim(); 
            if (response === 'Success') {
                butterup.toast({
                    message: 'News Updated Successfully!',
                    icon: true,
                    dismissable: true,
                    type: 'success'
                });
            } else {
                butterup.toast({
                    message: 'Failed to Update News.',
                    icon: true,
                    dismissable: true,
                    type: 'error'
                });
            }
        },
        error: function () {
            butterup.toast({
                message: 'There was an error processing the request.',
                icon: true,
                dismissable: true,
                type: 'error'
            });
        }
    });
});


let toolbarOptions = [
    ["bold", "italic", "underline"],
    ["blockquote", "code-block", "image"],

    [{ header: 1 }, { header: 2 }],
    [{ list: "ordered" }, { list: "bullet" }],
    [{ script: "sub" }, { script: "super" }],
    [{ indent: "-1" }, { indent: "+1" }],

    [{ size: ["small", false, "large", "huge"] }],
    [{ header: [1, 2, 3, 4, 5, 6, false] }],

    [{ color: [] }, { background: [] }],
    [{ font: [] }],
    [{ align: [] }],

    ["clean"],
];

let quill = new Quill("#editor", {
    theme: "snow",
    placeholder: 'Start typing here...',
    modules: {
        toolbar: {
            container: toolbarOptions,
        }
    }
});

function imageHandler() {
    const input = document.createElement("input");
    input.setAttribute("type", "file");
    input.setAttribute("accept", "image/*");
    input.setAttribute("multiple", true);
    input.click();

    input.onchange = () => {
        const files = input.files;
        if (files) {
            Array.from(files).forEach((file) => {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('UploadDescImages', true);

                fetch('Assets/PHP/Configuration/Common Function.php', {
                    method: 'POST',
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            // Get the image URL from the response
                            const imageUrl = data.imageUrl;
                            const range = quill.getSelection();
                            quill.insertEmbed(range.index, 'image', imageUrl);
                            quill.setSelection(range.index + 1);
                        } else {
                            console.error("Image upload failed");
                        }
                    })
                    .catch((error) => {
                        console.error("Error uploading image:", error);
                    });
            });
        }
    };
}

</script>

</html>