<?php

// College Information
$collegeName = "Sardar Vallabhbhai Patel Institute of Technology";
$websiteName = "footer";

$address = "Behind S.T. Bus Depot, Vasad, Anand, Gujarat - 388306";

$phone1 = "+91 95107 82982";
$phone2 = "+91 95107 82983";

$email = "contact@svitvasad.ac.in";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?php echo $websiteName; ?> - Footer</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="footer.css">

</head>

<body>

<footer class="site-footer">

    <!-- =========================
         FOOTER MAIN CONTENT
    ========================== -->

    <div class="footer-content">


        <!-- =========================
             ABOUT / LOGO
        ========================== -->

        <div class="footer-column footer-about">

            <div class="footer-brand">

                <img src="img/svit-logo.jpg"
                     alt="College Logo">

                <h3>
                    Campus<span>Connect</span>
                </h3>

            </div>


            <p>
                EventSphere is a college event management platform
                designed to simplify event planning, registration,
                and participation for students and organizers.
            </p>

        </div>


        <!-- =========================
             QUICK LINKS
        ========================== -->

        <div class="footer-column">

            <h3>Quick Links</h3>

            <a href="index.php">Home</a>

            <a href="about.php">About</a>

            <a href="events.php">Events</a>

            <a href="gallery.php">Gallery</a>

            <a href="contact.php">Contact</a>

        </div>


        <!-- =========================
             EVENTS
        ========================== -->

        <div class="footer-column">

            <h3>Events</h3>

            <a href="upcoming-events.php">
                Upcoming Events
            </a>

            <a href="past-events.php">
                Past Events
            </a>

            <a href="event-registration.php">
                Event Registration
            </a>

            <a href="certificates.php">
                Certificates
            </a>

            <a href="leaderboard.php">
                Leaderboard
            </a>

        </div>


        <!-- =========================
             CONTACT US
        ========================== -->

        <div class="footer-column contact-column">

            <h3>Contact Us</h3>


            <!-- Address -->

            <p>

                <i class="fa-solid fa-location-dot"></i>

                <span>
                    <?php echo htmlspecialchars($address); ?>
                </span>

            </p>


            <!-- Phone -->

            <p>

                <i class="fa-solid fa-phone"></i>

                <span>
                    <?php echo htmlspecialchars($phone1); ?>
                </span>

            </p>


            <!-- Phone -->

            <p>

                <i class="fa-solid fa-phone"></i>

                <span>
                    <?php echo htmlspecialchars($phone2); ?>
                </span>

            </p>


            <!-- Email -->

            <p>

                <i class="fa-regular fa-envelope"></i>

                <span>
                    <?php echo htmlspecialchars($email); ?>
                </span>

            </p>

        </div>

    </div>


    <!-- =========================
         SOCIAL MEDIA
    ========================== -->

    <div class="social-links">

        <a href="#" aria-label="Facebook">

            <i class="fa-brands fa-facebook-f"></i>

        </a>


        <a href="#" aria-label="Instagram">

            <i class="fa-brands fa-instagram"></i>

        </a>


        <a href="#" aria-label="LinkedIn">

            <i class="fa-brands fa-linkedin-in"></i>

        </a>


        <a href="#" aria-label="YouTube">

            <i class="fa-brands fa-youtube"></i>

        </a>

    </div>


    <!-- =========================
         COPYRIGHT
    ========================== -->

    <div class="footer-bottom">

        © <?php echo date("Y"); ?>

        <?php echo htmlspecialchars($websiteName); ?>

        |

        <?php echo htmlspecialchars($collegeName); ?>

    </div>

</footer>

</body>
</html>