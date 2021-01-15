package com.example.saramago.vistas.catalogo;

import android.os.Bundle;
import android.widget.EditText;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.example.saramago.modelos.Obra;

public class AddObraActivity extends AppCompatActivity {

    private EditText nome, codBarras, nif, docId, dtaNascimento, morada, localidade, codPostal, telemovel, telefone, email, email2;
    private Obra obra;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }
}
