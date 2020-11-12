package com.example.saramago;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends AppCompatActivity {

    private EditText etEmail, etPassword, etAPI;
    private CheckBox cbAPI, cbGuardaSessao;
    private String email;
    private String nome;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle("Login");

        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
        etAPI = findViewById(R.id.etAPI);
    }

    public boolean isEmailValid(String email){
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    public void onClickLogin(View view){
        Context context = getApplicationContext();
        email = etEmail.getText().toString();
        nome = "John Doe";

        if(!isEmailValid(email)){
            Toast.makeText(context, "Email inválido", Toast.LENGTH_LONG).show();
            return;
        }

        Intent intent = new Intent(this, MenuMainActivity.class);
        intent.putExtra(MenuMainActivity.EMAIL, email);
        intent.putExtra(MenuMainActivity.NOME, nome);
        startActivity(intent);
        finish();
    }
}