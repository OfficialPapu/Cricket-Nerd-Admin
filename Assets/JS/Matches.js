$(document).ready(function () {
    const urlget = "Assets/PHP/API/GET/Matches.php";
    const urlpost = "Assets/PHP/API/POST/Matches.php";

    let options = [];

    const fetchOptions = async () => {
        try {
            let response = await axios.get(urlget, {
                params: {
                    ListAllCountry: true
                }
            });
            options = response.data;
            populateDropdown('dropdownMenuA');
            populateDropdown('dropdownMenuB');
        } catch (error) {
            console.error("Error fetching data: ", error);
        }
    };

    const populateDropdown = (dropdownMenuId) => {
        let dropdownMenu = $('#' + dropdownMenuId);
        dropdownMenu.empty();
        options.forEach((option, index) => {
            dropdownMenu.append(`
                        <div class="flex items-center gap-3 px-4 py-3 hover:bg-muted rounded-t-md cursor-pointer" data-index="${index}" data-country="${option['Country Name']}" data-icon="${option['Icon']}">
                            <img src="Media/Flags/${option['Icon']}" alt="${option['Country Name']}" width="32" height="32" class="rounded-md" />
                            <div class="flex-1">
                                <div class="font-medium">${option['Country Name']}</div>
                                <p class="text-sm text-muted-foreground">This is ${option['Country Name']}</p>
                            </div>
                        </div>
                    `);
        });
    };

    const handleDropdownClick = (dropdownMenuId, selectedIconId, selectedCountryId, iconId) => {
        let dropdownMenu = $('#' + dropdownMenuId);
        let icon = $('#' + iconId);
        if (dropdownMenu.is(':visible')) {
            dropdownMenu.hide();
            icon.removeClass('fa-check').addClass('fa-plus');
        } else {
            dropdownMenu.show();
            icon.removeClass('fa-plus').addClass('fa-check');
        }
    };

    const handleOptionSelect = (dropdownMenuId, selectedIconId, selectedCountryId, iconId, e) => {
        let option = $(e.target).closest('div[data-index]');
        let iconSrc = "Media/Flags/" + option.data('icon');
        let countryName = option.data('country');
        $('#' + selectedIconId).attr('src', iconSrc);
        $('#' + selectedCountryId).text(countryName);
        $('#' + iconId).removeClass('fa-check').addClass('fa-plus');
        $('#' + dropdownMenuId).hide();
    };

    $('#dropdownCountryA').on('click', function (e) {
        handleDropdownClick('dropdownMenuA', 'selectedIconA', 'selectedCountryA', 'iconCountryA');
    });

    $('#dropdownCountryB').on('click', function (e) {
        handleDropdownClick('dropdownMenuB', 'selectedIconB', 'selectedCountryB', 'iconCountryB');
    });

    $('#dropdownMenuA').on('click', function (e) {
        handleOptionSelect('dropdownMenuA', 'selectedIconA', 'selectedCountryA', 'iconCountryA', e);
    });

    $('#dropdownMenuB').on('click', function (e) {
        handleOptionSelect('dropdownMenuB', 'selectedIconB', 'selectedCountryB', 'iconCountryB', e);
    });

    $('#uploadForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append("CountryA", $('#selectedCountryA').text());
        formData.append("CountryB", $('#selectedCountryB').text());
        axios.post(urlpost, formData)
            .then(response => {
                if (response.data === "Success") {
                    $('#uploadForm')[0].reset();
                    $('#selectedIconA').attr('src', 'https://generated.vusercontent.net/placeholder.svg');
                    $('#selectedCountryA').text('Select a Flag');
                    $('#selectedIconB').attr('src', 'https://generated.vusercontent.net/placeholder.svg');
                    $('#selectedCountryB').text('Select a Flag');
                    butterup.toast({
                        message: 'Matches successfully uploaded',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else {
                    butterup.toast({
                        message: 'Failed to upload matches',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            })
    });

    fetchOptions();
});