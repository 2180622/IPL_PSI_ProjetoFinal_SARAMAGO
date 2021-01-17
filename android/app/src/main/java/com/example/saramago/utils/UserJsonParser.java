package com.example.saramago.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;

import com.example.saramago.modelos.User;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class UserJsonParser {

    public static ArrayList<User> parserJsonUser(JSONArray json){
        ArrayList<User> listaUsers= new ArrayList<>();

        try {
            for (int i=0;i<json.length();i++) {
                JSONObject obj = (JSONObject) json.get(i);

                int idUser = obj.getInt("id");
                String username = obj.getString("username");
                String auth_key = obj.getString("auth_key");
                String password_hash_ = obj.getString("password_hash_");
                String email = obj.getString("email");
                int status = obj.getInt("status");
                int created_at = obj.getInt("created_at");
                int updated_at = obj.getInt("updated_at");

                listaUsers.add(new User(idUser, username, auth_key, password_hash_, email, status, created_at, updated_at));
            }
        }catch (JSONException e){
            e.printStackTrace();
        }
        return  listaUsers;
    }

    public static User parserJsonUser(String json){
        User user= null;
        try {
            JSONObject obj = new JSONObject (json);

            int idUser= obj.getInt("id");
            Log.i("jsonUser","id: "+idUser);
            String username = obj.getString("username");
            String auth_key = obj.getString("auth_key");
            String password_hash = obj.getString("password_hash");
            String email = obj.getString("email");
            int status = obj.getInt("status");
            int created_at = obj.getInt("created_at");
            int updated_at = obj.getInt("updated_at");

            user = new User(idUser, username, auth_key, password_hash, email, status, created_at, updated_at);

            Log.i("getUser","jsonUser:"+user);
        }catch (JSONException e){
            e.printStackTrace();
        }
        return user;
    }

    public static String[] parserJsonLogin(String response){
        //TODO:Aletrar forma de receber token
        String[] array = new String[2];

        try{
            JSONObject login = new JSONObject (response);
            String token=login.getString("token");
            int userId=login.getInt("userId");
            Log.i("Login","token: "+token);
            Log.i("Login","user id: "+userId);
            array[0]=token;
            array[1]=String.valueOf(userId);

        }catch (JSONException e){
            e.printStackTrace();
        }
        return array;
    }

    public static boolean isConnectionInternet(Context context){
        ConnectivityManager cm =(ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo info=cm.getActiveNetworkInfo();

        return info!= null && info.isConnected();
    }
}
