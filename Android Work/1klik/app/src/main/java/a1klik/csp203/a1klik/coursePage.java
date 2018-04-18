package a1klik.csp203.a1klik;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.HashMap;
import java.util.Map;

public class coursePage extends AppCompatActivity {
    String InstructorName;
    String CourseName;
    String courseTitle;
    int CourseID;
    int id;
    /* Api variables */
    String websiteURL   = "folder to saving image folder";
    String apiURL       = "FOLDER to folder having php"; // Without ending slash
    String apiPassword  = "qw2e3erty6uiop";

    /* Current image */
    String currentImagePath = "";
    String currentImage = "";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_course_page);
        InstructorName= getIntent().getStringExtra("UserName");
        CourseName= getIntent().getStringExtra("courseName");
        CourseID= getIntent().getIntExtra("course_id",-1);
        courseTitle= getIntent().getStringExtra("courseTitle");
        id= getIntent().getIntExtra("id",-1);
        ((TextView)findViewById(R.id.loginUserName)).setText(InstructorName);
        ((TextView)findViewById(R.id.courseShowScreen)).setText(CourseName);

        //check permission
        checkPermissionRead();
        checkPermissionWrite();

        //listner
        buttonListener();

    }
    public void onLogout(View view)
    {

    }

    /*- Check permission Read ---------------------------------------------------------- */
// Pops up message to user for reading
    private void checkPermissionRead(){
        int MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE = 1;
        if (checkSelfPermission(android.Manifest.permission.READ_EXTERNAL_STORAGE)
                != PackageManager.PERMISSION_GRANTED) {

            // Should we show an explanation?
            if (shouldShowRequestPermissionRationale(
                    android.Manifest.permission.READ_EXTERNAL_STORAGE)) {
                // Explain to the user why we need to read the contacts
            }

            requestPermissions(new String[]{android.Manifest.permission.READ_EXTERNAL_STORAGE},
                    MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE);

            // MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE is an
            // app-defined int constant that should be quite unique

            return;
        }
    } // checkPermissionRead

    /*- Check permission Write ---------------------------------------------------------- */
// Pops up message to user for writing
    private void checkPermissionWrite(){
        int MY_PERMISSIONS_REQUEST_WRITE_EXTERNAL_STORAGE = 1;
        if (checkSelfPermission(Manifest.permission.WRITE_EXTERNAL_STORAGE)
                != PackageManager.PERMISSION_GRANTED) {

            // Should we show an explanation?
            if (shouldShowRequestPermissionRationale(
                    android.Manifest.permission.WRITE_EXTERNAL_STORAGE)) {
                // Explain to the user why we need to read the contacts
            }

            requestPermissions(new String[]{android.Manifest.permission.WRITE_EXTERNAL_STORAGE},
                    MY_PERMISSIONS_REQUEST_WRITE_EXTERNAL_STORAGE);

            // MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE is an
            // app-defined int constant that should be quite unique

            return;
        }
    } // checkPermissionWrite

    /*- Button Listener ------------------------------------------------------------- */
    public void buttonListener() {
        // Load image button listener
        Button buttonGallery = (Button) findViewById(R.id.buttonGallery);
        buttonGallery.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent pickPhoto = new Intent(Intent.ACTION_PICK,
                        android.provider.MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
                startActivityForResult(pickPhoto , 1);//one can be replaced with any action code
            }
        });
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == RESULT_OK) {
            Uri selectedImageUri = data.getData();

            // Set image
            //ImageView imageViewImage = (ImageView)findViewById(R.id.imageViewImage);
            //imageViewImage.setImageURI(selectedImageUri);

            // Save image
            String destinationFilename = com.nettport.imageupload.imageupload.FilePath.getPath(this, selectedImageUri);

            // Dynamic text
            TextView textViewDynamicText = (TextView) findViewById(R.id.textViewDynamicText); // Dynamic text

            // URL
            String urlToApi = apiURL + "/image_upload.php";


            // Toast
            //Toast.makeText(this, "ID:"  + currentRecipeId, Toast.LENGTH_LONG).show();

            // Data
            Map mapData = new HashMap();
            mapData.put("inp_api_password", apiPassword);

            com.nettport.imageupload.imageupload.HttpRequestLongOperation task = new com.nettport.imageupload.imageupload.HttpRequestLongOperation(this, urlToApi, "post_image", mapData, destinationFilename, textViewDynamicText, new com.nettport.imageupload.imageupload.HttpRequestLongOperation.TaskListener() {
                @Override
                public void onFinished(String result) {
                    // Do Something after the task has finished
                    imageUploadResult();
                }
            });
            task.execute();

        }
    }


    public void imageUploadResult() {
        // Dynamic text
        TextView textViewDynamicText = (TextView)findViewById(R.id.textViewDynamicText);
        String dynamicText = textViewDynamicText.getText().toString();

        // Split
        int index = dynamicText.lastIndexOf('/');
        try {
            currentImagePath = dynamicText.substring(0, index);
        }
        catch (Exception e){
            Toast.makeText(this, "path: " + e.toString(), Toast.LENGTH_LONG).show();
        }
        try {
            currentImage = dynamicText.substring(index,dynamicText.length());
        }
        catch (Exception e){
            Toast.makeText(this, "image: " + e.toString(), Toast.LENGTH_LONG).show();
        }

        // Load new image
        // Todo: loadImage();

    } // imageUploadResult


    /*- Load image ------------------------------------------------------------------ */
    public void loadImage(){

        // Load image
        ImageView imageViewImage = (ImageView)findViewById(R.id.imageViewImage);

        if(!(currentImagePath.equals("")) && !(currentImage.equals(""))){

            String loadImage = websiteURL + "/" + currentImagePath + "/" + currentImage;
            //new HttpRequestImageLoadTask(this, loadImage, imageViewImage).execute();

        }
    }

}
