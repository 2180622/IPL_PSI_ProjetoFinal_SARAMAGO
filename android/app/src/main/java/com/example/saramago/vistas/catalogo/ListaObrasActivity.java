package com.example.saramago.vistas.catalogo;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;
import android.view.MenuItem;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.example.saramago.R;
import com.example.saramago.adaptadores.catalogo.ListaObrasAdaptador;
import com.example.saramago.listeners.ObrasListener;
import com.example.saramago.modelos.Obra;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.ObrasJsonParser;
import com.example.saramago.vistas.catalogo.AddObraActivity;
import com.example.saramago.vistas.catalogo.DetalhesObraActivity;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class ListaObrasActivity extends AppCompatActivity implements SwipeRefreshLayout.OnRefreshListener, ObrasListener {

    private static final int ADICIONAR = 1;
    private static final int EDITAR = 2;
    private ListView lvListaObras;
    //private SearchView searchView;
    private ArrayList<Obra> listaObras;
    private SwipeRefreshLayout swipeRefreshLayout;

    public ListaObrasActivity(){

    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_lista_obras);
        //para aparecer a seta <-- de voltar para tras
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        lvListaObras= findViewById(R.id.lvListaObras);  // list view das obras
        FloatingActionButton fab = findViewById(R.id.floatingActionButtonAddObra);
        swipeRefreshLayout= findViewById(R.id.swipeRefreshLayout);
        swipeRefreshLayout.setOnRefreshListener(this);

        lvListaObras.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(getApplicationContext(), DetalhesObraActivity.class);
                intent.putExtra(DetalhesObraActivity.ID,(int) id);
                startActivityForResult(intent, EDITAR);
            }
        });

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(ObrasJsonParser.isConnectionInternet(getApplicationContext())){
                    Intent intent = new Intent(getApplicationContext(), AddObraActivity.class);
                    startActivityForResult(intent, ADICIONAR);
                }else {
                    Toast.makeText(getApplicationContext(), R.string.semInternet, Toast.LENGTH_SHORT).show();
                }
            }
        });
        // swipeRefreshLayout.setOnRefreshListener();
        SingletonGestorBiblioteca.getInstance(getApplicationContext()).setObrasListener(this); // vai buscar do singleton todas as obras no sistema
        SingletonGestorBiblioteca.getInstance(getApplicationContext()).getAllObrasAPI(getApplicationContext()); // insere na listview todas as obras atraves do adaptador
    }

    @Override
    public void onRefresh() {
        SingletonGestorBiblioteca.getInstance(getApplicationContext()).getAllObrasAPI(getApplicationContext());
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaObras(ArrayList<Obra> listaObras) {
        if (listaObras != null) {
            lvListaObras.setAdapter(new ListaObrasAdaptador(getApplicationContext(), listaObras));
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