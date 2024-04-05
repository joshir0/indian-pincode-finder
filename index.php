<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pincode Finder</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <!-- Navbar -->
        <nav class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Pincode Finder</h1>
            </div>
            <div>
                <a href="#faq" class="text-blue-500 hover:underline mr-4">FAQ</a>
                <a href="#about" class="text-blue-500 hover:underline">About</a>
            </div>
        </nav>
        <!-- End Navbar -->

        <p class="mb-6 text-gray-700">
            Pincode Finder is a simple tool that allows you to find location details based on Indian postal codes (pin codes). You can enter a pincode in the search box below, and the tool will retrieve information about the corresponding area, including the office name, office type, division name, region name, circle name, taluk, district name, state name, and telephone number.
        </p>
        <div class="bg-white rounded-md shadow-md p-6 mb-4 flex items-center justify-center hover:shadow-lg transition duration-300 ease-in-out">
            <form action="" method="GET" class="flex">
                <input type="text" name="pincode" placeholder="Enter Pincode" class="border rounded-l-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md">Search</button>
            </form>
        </div>

        <?php
        // Function to sanitize user input
        function sanitizeInput($data) {
            return htmlspecialchars(strip_tags($data));
        }

        // Check if pincode is provided in the URL
        if (isset($_GET['pincode']) && !empty($_GET['pincode'])) {
            $pincode = sanitizeInput($_GET['pincode']);
            $api_url = "https://api.pincode-finder.com/$pincode";
            $response = file_get_contents($api_url);
            $data = json_decode($response, true);

            // Check if data is retrieved successfully
            if ($data && count($data) > 0) {
                foreach ($data as $location) {
        ?>
                    <div class="bg-white shadow-md rounded-md p-6 mb-4">
                        <h2 class="text-xl font-semibold mb-2">Pincode: <?php echo $location['pincode']; ?></h2>
                        <p class="mb-2"><strong>Office Name:</strong> <?php echo $location['office_name']; ?></p>
                        <p class="mb-2"><strong>Office Type:</strong> <?php echo $location['office_type']; ?></p>
                        <p class="mb-2"><strong>Division Name:</strong> <?php echo $location['division_name']; ?></p>
                        <p class="mb-2"><strong>Region Name:</strong> <?php echo $location['region_name']; ?></p>
                        <p class="mb-2"><strong>Circle Name:</strong> <?php echo $location['circle_name']; ?></p>
                        <p class="mb-2"><strong>Taluk:</strong> <?php echo $location['taluk']; ?></p>
                        <p class="mb-2"><strong>District Name:</strong> <?php echo $location['district_name']; ?></p>
                        <p class="mb-2"><strong>State Name:</strong> <?php echo $location['state_name']; ?></p>
                        <p class="mb-2"><strong>Telephone:</strong> <?php echo $location['telephone']; ?></p>
                    </div>

                    <div class="bg-white shadow-md rounded-md mb-4">
                        <iframe src="https://maps.google.com/maps?q=<?php echo $location['latitude']; ?>,<?php echo $location['longitude']; ?>&z=15&output=embed" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
        <?php 
                }
            } else { 
        ?>
                <p class="text-red-500">No data found for the provided pincode. Please enter a valid Indian pincode.</p>
        <?php 
            }
        } 
        ?>

        <!-- FAQ Section -->
        <div id="faq" class="container mx-auto px-4 py-8 bg-white rounded-md shadow-md max-w-lg">
            <h2 class="text-2xl font-semibold mb-4">FAQ</h2>
            <div class="border-t border-gray-200 pt-4">
                <div class="mb-4 faq-item hover:bg-gray-100 transition duration-300 ease-in-out rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">How do I use Pincode Finder?</h3>
                    <p>Simply enter a pincode in the search box above and click on the "Search" button. The tool will retrieve information about the corresponding area based on the provided pincode.</p>
                </div>
                <div class="mb-4 faq-item hover:bg-gray-100 transition duration-300 ease-in-out rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">What information will I get?</h3>
                    <p>The tool will provide details such as the office name, office type, division name, region name, circle name, taluk, district name, state name, and telephone number associated with the provided pincode.</p>
                </div>
                <div class="mb-4 faq-item hover:bg-gray-100 transition duration-300 ease-in-out rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">Which API does Pincode Finder use?</h3>
                    <p>Pincode Finder uses the <a href="https://pincode-finder.com/free_api" target="_blank" class="text-blue-500 hover:underline">Pincode Finder API</a> to retrieve location details based on Indian pincodes.</p>
                </div>
                <!-- Add more FAQ items here -->
            </div>
        </div>
        <!-- End FAQ Section -->
 </div>
        <!-- Footer -->
        <footer id="about" class="bg-gray-800 text-white py-4 mt-8">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Pincode Finder. All rights reserved. Powered by <a href="https://pincode-finder.com" target="_blank" class="underline">Pincode-Finder.com</a>.</p>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
</body>

</html>
