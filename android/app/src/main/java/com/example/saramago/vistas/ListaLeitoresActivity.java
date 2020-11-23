package com.example.saramago.vistas;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ListView;
import android.widget.SearchView;

import com.example.saramago.R;
import com.example.saramago.adaptadores.ListaLeitoresAdaptador;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.SingletonGestorBiblioteca;

import java.util.ArrayList;

public class ListaLeitoresActivity extends AppCompatActivity {

    private static final int EDITAR = 1;
    private static final int ADICIONAR = 2;
    private ListView lvListaLeitores;
    private SearchView searchView;
    private ArrayList<Leitor> listaLeitores;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_lista_leitores);
        lvListaLeitores= findViewById(R.id.lvListaLeitores);
        listaLeitores = SingletonGestorBiblioteca.getInstance(getApplicationContext()).getLeitores();

        lvListaLeitores.setAdapter(new ListaLeitoresAdaptador(getApplicationContext(), listaLeitores));
    }


}