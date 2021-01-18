package com.example.saramago.vistas;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.saramago.R;
import com.example.saramago.listeners.LoginListener;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.LoginJsonParser;

public class LoginActivity extends AppCompatActivity implements LoginListener {

    private EditText etUsername, etPassword, etApi;
    private CheckBox cbAPI, cbGuardaSessao;
    private String username, password, api;
    //private String nome;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle("Login");

        etUsername = findViewById(R.id.etUsername);
        etPassword = findViewById(R.id.etPassword);
        etApi = findViewById(R.id.etApi);

        SingletonGestorBiblioteca.getInstance(getApplicationContext()).setLoginListener(this);
    }

    public void onClickLogin(View view)
    {
        if(LoginJsonParser.isConnectionInternet(getApplicationContext())){

            username = etUsername.getText().toString();
            password = etPassword.getText().toString();
            api = etApi.getText().toString();

            if(username.length() < 3)
            {
                etUsername.setError(getString(R.string.etUsernameInvalido));
                return;
            }

            if(!isApiValida(api))
            {
                etApi.setError(getString(R.string.invalidUrl));
            }

            if (!isPasswordValida(password)) {
                etPassword.setError(getString(R.string.etPasswordInvalida));
                return;
            }

            SingletonGestorBiblioteca.getInstance(getApplicationContext()).loginAPI(username, password, api, getApplicationContext());

        } else {

            Toast.makeText(getApplicationContext(), R.string.semInternet, Toast.LENGTH_SHORT).show();
        }

    }

    private boolean isApiValida(String url)
    {
        return Patterns.WEB_URL.matcher(url).matches();
    }

    private boolean isPasswordValida(String password){
        if(password==null)
            return false;

        return password.length()>=4;
    }

    @Override
    public void onValidateLogin(String token, String username, String api) {

        if(token != null)
        {
            guardarInfoSharedPref(token,username,api);

            //CODIGO PARA MUDAR DE ACTIVIDADE
            Intent intent= new Intent(this, MenuMainActivity.class);
            startActivity(intent);
            finish();
        }else
        {
            Toast.makeText(getApplicationContext(), "Login inválido", Toast.LENGTH_SHORT).show();
        }

    }

    private void guardarInfoSharedPref(String token, String username, String api)
    {
        SharedPreferences sharedPrefeUser = getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPrefeUser.edit();

        editor.putString(MenuMainActivity.USERNAME, username);
        editor.putString(MenuMainActivity.TOKEN, token);
        editor.putString(MenuMainActivity.API, api);
        editor.apply();
    }
}