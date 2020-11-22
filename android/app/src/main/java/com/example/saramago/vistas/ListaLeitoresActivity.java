package com.example.saramago.vistas;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentTransaction;

import android.content.Intent;
import android.os.Bundle;
import android.provider.CalendarContract;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.SingletonGestorLeitores;

import java.util.ArrayList;

public class ListaLeitoresActivity extends AppCompatActivity {

    private static final int EDITAR = 1;
    private static final int ADICIONAR = 2;
    private ListView lvListaLeitores;
    private ArrayList<Leitor> listaLeitores;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_lista_leitores);


        lvListaLeitores= findViewById(R.id.lvListaLeitores);
        listaLeitores = SingletonGestorLeitores.getInstance().getLeitores();

        lvListaLeitores.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Fragment detalhesLeitorFragment = new DetalhesLeitorFragment();
            }
        });
    }


}