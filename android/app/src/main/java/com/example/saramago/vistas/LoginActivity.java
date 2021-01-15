package com.example.saramago.vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;
import com.example.saramago.listeners.LoginListener;
import com.example.saramago.R;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.LeitoresJsonParser;

public class LoginActivity extends AppCompatActivity {

    private EditText etUsername, etPassword, etAPI;
    private CheckBox cbAPI, cbGuardaSessao;
    private String username;
    private String nome;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle("Login");

        etUsername = findViewById(R.id.etUsername);
        etPassword = findViewById(R.id.etPassword);
        etAPI = findViewById(R.id.etAPI);

        SingletonGestorBiblioteca.getInstance(getApplicationContext()).setLoginListener(this);
    }

    public void onClickLogin(View view){
        if(LeitoresJsonParser.isConnectionInternet(getApplicationContext())){

            username = etUsername.getText().toString();
            nome = "John Doe";
            if(username.length() > 10 || username.length() < 5){
                return;
            }

            Intent intent = new Intent(this, MenuMainActivity.class);
            intent.putExtra(MenuMainActivity.USERNAME, username);
            intent.putExtra(MenuMainActivity.NOME, nome);
            startActivity(intent);
            finish();
        }
    }

    //FIXME
    /*private void guardarInfoSharedPref(String token, String email)
    {
        SharedPreferences sharedPrefeUser = getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPrefeUser.edit();

        editor.putString(MenuMainActivity.EMAIL, email);
        editor.putString(MenuMainActivity.TOKEN, token);
        editor.apply();

    }*/

}