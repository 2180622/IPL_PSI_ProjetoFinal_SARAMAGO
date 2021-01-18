package com.example.saramago.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import com.example.saramago.modelos.Config;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ConfigJsonParser {

    public static ArrayList<Config> parserJsonConfig(JSONArray response) {

        ArrayList<Config> configs = new ArrayList<>();
        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject config = (JSONObject) response.get(i);

                String key = config.getString("key");
                String value = config.getString("value");

                Config auxConfig = new Config(key, value);
                configs.add(auxConfig);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return configs ;
    }


    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo ni = cm.getActiveNetworkInfo();

        return ni != null && ni.isConnected();
    }
}
