package com.example.saramago.vistas.leitores;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import com.example.saramago.R;
import com.example.saramago.adaptadores.leitores.ListaLeitoresAdaptador;
import com.example.saramago.listeners.LeitoresListener;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.LeitoresJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class ListaLeitoresActivity extends AppCompatActivity implements SwipeRefreshLayout.OnRefreshListener, LeitoresListener {

    private static final int ADICIONAR = 1;
    private static final int EDITAR = 2;
    private ListView lvListaLeitores;
    //private SearchView searchView;
    private ArrayList<Leitor> listaLeitores;
    private SwipeRefreshLayout swipeRefreshLayout;

    public ListaLeitoresActivity(){

    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_lista_leitores);
        //para aparecer a seta <-- de voltar para tras
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        lvListaLeitores= findViewById(R.id.lvListaLeitores);  // list view dos leitores
        FloatingActionButton fab = findViewById(R.id.floatingActionButton);
        swipeRefreshLayout= findViewById(R.id.swipeRefreshLayout);
        swipeRefreshLayout.setOnRefreshListener(this);

        // swipeRefreshLayout.setOnRefreshListener();
        SingletonGestorBiblioteca.getInstance(getApplicationContext()).setLeitoresListener(this); // vai buscar do singleton todos os leitores no sistema
        SingletonGestorBiblioteca.getInstance(getApplicationContext()).getAllLeitoresAPI(getApplicationContext()); // insere na listview todos os leitores atraves do adaptador

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
                if(LeitoresJsonParser.isConnectionInternet(getApplicationContext())){
                    Intent intent = new Intent(getApplicationContext(), AddLeitorActivity.class);
                    startActivityForResult(intent, ADICIONAR);
                }else {
                    Toast.makeText(getApplicationContext(), R.string.semInternet, Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    @Override
    public void onRefresh() {
        SingletonGestorBiblioteca.getInstance(getApplicationContext()).getAllLeitoresAPI(getApplicationContext());
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaLeitores(ArrayList<Leitor> listaLeitores) {
        if (listaLeitores != null) {
            lvListaLeitores.setAdapter(new ListaLeitoresAdaptador(getApplicationContext(), listaLeitores));
        }
    }

    @Override
    public void onRefreshDetalhes() {

    }

    //METODO PARA RETROCEDER A ACTIVITY
    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) { //https://stackoverflow.com/questions/24032956/action-bar-back-button-not-working/24033351
        switch (item.getItemId()){
            case android.R.id.home:
                onBackPressed();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }
}