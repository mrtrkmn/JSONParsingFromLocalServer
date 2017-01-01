package com.example.kurs.jsonparseaksam;

import android.database.sqlite.SQLiteOpenHelper;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class MainActivity extends AppCompatActivity {

    private Button button;
    private TextView textView;

    private HttpURLConnection connection;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        button = (Button) findViewById(R.id.button);
        textView = (TextView) findViewById(R.id.textview);

        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new JSONTask().execute("http://192.168.2.100:81/phpadminforjson.php?function=getCarsFromDatabase"); // here you have to look at your localhost ip from command prompt then,
                                                                                                                    //you have to rechange ip address with your ip address
            }
        });
    }
    public class JSONTask extends AsyncTask<String,String,String>{
        @Override
        protected String doInBackground(String... params) {
            try {
                URL url = new URL(params[0]);
                connection = (HttpURLConnection) url.openConnection();
                connection.connect();
                InputStream stream = connection.getInputStream();
                BufferedReader reader = new BufferedReader(new InputStreamReader(stream));
                StringBuffer buffer = new StringBuffer();
                String row;
                while ((row = reader.readLine()) !=null){
                    buffer.append(row);
                }
                return buffer.toString();

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }
        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            textView.setText(result);
            try {
                JSONObject jsonObject = new JSONObject(result);
                JSONArray jsonArray = jsonObject.getJSONArray("cars");
                for (int i = 0; i < jsonArray.length() ; i++) {
                    JSONObject carjJson = jsonArray.getJSONObject(i);

                    Log.i("Car "+i + " ID",carjJson.getString("ID"));
                    Log.i("Car "+i + " BRAND",carjJson.getString("BRAND"));
                    Log.i("Car "+i + " MODEL",carjJson.getString("MODEL"));
                    Log.i("Car "+i + " YEAR",carjJson.getString("YEAR"));
                    Log.i("Car "+i + " KM",carjJson.getString("KM"));
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
