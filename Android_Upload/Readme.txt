Import the zip in android studio
In MainActivity.java change the url to your server/image_upload/
and correspondingly both arguments.
like in mine both of them are :
String websiteURL   = "http://192.168.0.103/image_upload";
String apiURL       = "http://192.168.0.103/image_upload/api"
where that number is my ip, and to test if it is working, I connect my mobile to same internet i.e router so it can connect.
Paste the image_upload folder in your server folder
Works fine.