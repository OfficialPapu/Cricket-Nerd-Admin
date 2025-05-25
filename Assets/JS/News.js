$(document).ready(function () {
    const urlpost = "Assets/PHP/API/POST/News.php";

    
    $('#newsForm').submit(function (e) {
        e.preventDefault();
        $('#Description').html(quill.root.innerHTML);
        var formData = new FormData(this);
        $.ajax({
            url: urlpost,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response)
                if (response === "Success") {
                    $('#newsForm')[0].reset();
                     $('#Description').html("");
                    butterup.toast({
                        message: 'News successfully uploaded',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else if (response == "Image not selected") {
                    butterup.toast({
                        message: 'Image not selected',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else {
                    butterup.toast({
                        message: 'Failed to upload news',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            },
        });
    });
    
    
        let toolbarOptions = [
    ["bold", "italic", "underline"],
    ["blockquote", "code-block"],

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
            handlers: {
                image: imageHandler, 
            }
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


                // Send the image to the server for processing
                fetch(urlpost, {
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
});
