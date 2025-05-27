<div>
    <div class="row">
        <div class="col-md-6">
            <label for="pincode">Enter PIN Code:</label>
            <input type="text" id="pincode" placeholder="Enter PIN Code..." maxlength="6" class="form-control" />
        </div>

        <div class="col-md-6">

            <label for="addressDropdown">Available Addresses:</label><br>
            <select id="addressDropdown" class="select2  form-control">
                <option value="">-- No Address Found Yet --</option>
            </select>
        </div>
    </div>
    <div id="message" class="text-muted mt-2"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const pinCodeInput = document.getElementById("pincode");
            const addressDropdown = document.getElementById("addressDropdown");
            const messageDiv = document.getElementById("message");

            const apiEndpoint = "https://api.postalpincode.in/pincode/";

            pinCodeInput.addEventListener("input", async () => {
                const pinCode = pinCodeInput.value.trim();

                // Validate PIN code length
                if (pinCode.length === 6 && /^[0-9]{6}$/.test(pinCode)) {
                    try {
                        messageDiv.innerHTML = "Fetching address details...";
                        addressDropdown.innerHTML = '<option value="">Loading...</option>'; // Show loading in dropdown

                        const response = await fetch(apiEndpoint + pinCode);
                        const data = await response.json();

                        if (data && data[0] && data[0].Status === "Success") {
                            const postOffices = data[0].PostOffice;

                            // Populate dropdown with post office details and append PIN code
                            addressDropdown.innerHTML = postOffices
                                .map(
                                    (office) =>
                                        `<option value="${office.Name}, ${office.District}, ${office.State}, ${office.Country}, ${pinCode}">
                                            ${office.Name}, ${office.District}, ${office.State}, ${pinCode}
                                        </option>`
                                )
                                .join("");

                            messageDiv.innerHTML = "Select an address from the dropdown.";
                        } else {
                            addressDropdown.innerHTML = '<option value="">No address found</option>';
                            messageDiv.innerHTML = "No address found for this PIN code.";
                        }
                    } catch (error) {
                        console.error("Error fetching address:", error);
                        addressDropdown.innerHTML = '<option value="">Error fetching address</option>';
                        messageDiv.innerHTML = "Error fetching address. Please try again.";
                    }
                } else if (pinCode.length === 6) {
                    addressDropdown.innerHTML = '<option value="">Invalid PIN Code</option>';
                    messageDiv.innerHTML = "Invalid PIN code. Please check your input.";
                } else {
                    addressDropdown.innerHTML = '<option value="">-- No Address Found Yet --</option>';
                    messageDiv.innerHTML = ""; // Clear message for invalid input
                }
            });
        });
    </script>
</div>