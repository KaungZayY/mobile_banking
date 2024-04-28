<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    footer {
        background-color: #f8f9fa;
        padding: 20px;
        margin-top: auto; /* This pushes the footer to the bottom */
    }
</style>

<footer>
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h4>Contact Us</h4>
                <p>Address: 123 Banking Street, Cityville</p>
                <p>Phone: +123 456 7890</p>
                <p>Email: info@mybank.com</p>
            </div>
            <div>
                <h4>Useful Links</h4>
                <ul style="list-style-type: none; padding: 0;">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4>Follow Us</h4>
                <p>Stay connected with us on social media:</p>
                <div>
                    <a href="#" style="margin-right: 10px;"><i class="fa fa-facebook"></i></a>
                    <a href="#" style="margin-right: 10px;"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr style="margin-top: 20px; border-color: #ddd;">
        <p style="margin-top: 10px;">&copy; <?php echo date("Y"); ?> Bank.inc . All rights reserved.</p>
    </div>
</footer>
