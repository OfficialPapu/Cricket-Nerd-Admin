$(document).ready(function () {
    const urlget = "Assets/PHP/API/GET/Statistics.php";
    const urlpost = "Assets/PHP/API/POST/Statistics.php";

    let DropdownOpen = false;
    let options = [];

    const fetchOptions = async () => {
        try {
            let response = await axios.get(urlget, {
                params: {
                    ListAllPlayers: true
                }
            });
            options = response.data;
            populateDropdown("dropdownMenu");
        } catch (error) {
            console.error("Error fetching data: ", error);
        }
    };

    const populateDropdown = (dropdownMenuId) => {
        let dropdownMenu = $('#' + dropdownMenuId);
        dropdownMenu.empty();
        options.forEach((option, index) => {
            dropdownMenu.append(`
                <div class="flex items-center gap-3 px-4 py-3 hover:bg-muted rounded-t-md cursor-pointer playerOption" 
                     data-index="${index}" 
                     data-country="${option['Player Name']}" 
                     data-icon="${option['Player Photo']}">
                    <img src="Media/Images/${option['Player Photo']}" alt="${option['Player Name']}" width="32" height="32" class="rounded-md" id="selectedPlayerImage" />
                    <div class="flex-1">    
                        <div class="font-medium">${option['Player Name']}</div>
                        <p class="text-sm text-muted-foreground">This is ${option['Country Name']}</p>
                    </div>
                </div>
            `);
        });
    };

    $('#dropdownToggle').click(function () {
        DropdownOpen = !DropdownOpen;
        $('#dropdownMenu').toggleClass('hidden');
    });

    $('#dropdownMenu').on('click', '.playerOption', function () {
        let selectedIndex = $(this).data('index');
        let selectedPlayer = options[selectedIndex];

        $('#selectedPlayer').text(selectedPlayer['Player Name']);
        $('#plusIcon').removeClass('hidden');
        DropdownOpen = false;
        $('#dropdownMenu').addClass('hidden');
        $("#PlayerID").val(selectedPlayer['ID']);
        $('#selectedPlayerImage').attr('src', `Media/Images/${selectedPlayer['Player Photo']}`);
        $('#selectedPlayerImage').attr('alt', selectedPlayer['Player Name']);
    });

    $('#submitBtn').click(function (e) {
        e.preventDefault();
        let formData = new FormData($('#uploadForm')[0]);
        formData.append("Statistics",true);
        $.ajax({
            url: urlpost,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === "Success") {
                    $('#uploadForm')[0].reset();
                    $('#selectedPlayer').text('Select a Player');
                    $('#selectedPlayerImage').attr('src', 'https://generated.vusercontent.net/placeholder.svg');
                    butterup.toast({
                        message: 'Video successfully uploaded',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else if (response === "DataMissing") {
                    butterup.toast({
                        message: 'All Field is Required!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else {
                    butterup.toast({
                        message: 'Something went wrong!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            },
        });
    });

    fetchOptions();
});
