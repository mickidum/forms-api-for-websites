# Form API for websites

## How to use
Download this repo unzip and rename to 'forms-api' \
Upload this folder to your hosting(probably to public_html). \
Follow to steps below.

Two fields must be sent POST to '/forms-api/api/api.php':
1. form_name_id -> "example_contact_form_name"
2. event_name -> "Example contact form - homepage"

## Login

path to login: 'your-domain-name.com/forms-api': \
username: 'admin' \
password: 'admin'

For changing username and password use 'Hash helper' - 'your-domain-name.com/forms-api/hashme.php'. \
Insert username and password and copy generated string. \
Open 'forms-api/index.php' and replace default admin string with generated.

## Contact Form 7 Example: 

Consider your site is 'your-domain-name.com' and 'forms-api' folder is located in 'public_html' directory, then full path will be 'your-domain-name.com/forms-api'.

In wordpress admin Contact form tab insert tags:

[hidden form_name_id "my_site_contacts_big_form"] \
[hidden event_name "My very big form on contacts page"]

### Add javascript hook to your 'js' file (wordpress):

<pre>
var host = location.origin;
jQuery('.wpcf7').on('wpcf7mailsent', function(event) {
	var inputs = event.detail.inputs;
	jQuery.post(host + '/forms-api/api/api.php', inputs, function(data) {});
});
</pre>

## CORS and validation

CORS is disabled by default. \
If you need CORS just open '/forms-api/api/api.php' and uncomment three headers. Also in '/forms-api/.htaccess uncomment 3 lines.

Validation is disabled too. \
If you need server side validation you probably should handle errors by yourself, example is comented in '/forms-api/api/api.php' file.

## END


