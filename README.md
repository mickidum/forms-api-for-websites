# Form API for websites

two fields must be sent POST to '/forms-api/api/api.php':
1. form_name_id -> "example_contact_form_name"
2. event_name -> "Example contact form - homepage"

## Login

path to login: 'http://your-domain-name.com/forms-api'
username: 'admin'
password: 'admin'

For changing username and password use 'Hash helper' - 'http://your-domain-name.com/forms-api/hashme.php'
Insert username and password and grab this string;
Open 'forms-api/index.php' and replace default admin string with generated;

## Contact Form 7 Example: 

Consider your site is 'http://your-domain-name.com' and 'forms-api' folder has been saved in 'public_html' directory, then full path will be 'http://your-domain-name.com/forms-api'.

In wordpress admin Contact form tab insert this tags:

[hidden form_name_id "my_site_contacts_big_form"]
[hidden event_name "My very big form on contacts page"]

Add javascript hook:

<pre>
var host = location.origin;
$('.wpcf7').on('wpcf7mailsent', function(event) {
	var inputs = event.detail.inputs;
	$.post(host + '/forms-api/api/api.php', inputs, function(data) {});
});
</pre>


