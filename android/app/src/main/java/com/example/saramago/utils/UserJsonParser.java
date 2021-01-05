package com.example.saramago.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

//TODO: implementar metodos
public class UserJsonParser {

    /*public static ArrayList<Users> parserJsonUser(JSONArray json){
        ArrayList<Users> listaUsers= new ArrayList<>();

        try {
            for (int i=0;i<json.length();i++) {

                JSONObject obj = (JSONObject) json.get(i);
                //TODO:Alterar dados a receber um json
                int idUser = obj.getInt("id");
                String username = obj.getString("username");
                String password_hash_ = obj.getString("password_hash_");
                String email = obj.getString("email");

                listaUsers.add(new Users(idUser, username, password_hash_, email));
            }
        }catch (JSONException e){
            e.printStackTrace();
        }
        return  listaUsers;
    }

    public static Users parserJsonUser(String json){
        Users user= null;
        try {
            JSONObject obj = new JSONObject (json);

            int idUser= obj.getInt("id");
            Log.i("jsonUser","id: "+idUser);
            String username = obj.getString("username");
            String password_hash = obj.getString("password_hash");
            String email = obj.getString("email");

            user = new Users(idUser,username,password_hash,email);

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
    }*/

    public static boolean isConnectionInternet(Context context){
        ConnectivityManager cm =(ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo info=cm.getActiveNetworkInfo();

        return info!= null && info.isConnected();
    }
}
