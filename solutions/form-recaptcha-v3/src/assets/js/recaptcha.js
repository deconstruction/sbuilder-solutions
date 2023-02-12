/**
 * Recaptcha V3 for SBuilder platform
 *
 * Version: 1.1.1
 */

// Listen for DOMContentLoaded and recaptcha events
['DOMContentLoaded', 'recaptcha'].forEach(event => {
    window.addEventListener(event, () => {

        // Log that the recaptcha script has loaded
        console.log('recaptcha script loaded');

        // Select all forms with data-recaptcha attribute and the meta tag with recaptcha public key
        const forms = document.querySelectorAll('[data-recaptcha]');
        const metaKey = document.querySelector('meta[name="recaptcha-public-key"]')

        // If there are forms with data-recaptcha attribute and the meta tag with recaptcha public key exists
        if (forms.length > 0 && metaKey !== null) {
            // Get the recaptcha public key from the meta tag
            const recaptchaClientKey = metaKey.getAttribute('content');

            // Create a script element
            const script = document.createElement('script');
            script.onload = function () {
                // Wait for grecaptcha to be ready
                grecaptcha.ready(function () {
                    // Loop through each form
                    forms.forEach(form => {
                        // Execute the recaptcha client-side
                        grecaptcha.execute(recaptchaClientKey, {action: 'submit'}).then(function (token) {
                            // Select the input element for the recaptcha token
                            let input = form.querySelector('[name="recaptcha_token"]');

                            // If the input element doesn't exist, create it
                            if (input === null) {
                                input = document.createElement('input');
                                input.setAttribute("type", "hidden");
                                input.setAttribute("name", "recaptcha_token");
                                form.appendChild(input);
                            }

                            // Set the value of the input element to the recaptcha token
                            input.setAttribute("value", token);

                            // Create an input element for the current page information
                            const page = document.createElement('input');
                            page.setAttribute("type", "hidden");
                            page.setAttribute("name", "current_page");
                            page.setAttribute("value", window.location.href);
                            form.appendChild(page);

                            // Create an input element for the current date information
                            const date = document.createElement('input');
                            date.setAttribute("type", "hidden");
                            date.setAttribute("name", "current_date");
                            date.setAttribute("value", new Date);
                            form.appendChild(date);
                        });
                    });
                });
            };

            // Set the src of the script element to the recaptcha API
            script.src = 'https://www.google.com/recaptcha/api.js?render=' + recaptchaClientKey;

            // Append the script element to the head of the document
            document.head.appendChild(script);
        }
    });
});
