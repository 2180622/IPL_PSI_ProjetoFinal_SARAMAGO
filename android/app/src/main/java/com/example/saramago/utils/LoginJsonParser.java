package com.example.saramago.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;
import android.widget.Toast;

import com.example.saramago.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

//TODO: implementar metodos
public class LoginJsonParser {

    private static String token;

    public static String parserJsonLogin(String response)
    {
        token = null;

        try {
            JSONObject login = new JSONObject(response);

            if (login.getBoolean("success"))
            {
                String status = login.getString("status");
                String saramago = login.getString("saramago");

                if(status.equals("200") && saramago.equals("v1.0"))
                {
                    token = login.getString("token");
                }
            }
        }
        catch (JSONException e)
        {
            e.printStackTrace();
        }

        return token;

    }

    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo ni = cm.getActiveNetworkInfo();

        return ni != null && ni.isConnected();
    }
}