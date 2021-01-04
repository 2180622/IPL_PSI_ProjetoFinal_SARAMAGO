package com.example.saramago.vistas.leitores;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

import com.example.saramago.R;
import com.example.saramago.adaptadores.leitores.ListaLeitoresAdaptador;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class ListaLeitoresActivity extends AppCompatActivity {

    private static final int ADICIONAR = 1;
    private static final int EDITAR = 2;
    private ListView lvListaLeitores;
    //private SearchView searchView;
    private ArrayList<Leitor> listaLeitores;
    //private SwipeRefreshLayout swipeRefreshLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_lista_leitores);
        //para aparecer a seta <-- de voltar para tras
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        lvListaLeitores= findViewById(R.id.lvListaLeitores);  // list view dos leitores
        FloatingActionButton fab = findViewById(R.id.floatingActionButton);
        //swipeRefreshLayout = findViewById(R.id.swipeRefreshLayout);

//      swipeRefreshLayout.setOnRefreshListener();
        listaLeitores = SingletonGestorBiblioteca.getInstance(getApplicationContext()).getLeitores(); // vai buscar do singleton todos os leitores no sistema
        lvListaLeitores.setAdapter(new ListaLeitoresAdaptador(getApplicationContext(), listaLeitores)); // insere na listview todos os leitores atraves do adaptador

        lvListaLeitores.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(getApplicationContext(), DetalhesLeitorActivity.class);
                intent.putExtra(DetalhesLeitorActivity.ID,(int) id);
                startActivityForResult(intent, EDITAR);
            }
        });

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), AddLeitorActivity.class);
                startActivity(intent);
            }
        });
    }
/*
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
    }

    @Override
    protected void onResume() {
        if (searchView != null){
            searchView.onActionViewCollapsed();
        }
        super.onResume();
    }*/
}