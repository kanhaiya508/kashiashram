/**
 * Main
 */

"use strict";

let menu, animate;

(function () {
    // Initialize menu
    //-----------------

    let layoutMenuEl = document.querySelectorAll("#layout-menu");
    layoutMenuEl.forEach(function (element) {
        menu = new Menu(element, {
            orientation: "vertical",
            closeChildren: false,
        });
        // Change parameter to true if you want scroll animation
        window.Helpers.scrollToActive((animate = false));
        window.Helpers.mainMenu = menu;
    });

    // Initialize menu togglers and bind click on each
    let menuToggler = document.querySelectorAll(".layout-menu-toggle");
    menuToggler.forEach((item) => {
        item.addEventListener("click", (event) => {
            event.preventDefault();
            window.Helpers.toggleCollapsed();
        });
    });

    // Display menu toggle (layout-menu-toggle) on hover with delay
    let delay = function (elem, callback) {
        let timeout = null;
        elem.onmouseenter = function () {
            // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
            if (!Helpers.isSmallScreen()) {
                timeout = setTimeout(callback, 300);
            } else {
                timeout = setTimeout(callback, 0);
            }
        };

        elem.onmouseleave = function () {
            // Clear any timers set to timeout
            document
                .querySelector(".layout-menu-toggle")
                .classList.remove("d-block");
            clearTimeout(timeout);
        };
    };
    if (document.getElementById("layout-menu")) {
        delay(document.getElementById("layout-menu"), function () {
            // not for small screen
            if (!Helpers.isSmallScreen()) {
                document
                    .querySelector(".layout-menu-toggle")
                    .classList.add("d-block");
            }
        });
    }

    // Display in main menu when menu scrolls
    let menuInnerContainer = document.getElementsByClassName("menu-inner"),
        menuInnerShadow =
            document.getElementsByClassName("menu-inner-shadow")[0];
    if (menuInnerContainer.length > 0 && menuInnerShadow) {
        menuInnerContainer[0].addEventListener("ps-scroll-y", function () {
            if (this.querySelector(".ps__thumb-y").offsetTop) {
                menuInnerShadow.style.display = "block";
            } else {
                menuInnerShadow.style.display = "none";
            }
        });
    }

    // Init helpers & misc
    // --------------------

    // Init BS Tooltip
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Accordion active class
    const accordionActiveFunction = function (e) {
        if (e.type == "show.bs.collapse" || e.type == "show.bs.collapse") {
            e.target.closest(".accordion-item").classList.add("active");
        } else {
            e.target.closest(".accordion-item").classList.remove("active");
        }
    };

    const accordionTriggerList = [].slice.call(
        document.querySelectorAll(".accordion")
    );
    const accordionList = accordionTriggerList.map(function (
        accordionTriggerEl
    ) {
        accordionTriggerEl.addEventListener(
            "show.bs.collapse",
            accordionActiveFunction
        );
        accordionTriggerEl.addEventListener(
            "hide.bs.collapse",
            accordionActiveFunction
        );
    });

    // Auto update layout based on screen size
    window.Helpers.setAutoUpdate(true);

    // Toggle Password Visibility
    window.Helpers.initPasswordToggle();

    // Speech To Text
    window.Helpers.initSpeechToText();

    // Manage menu expanded/collapsed with templateCustomizer & local storage
    //------------------------------------------------------------------

    // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
    if (window.Helpers.isSmallScreen()) {
        return;
    }

    // If current layout is vertical and current window screen is > small

    // Auto update menu collapsed/expanded based on the themeConfig
    window.Helpers.setCollapsed(true, false);
})();



$(document).ready(function () {
    $(".status").click(function () {
        var id = $(this).data("id");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var status = $(this).is(":checked") === true ? 1 : 0;

        $.ajax({
            url: $(this).data("url"),
            type: "PATCH",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            data: {
                status: status,
            },
            success: function (data) {
                var Toast = Swal.mixin({
                    toast: true,
                    type: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: "success",
                    title: data.message,
                });
            },
        });
    });

    function message(title, type) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true, // Show a progress bar to indicate the remaining time
            onOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        Toast.fire({
            icon: type, // You can use the 'type' argument to set the icon
            title: title,
        });
    }

    $("#delete_all").on("click", function (e) {
        var checked = [];

        $.each($("input[name='id[]']:checked"), function () {
            checked.push($(this).val());
        });
        var joined = checked.join(", ");

        if (joined.length <= 0) {
            return false;
        }

        swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: $(this).data("url"),
                    type: "DELETE",
                    data: {
                        ids: joined,
                    },
                    success: function (data) {
                        if (data.success === true) {
                            $("input[name='id[]']:checked").each(function () {
                                $(this).parents("tr").remove();
                            });
                            message(data.message, "success");
                        } else if (data.success === false) {
                            message(data.message, "error");
                        } else {
                            message(data.message, "error");
                        }
                    },
                    error: function (data) {
                        message(data.message, "error");
                    },
                });
            }
        });
    });

    setTimeout(function () {
        $(".card-alert").fadeOut("fast");
    }, 20000);

    // Select all checkboxes in the first table
    var $selectAll = $("#selectAll");
    var $table = $(".tablegrid");
    var $tdCheckbox = $table.find("tbody input:checkbox");

    $selectAll.on("click", function () {
        $tdCheckbox.prop("checked", this.checked);
    });

    // Update main checkbox state based on checkboxes in the first table
    $tdCheckbox.on("change", function () {
        $selectAll.prop(
            "checked",
            $tdCheckbox.length === $tdCheckbox.filter(":checked").length
        );
    });

    // Select all checkboxes in the second table
    var $Categorie = $("#Categorie");
    var $tableCategorie = $(".tablegrid-categorie");
    var $tdCheckboxCategorie = $tableCategorie.find("tbody input:checkbox");

    $Categorie.on("click", function () {
        $tdCheckboxCategorie.prop("checked", this.checked);
    });

    // Update main checkbox state based on checkboxes in the second table
    $tdCheckboxCategorie.on("change", function () {
        $Categorie.prop(
            "checked",
            $tdCheckboxCategorie.length ===
            $tdCheckboxCategorie.filter(":checked").length
        );
    });

    // Shift-click functionality
    var $chkboxes = $(".sub_chk");
    var lastChecked = null;

    $chkboxes.click(function (e) {
        if (!lastChecked) {
            lastChecked = this;
            return;
        }

        if (e.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);

            $chkboxes
                .slice(Math.min(start, end), Math.max(start, end) + 1)
                .prop("checked", lastChecked.checked);
        }

        lastChecked = this;
    });
});


document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to all dropdowns with the class 'dropdowenstatus'
    document.querySelectorAll('.dropdowenstatus').forEach(function (dropdown) {
        dropdown.addEventListener('change', function () {
            const status = this.value; // Get the selected status
            const url = this.dataset.url; // Get the URL from the data-url attribute
            const id = this.dataset.id;  // Get the ID from the data-id attribute

            // Send the AJAX request
            fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ id: id, status: status }), // Send ID and new status
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var Toast = Swal.mixin({
                            toast: true,
                            type: "success",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        Toast.fire({
                            icon: "success",
                            title: data.message,
                        });

                    } else {
                        alert('Failed to update status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the status.');
                });
        });
    });
});
